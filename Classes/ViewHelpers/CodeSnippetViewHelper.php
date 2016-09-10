<?php

namespace DanielGoerz\FsCodeSnippet\ViewHelpers;

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
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * Class CodeSnippetViewHelper
 *
 * @author Daniel Goerz <dlg@lightwerk.com>
 */
class CodeSnippetViewHelper extends AbstractTagBasedViewHelper
{

    /**
     * @var string
     */
    protected $tagName = 'pre';

    /**
     * @var array
     */
    protected $classes = [];

    /**
     * Initialize ViewHelper arguments
     *
     * @return void
     */
    public function initializeArguments()
    {
        $this->registerArgument('commandLine', 'array', 'Configuration for commandLine mode.', false, []);
        $this->registerArgument('lineNumbers', 'bool', 'Flag whether line numbers are enabled.', false, true);
        $this->registerArgument('programmingLanguage', 'string', 'Name of the programming language for this snippet', true, CodeSnippetLanguage::MARKUP);
    }

    /**
     * @return string
     */
    public function render()
    {
        if ($this->isCommandLine()) {
            $this->addCommandLineAttributes($this->arguments['commandLine']);
        }

        if ($this->hasLineNumbers()) {
            $this->addClass('line-numbers');
        }

        $this->addGeneralAttributes();

        return $this->tag->render();
    }

    /**
     * @return bool
     */
    protected function isCommandLine()
    {
        return $this->hasArgument('commandLine') && !empty($this->arguments['commandLine']);
    }

    /**
     * @return bool
     */
    protected function hasLineNumbers()
    {
        return !$this->isCommandLine() && $this->hasArgument('lineNumbers') && !empty($this->arguments['lineNumbers']);
    }

    /**
     * @return void
     */
    protected function addGeneralAttributes()
    {
        $this->addClass('language-' . $this->arguments['programmingLanguage']);
        $this->tag->addAttribute('class', implode(' ', $this->classes));
        $this->tag->addAttribute('data-language', $this->arguments['programmingLanguage']);
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);
    }

    /**
     * @param array $commandLineConfig
     * @return void
     */
    protected function addCommandLineAttributes(array $commandLineConfig)
    {
        $this->addClass('command-line');
        if (!empty($commandLineConfig['output'])) {
            $this->tag->addAttribute('data-output', $commandLineConfig['output']);
        }
        if (!empty($commandLineConfig['promt'])) {
            $this->tag->addAttribute('data-prompt', $commandLineConfig['promt']);
            return;
        }
        $this->tag->addAttribute('data-user', $commandLineConfig['user'] ?: 'user');
        $this->tag->addAttribute('data-host', $commandLineConfig['host'] ?: 'host');
    }

    /**
     * @param string $class
     * @return void
     */
    protected function addClass($class)
    {
        $this->classes[] = $class;
    }
}
