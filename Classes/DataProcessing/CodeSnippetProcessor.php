<?php
namespace DanielGoerz\FsCodeSnippet\DataProcessing;

/*
 * This file is part of TYPO3 CMS-based extension fs_code_snippet.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use DanielGoerz\FsCodeSnippet\Enumeration\CodeSnippetLanguage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * This data processor will map the internally used string for a programming language
 * to the string that the prism.js library expects. Internally not known types are
 * let through unchanged.
 *
 * @author Daniel Goerz <usetypo3@posteo.de>
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
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData): array
    {
        $processedData['commandline'] = [];

        if ($processedData['data']['programming_language'] === CodeSnippetLanguage::COMMANDLINE) {
            $flexFormContent = $this->getFlexFormContentAsArray($processedData['data']['pi_flexform']);
            if (!empty($flexFormContent['settings']['commandline'])) {
                $processedData['commandline'] = $flexFormContent['settings']['commandline'];
            }
        }

        $processedData['programmingLanguage'] = $this->getProgrammingLanguageStringForPrism($processedData['data']['programming_language']);
        $processedData['data']['bodytext'] = rtrim($processedData['data']['bodytext'], "\n\r\t");
        return $processedData;
    }

    private function getFlexFormContentAsArray(string $flexFormContent): array
    {
        $flexFormService = GeneralUtility::makeInstance(FlexFormService::class);
        return $flexFormService->convertFlexFormContentToArray($flexFormContent);
    }

    /**
     * Map the CodeSnippetLanguage constants to the string expected by prism where they differ
     */
    private function getProgrammingLanguageStringForPrism(string $programmingLanguage): string
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
