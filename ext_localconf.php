<?php
defined('TYPO3') or die('Access denied!');

use DanielGoerz\FsCodeSnippet\Form\Element\CodeSnippetElement;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;


call_user_func(
    function () {
        // Register for hook to show a preview of elements of CType="fs_code_snippet" in page module
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['fs_code_snippet']
            = \DanielGoerz\FsCodeSnippet\Hook\CodeSnippetPreviewRenderer::class;

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1449747562] = [
            'nodeName' => 'fs_code_snippet',
            'priority' => 50,
            'class' => CodeSnippetElement::class,
        ];

        ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:fs_code_snippet/Configuration/PageTSconfig/PageTSConfig.tsconfig">');
    }
);
