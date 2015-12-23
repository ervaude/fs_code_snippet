<?php
defined('TYPO3_MODE') || exit('Access denied.');

if (TYPO3_MODE === 'BE') {
    call_user_func(
        function ($extKey) {
            // Register for hook to show a preview of elements of CType="f_code_snippet" in page module
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem'][$extKey] = \DanielGoerz\FsCodeSnippet\Hook\CodeSnippetPreviewRenderer::class;

            /** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
            $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
            $iconRegistry->registerIcon(
                'fs-code-snippet',
                \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
                ['source' => 'EXT:' . $extKey . '/Resources/Public/Images/code-snippet-icon.png']
            );

            $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1449747562] = array(
                'nodeName' => $extKey,
                'priority' => 50,
                'class' => \DanielGoerz\FsCodeSnippet\Form\Element\CodeSnippetElement::class,
            );

            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $extKey . '/Configuration/PageTSconfig/PageTSconfig.ts">');
        },
        $_EXTKEY
    );
}
