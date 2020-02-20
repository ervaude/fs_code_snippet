<?php
namespace DanielGoerz\FsCodeSnippet\Hook;

/*
 * This file is part of TYPO3 CMS-based extension fs_code_snippet.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Backend\View\PageLayoutView;

/**
 * Contains the preview rendering in the page module for CType="fs_code_snippet"
 *
 * @author Daniel Goerz <usetypo3@posteo.de>
 */
class CodeSnippetPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{
    /**
     * Preprocesses the preview rendering of a content element of type "fs_code_snippet"
     *
     * @param PageLayoutView $parentObject Calling parent object
     * @param bool $drawItem Whether to draw the item using the default functionality
     * @param string $headerContent Header content
     * @param string $itemContent Item content
     * @param array $row Record row of tt_content
     */
    public function preProcess(
        PageLayoutView &$parentObject,
        &$drawItem,
        &$headerContent,
        &$itemContent,
        array &$row
    ): void {
        // Process only fs_code_snippet
        if ($row['CType'] !== 'fs_code_snippet') {
            return;
        }

        $itemContent = '<strong>' . $this->getProgrammingLanguageLabel($row['programming_language']) . ':</strong><br />' .
            '<pre><code>' . $this->prepareCodeSnippet($row['bodytext']) . '</code></pre>';

        $drawItem = false;
    }

    /**
     * Strips the content of the code snippet to a maximum of $limit lines
     * and removes opening and closing HTML tags as well as empty lines at the end.
     */
    protected function prepareCodeSnippet(string $codeSnippet, int $limit = 5): string
    {
        $lines = explode("\n", $codeSnippet);
        if (count($lines) > $limit) {
            $maximumItems = array_slice($lines, 0, $limit);
            $maximumItems[] = '...';
            $codeSnippet = implode("\n", $maximumItems);
            $codeSnippet = rtrim($codeSnippet, "\n\r");
        }
        return str_replace(['<', '>'], ['&lt', '&gt'], $codeSnippet);
    }

    protected function getProgrammingLanguageLabel(string $value): string
    {
        foreach ($GLOBALS['TCA']['tt_content']['columns']['programming_language']['config']['items'] as $programmingLanguage) {
            if ($programmingLanguage[1] === $value) {
                return $programmingLanguage[0];
            }
        }
        return $value;
    }
}
