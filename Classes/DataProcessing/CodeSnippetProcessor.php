<?php
namespace DanielGoerz\FsCodeSnippet\DataProcessing;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use DanielGoerz\FsCodeSnippet\Enumeration\CodeSnippetLanguage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use TYPO3\CMS\Extbase\Service\FlexFormService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Frontend\ContentObject\Exception\ContentRenderingException;

/**
 * This data processor will map the internally used string for a programming language
 * to the string that the prism.js library expects. Internally not known types are
 * let through unchanged.
 *
 * @author Daniel Goerz <ervaude@gmail.com>
 */
class CodeSnippetProcessor implements DataProcessorInterface
{
    /**
     * Process data for the CType "fs_code_snippet"
     *
     * @param ContentObjectRenderer $cObj The content object renderer, which contains data of the content element
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     * @throws ContentRenderingException
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        $processedData['commandline'] = [];
        $processedData['layout'] = $this->getLayoutName();

        if ($processedData['data']['programming_language'] === CodeSnippetLanguage::COMMANDLINE) {
            $flexFormContent = $this->getFlexFormContentAsArray($processedData['data']['pi_flexform']);
            if (!empty($flexFormContent['settings']['commandline'])) {
                $processedData['commandline'] = $flexFormContent['settings']['commandline'];
            }
        }

        $processedData['programmingLanguage'] = $this->getProgrammingLanguageStringForPrism($processedData['data']['programming_language']);
        $processedData['data']['bodytext'] = rtrim($processedData['data']['bodytext'], "\n\r\t");
        $processedData['lineNumbers'] = !empty($processorConfiguration['lineNumbers']);
        return $processedData;
    }

    /**
     * @param string $flexFormContent
     * @return array
     */
    private function getFlexFormContentAsArray($flexFormContent)
    {
        /** @var FlexFormService $flexFormService */
        $flexFormService = GeneralUtility::makeInstance(FlexFormService::class);
        return $flexFormService->convertFlexFormContentToArray($flexFormContent);
    }

    /**
     * Since TYPO3 8.6 the layout structure of fluid_styled_content has changed.
     * This method returns the correct layout name for the used TYPO3 version.
     *
     * @return string
     */
    private function getLayoutName()
    {
        if (VersionNumberUtility::convertVersionNumberToInteger(TYPO3_branch) >= VersionNumberUtility::convertVersionNumberToInteger('8.6')) {
            return 'Default';
        }
        return 'HeaderContentFooter';
    }

    /**
     * Map the CodeSnippetLanguage constants to the string expected by prism where they differ
     *
     * @param string $programmingLanguage
     * @return string
     */
    private function getProgrammingLanguageStringForPrism($programmingLanguage)
    {
        switch ($programmingLanguage) {
            case CodeSnippetLanguage::HTML:
                return CodeSnippetLanguage::MARKUP;
            case CodeSnippetLanguage::COMMANDLINE:
                return CodeSnippetLanguage::BASH;
            default:
                return $programmingLanguage;
        }
    }
}
