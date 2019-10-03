<?php
namespace DanielGoerz\FsCodeSnippet\ExpressionLanguage;

/*
 * This file is part of TYPO3 CMS-based extension fs_code_snippet.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use TYPO3\CMS\Core\ExpressionLanguage\AbstractProvider;

/**
 * Class CodeSnippetConditionProvider
 *
 * @author Daniel Goerz <usetypo3@posteo.de>
 */
class CodeSnippetConditionProvider extends AbstractProvider
{
    public function __construct()
    {
        $this->expressionLanguageVariables = [
            'fsCodeSnippet' => new CodeSnippetConfigurationWrapper()
        ];
    }
}
