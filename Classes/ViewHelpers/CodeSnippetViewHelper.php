<?php
namespace DanielGoerz\FsCodeSnippet\ViewHelpers;

/*
 * This file is part of TYPO3 CMS-based extension fs_code_snippet.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * This ViewHelper renders the <pre> tag for the code-snippet content element
 * with all data-attributes and classes that are needed.
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

    public function initializeArguments(): void
    {
        $this->registerArgument(
            'commandLine',
            'array',
            'Configuration for commandLine mode.',
            false,
            []
        );
        $this->registerArgument(
            'lineNumbers',
            'bool',
            'Flag whether line numbers are enabled.',
            false,
            true
        );
        $this->registerArgument(
            'programmingLanguage',
            'string',
            'Name of the programming language for this snippet',
            true
        );
    }

    public function render(): string
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

    protected function isCommandLine(): bool
    {
        return $this->hasArgument('commandLine') && !empty($this->arguments['commandLine']);
    }

    protected function hasLineNumbers(): bool
    {
        return !$this->isCommandLine() && $this->hasArgument('lineNumbers') && !empty($this->arguments['lineNumbers']);
    }

    protected function addGeneralAttributes(): void
    {
        $this->addClass('language-' . $this->arguments['programmingLanguage']);
        $this->tag->addAttribute('class', implode(' ', $this->classes));
        $this->tag->addAttribute('data-language', $this->arguments['programmingLanguage']);
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);
    }

    protected function addCommandLineAttributes(array $commandLineConfig): void
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

    protected function addClass(string $class): void
    {
        $this->classes[] = $class;
    }
}
