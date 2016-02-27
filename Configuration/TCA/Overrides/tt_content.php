<?php
defined('TYPO3_MODE') or die();

call_user_func(function () {

    $frontendLanguageFilePrefix = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:';

    // Add the CType "fs_code_snippet"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            'Code Snippet',
            'fs_code_snippet',
            'fs-code-snippet'
        ],
        'list',
        'after'
    );

    // Add the column programming_language too tt_content
    $newColumn = [
        'programming_language' => [
            'exclude' => true,
            'label' => 'Programming Language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['None', \TYPO3\CMS\T3editor\Form\Element\T3editorElement::MODE_MIXED],
                    ['Bash', \DanielGoerz\FsCodeSnippet\Enumeration\CodeSnippetLanguage::BASH],
                    ['CSS', \TYPO3\CMS\T3editor\Form\Element\T3editorElement::MODE_CSS],
                    ['HTML', \TYPO3\CMS\T3editor\Form\Element\T3editorElement::MODE_HTML],
                    ['JavaScript', \TYPO3\CMS\T3editor\Form\Element\T3editorElement::MODE_JAVASCRIPT],
                    ['PHP', \TYPO3\CMS\T3editor\Form\Element\T3editorElement::MODE_PHP],
                    ['Typoscript', \TYPO3\CMS\T3editor\Form\Element\T3editorElement::MODE_TYPOSCRIPT],
                    ['XML', \TYPO3\CMS\T3editor\Form\Element\T3editorElement::MODE_XML]
                ],
                'default' => \TYPO3\CMS\T3editor\Form\Element\T3editorElement::MODE_MIXED
            ]
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $newColumn);

    // Reload on change
    $GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] .= ',programming_language';
    // Use type icon
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['fs_code_snippet'] = 'fs-code-snippet';
    // What fields should be displayed
    $GLOBALS['TCA']['tt_content']['types']['fs_code_snippet'] = [
        'showitem' => '
            --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
            --palette--;' . $frontendLanguageFilePrefix . 'palette.header;header,
            programming_language,
            bodytext,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
        ',
    ];

    // Overwrite behavior of bodytext for fs_code_snippet
    $GLOBALS['TCA']['tt_content']['types']['fs_code_snippet']['columnsOverrides'] = [
        'bodytext' => [
            'label' => 'Code Snippet',
            'config' => [
                'type' => 'text',
                'renderType' => 'fs_code_snippet',
                'format' => 'html',
                'rows' => 20,
            ],
        ],
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('fs_code_snippet', 'Configuration/TypoScript', 'Code Snippet CE');
});
