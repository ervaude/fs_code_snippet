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
            ['Apache Config',   CodeSnippetLanguage::APACHE_CONFIGURATION],
            ['Bash',            CodeSnippetLanguage::BASH],
            ['Command-line',    CodeSnippetLanguage::COMMANDLINE],
            ['CSS',             CodeSnippetLanguage::CSS],
            ['HTML',            CodeSnippetLanguage::HTML],
            ['JavaScript',      CodeSnippetLanguage::JAVASCRIPT],
            ['JSON',            CodeSnippetLanguage::JSON],
            ['PHP',             CodeSnippetLanguage::PHP],
            ['Typoscript',      CodeSnippetLanguage::TYPOSCRIPT],
            ['XML',             CodeSnippetLanguage::XML],
            ['YAML',            CodeSnippetLanguage::YAML]
        ];
    }
}
