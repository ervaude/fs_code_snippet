<?php
namespace DanielGoerz\FsCodeSnippet\Utility;

/**
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
use TYPO3\CMS\T3editor\Form\Element\T3editorElement;

/**
 * Class ExtensionConfigurationUtility
 *
 * @author Daniel Goerz <ervaude@gmail.com>
 */
class FsCodeSnippetConfigurationUtility
{
    /**
     * Returns the extension configuration for fs_code_snippet as array.
     *
     * @return array
     */
    private static function getExtensionConfiguration()
    {
        return unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['fs_code_snippet']);
    }

    /**
     * Returns whether all languages are enabled in the extension manager
     *
     * @return bool
     */
    public static function isAllLanguagesEnabled()
    {
        $conf = self::getExtensionConfiguration();
        return !empty($conf['enableAllLanguages']);
    }

    /**
     * Returns the TCA Item array with all supported languages.
     *
     * @return array
     */
    private static function getItemArrayForAllLanguages()
    {
        $supportedLanguages = CodeSnippetLanguage::getConstants();
        $items = [];
        foreach ($supportedLanguages as $supportedLanguage) {
            switch ($supportedLanguage) {
                case CodeSnippetLanguage::CPP:
                    $label = 'C++';
                    break;
                case CodeSnippetLanguage::MARKUP:
                    continue 2;
                case CodeSnippetLanguage::C_LIKE:
                    $label = 'C-Like';
                    break;
                case CodeSnippetLanguage::ABAP:
                    $label = 'ABAP';
                    break;
                case CodeSnippetLanguage::ACTIONSCRIPT:
                    $label = 'ActionScript';
                    break;
                case CodeSnippetLanguage::APACHE_CONFIGURATION:
                    $label = 'Apache Configuration';
                    break;
                case CodeSnippetLanguage::APL:
                    $label = 'APL';
                    break;
                case CodeSnippetLanguage::APPLESCRIPT:
                    $label = 'AppleScript';
                    break;
                case CodeSnippetLanguage::ASCIIDOC:
                    $label = 'AsciiDoc';
                    break;
                case CodeSnippetLanguage::ASP_NET:
                    $label = 'ASP.NET (C#)';
                    break;
                case CodeSnippetLanguage::AUTOIT:
                    $label = 'AutoIt';
                    break;
                case CodeSnippetLanguage::AUTOHOTKEY:
                    $label = 'AutoHotkey';
                    break;
                case CodeSnippetLanguage::BASIC:
                    $label = 'BASIC';
                    break;
                case CodeSnippetLanguage::CSHARP:
                    $label = 'C#';
                    break;
                case CodeSnippetLanguage::COFFEESCRIPT:
                    $label = 'CoffeeScript';
                    break;
                case CodeSnippetLanguage::FSHARP:
                    $label = 'F#';
                    break;
                case CodeSnippetLanguage::GLSL:
                    $label = 'GLSL';
                    break;
                case CodeSnippetLanguage::HTTP:
                    $label = 'HTTP';
                    break;
                case CodeSnippetLanguage::JSON:
                    $label = 'JSON';
                    break;
                case CodeSnippetLanguage::LATEX:
                    $label = 'LaTeX';
                    break;
                case CodeSnippetLanguage::LOLCODE:
                    $label = 'LOLCODE';
                    break;
                case CodeSnippetLanguage::MATLAB:
                    $label = 'MATLAB';
                    break;
                case CodeSnippetLanguage::MEL:
                    $label = 'MEL';
                    break;
                case CodeSnippetLanguage::N4JS:
                    $label = 'N4JS';
                    break;
                case CodeSnippetLanguage::NASM:
                    $label = 'NASM';
                    break;
                case CodeSnippetLanguage::NGINX:
                    $label = 'nginx';
                    break;
                case CodeSnippetLanguage::NSIS:
                    $label = 'NSIS';
                    break;
                case CodeSnippetLanguage::OBJECTIVE_C:
                    $label = 'Objective-C';
                    break;
                case CodeSnippetLanguage::OCAML:
                    $label = 'OCaml';
                    break;
                case CodeSnippetLanguage::OPENCL:
                    $label = 'OpenCL';
                    break;
                case CodeSnippetLanguage::PARI_GP:
                    $label = 'PARI/GP';
                    break;
                case CodeSnippetLanguage::PHP:
                    $label = 'PHP';
                    break;
                case CodeSnippetLanguage::POWERSHELL:
                    $label = 'PowerShell';
                    break;
                case CodeSnippetLanguage::REACT_JSX:
                    $label = 'React JSX';
                    break;
                case CodeSnippetLanguage::REST:
                    $label = 'reST (reStructuredText) ';
                    break;
                case CodeSnippetLanguage::SAS:
                    $label = 'SAS';
                    break;
                case CodeSnippetLanguage::SASS_SASS:
                    $label = 'Sass (Sass)';
                    break;
                case CodeSnippetLanguage::SASS_SCSS:
                    $label = 'Sass (Scss)';
                    break;
                case CodeSnippetLanguage::TYPESCRIPT:
                    $label = 'TypeScript';
                    break;
                case CodeSnippetLanguage::TYPOSCRIPT:
                    $label = 'TypoScript';
                    break;
                case CodeSnippetLanguage::VBNET:
                    $label = 'VB.NET';
                    break;
                case CodeSnippetLanguage::VIM:
                    $label = 'vim';
                    break;
                case CodeSnippetLanguage::WIKI_MARKUP:
                    $label = 'Wiki markup';
                    break;
                case CodeSnippetLanguage::YAML:
                    $label = 'YAML';
                    break;
                default:
                    $label = ucfirst($supportedLanguage);
            }
            $items[] = [$label, $supportedLanguage];
        }
        usort($items, function ($a, $b) {
            return strcmp($a[0], $b[0]);
        });
        array_unshift($items, ['none', T3editorElement::MODE_MIXED]);
        return $items;
    }

    /**
     * Provides item array for TCA
     *
     * @return array
     */
    public static function getItemArrayForTCA()
    {
        if (self::isAllLanguagesEnabled()) {
            return self::getItemArrayForAllLanguages();
        }
        return [
            ['None',            T3editorElement::MODE_MIXED],
            ['Apache Config',   CodeSnippetLanguage::APACHE_CONFIGURATION],
            ['Bash',            CodeSnippetLanguage::BASH],
            ['Command-line',    CodeSnippetLanguage::COMMANDLINE],
            ['CSS',             CodeSnippetLanguage::CSS],
            ['HTML',            CodeSnippetLanguage::HTML],
            ['JavaScript',      CodeSnippetLanguage::JAVASCRIPT],
            ['JSON',            CodeSnippetLanguage::JSON],
            ['PHP',             CodeSnippetLanguage::PHP],
            ['Typoscript',      CodeSnippetLanguage::TYPOSCRIPT],
            ['XML',             CodeSnippetLanguage::XML]
        ];
    }
}
