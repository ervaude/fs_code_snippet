<?php
defined('TYPO3_MODE') or die('Access denied!');

use DanielGoerz\FsCodeSnippet\Form\Element\CodeSnippetElement;
use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

if (TYPO3_MODE === 'BE') {
    call_user_func(
        function () {
            // Register for hook to show a preview of elements of CType="fs_code_snippet" in page module
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['fs_code_snippet']
                = \DanielGoerz\FsCodeSnippet\Hook\CodeSnippetPreviewRenderer::class;

            $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(IconRegistry::class);
            $iconRegistry->registerIcon(
                'fs-code-snippet',
                BitmapIconProvider::class,
                ['source' => 'EXT:fs_code_snippet/Resources/Public/Images/code-snippet-icon.png']
            );

            $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1449747562] = array(
                'nodeName' => 'fs_code_snippet',
                'priority' => 50,
                'class' => CodeSnippetElement::class,
            );

            ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:fs_code_snippet/Configuration/PageTSconfig/PageTSConfig.tsconfig">');
        }
    );
}
