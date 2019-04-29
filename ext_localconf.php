<?php
defined('TYPO3_MODE') || exit('Access denied.');

if (TYPO3_MODE === 'BE') {
    call_user_func(
        function () {
            // Register for hook to show a preview of elements of CType="fs_code_snippet" in page module
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['fs_code_snippet']
                = \DanielGoerz\FsCodeSnippet\Hook\CodeSnippetPreviewRenderer::class;

            $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
            $iconRegistry->registerIcon(
                'fs-code-snippet',
                \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
                ['source' => 'EXT:fs_code_snippet/Resources/Public/Images/code-snippet-icon.png']
            );

            $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1449747562] = array(
                'nodeName' => 'fs_code_snippet',
                'priority' => 50,
                'class' => \DanielGoerz\FsCodeSnippet\Form\Element\CodeSnippetElement::class,
            );

            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:fs_code_snippet/Configuration/PageTSconfig/PageTSConfig.tsconfig">');
        }
    );
}
