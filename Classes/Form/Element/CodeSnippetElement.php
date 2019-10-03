<?php
namespace DanielGoerz\FsCodeSnippet\Form\Element;

/*
 * This file is part of TYPO3 CMS-based extension fs_code_snippet.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use DanielGoerz\FsCodeSnippet\Enumeration\CodeSnippetLanguage;
use TYPO3\CMS\T3editor\Form\Element\T3editorElement;

/**
 * CodeSnippet FormEngine Element
 *
 * Makes sure we load the correct codemirror mode for the T3Editor
 * @author Daniel Goerz <usetypo3@posteo.de>
 */
class CodeSnippetElement extends T3editorElement
{
    /**
     * Render t3editor element
     *
     * @return array As defined in initializeResultArray() of AbstractNode
     */
    public function render(): array
    {
        switch ($this->data['databaseRow']['programming_language'][0] ?? '') {
            case CodeSnippetLanguage::PHP:
                $identifier = 'php';
                break;
            case CodeSnippetLanguage::JAVASCRIPT:
                $identifier = 'javascript';
                break;
            case CodeSnippetLanguage::TYPOSCRIPT:
                $identifier = 'typoscript';
                break;
            case CodeSnippetLanguage::MARKUP:
            case CodeSnippetLanguage::XML:
                $identifier = 'html';
                break;
            case CodeSnippetLanguage::CSS:
                $identifier = 'css';
                break;
            default:
                $identifier = '';
        }
        if (empty($identifier)) {
            unset($this->data['parameterArray']['fieldConf']['config']['format']);
        } else {
            $this->data['parameterArray']['fieldConf']['config']['format'] = $identifier;
        }
        return parent::render();
    }
}
