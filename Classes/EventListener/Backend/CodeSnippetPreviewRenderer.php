<?php

namespace DanielGoerz\FsCodeSnippet\EventListener\Backend;

/*
 * This file is part of TYPO3 CMS-based extension fs_code_snippet.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use TYPO3\CMS\Backend\View\Event\PageContentPreviewRenderingEvent;

/**
 * Contains the preview rendering in the page module for CType="fs_code_snippet"
 */
class CodeSnippetPreviewRenderer
{

    public function __invoke(PageContentPreviewRenderingEvent $event): void
    {
        if ($event->getRecord()['CType'] !== 'fs_code_snippet') {
            return;
        }
        $this->preProcess($event);
    }

    /**
     * Preprocesses the preview rendering of a content element of type "fs_code_snippet"
     *
     */
    public function preProcess(PageContentPreviewRenderingEvent $event): void
    {
        $itemContent = '<strong>' . $this->getProgrammingLanguageLabel($event->getRecord()['programming_language']) . ':</strong><br />' .
            '<pre><code>' . $this->prepareCodeSnippet($event->getRecord()['bodytext']). '</code></pre>';
        $event->setPreviewContent($itemContent);
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
            if ($programmingLanguage['value'] === $value) {
                return $programmingLanguage['label'];
            }
        }
        return $value;
    }
}
