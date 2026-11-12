<?php

namespace DanielGoerz\FsCodeSnippet\Utility;

/*
 * This file is part of TYPO3 CMS-based extension fs_code_snippet.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use DanielGoerz\FsCodeSnippet\Enumeration\CodeSnippetLanguage;

class FsCodeSnippetConfigurationUtility
{
    public static function getItemArrayForTCA(): array
    {
        return [
            [
                'label' => 'Apache Config',
                'value' => CodeSnippetLanguage::APACHE_CONFIGURATION,
            ],
            [
                'label' => 'Bash',
                'value' => CodeSnippetLanguage::BASH,
            ],
            [
                'label' => 'Command-line',
                'value' => CodeSnippetLanguage::COMMANDLINE,
            ],
            [
                'label' => 'CSS',
                'value' => CodeSnippetLanguage::CSS,
            ],
            [
                'label' => 'HTML',
                'value' => CodeSnippetLanguage::HTML,
            ],
            [
                'label' => 'JavaScript',
                'value' => CodeSnippetLanguage::JAVASCRIPT,
            ],
            [
                'label' => 'JSON',
                'value' => CodeSnippetLanguage::JSON,
            ],
            [
                'label' => 'PHP',
                'value' => CodeSnippetLanguage::PHP,
            ],
            [
                'label' => 'Typoscript',
                'value' => CodeSnippetLanguage::TYPOSCRIPT,
            ],
            [
                'label' => 'XML',
                'value' => CodeSnippetLanguage::XML,
            ],
            [
                'label' => 'YAML',
                'value' => CodeSnippetLanguage::YAML,
            ]
        ];
    }
}
