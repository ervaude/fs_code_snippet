<?php
namespace DanielGoerz\FsCodeSnippet\Hook;

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
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Backend\View\PageLayoutView;

/**
 * Contains a preview rendering for the page module of CType="fs_code_snippet"
 */
class CodeSnippetPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{

    /**
     * Preprocesses the preview rendering of a content element of type "fs_code_snippet"
     *
     * @param \TYPO3\CMS\Backend\View\PageLayoutView $parentObject Calling parent object
     * @param bool $drawItem Whether to draw the item using the default functionality
     * @param string $headerContent Header content
     * @param string $itemContent Item content
     * @param array $row Record row of tt_content
     * @return void
     */
    public function preProcess(
        PageLayoutView &$parentObject,
        &$drawItem,
        &$headerContent,
        &$itemContent,
        array &$row
    ) {
        if ($row['CType'] === 'fs_code_snippet') {
            $limit = 5;
            $lines = explode("\n", $row['bodytext']);
            if (count($lines) > $limit) {
                $maximumItems = array_slice($lines, 0, $limit);
                $maximumItems[] = '...';
                $row['bodytext'] = implode("\n", $maximumItems);
                $row['bodytext'] = rtrim($row['bodytext'], "\n\r");
            }
            $row['bodytext'] = str_replace(['<', '>'], ['&lt', '&gt'], $row['bodytext']);
            $itemContent = '<strong>' . $this->getProgrammingLanguageLabel($row['programming_language']) . ':</strong><br />';
            $itemContent .= '<pre><code>' . $row['bodytext'] . '</code></pre>';
            $drawItem = false;
        }
    }

    /**
     * @param string $value
     * @return string
     */
    protected function getProgrammingLanguageLabel($value)
    {
        $programmingLanguages = $GLOBALS['TCA']['tt_content']['columns']['programming_language']['config']['items'];
        foreach ($programmingLanguages as $programmingLanguage) {
            if ($programmingLanguage[1] === $value) {
                return $programmingLanguage[0];
            }
        }
        return $value;
    }
}
