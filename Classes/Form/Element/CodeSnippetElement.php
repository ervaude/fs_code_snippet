<?php
namespace DanielGoerz\FsCodeSnippet\Form\Element;

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
use TYPO3\CMS\T3editor\Form\Element\T3editorElement;

/**
 * CodeSnippetElement FormEngine widget
 *
 * Makes sure we load the correct tokenizer and js for the T3Editor
 */
class CodeSnippetElement extends T3editorElement
{
    const MODE_BASH = 'bash';

    /**
     * Render t3editor element
     *
     * @return array As defined in initializeResultArray() of AbstractNode
     */
    public function render()
    {
        $this->allowedModes[] = self::MODE_BASH;
        if (!empty($this->data['databaseRow']['programming_language'][0])) {
            $this->data['parameterArray']['fieldConf']['config']['format'] = $this->data['databaseRow']['programming_language'][0];
        }
        try {
            return parent::render();
        } catch (\InvalidArgumentException $e) {
            // Format not allowed internally
            $this->data['parameterArray']['fieldConf']['config']['format'] = self::MODE_MIXED;
        }
        return parent::render();
    }

    /**
     * Determine the correct parser js file for given mode
     *
     * @param string $mode
     * @return string Parser file name
     */
    protected function getParserfileByMode($mode)
    {
        if ($mode === self::MODE_PHP) {
            return json_encode(['../contrib/php/js/tokenizephp.js', '../contrib/php/js/parsephp.js']);
        }
        if ($mode === self::MODE_BASH) {
            $mode = self::MODE_MIXED;
        }
        return parent::getParserfileByMode($mode);
    }

    /**
     * Determine the correct css file for given mode
     *
     * @param string $mode
     * @return string css file name
     */
    protected function getStylesheetByMode($mode)
    {
        if ($mode === self::MODE_BASH) {
            $mode = self::MODE_MIXED;
        }
        return parent::getStylesheetByMode($mode);
    }
}
