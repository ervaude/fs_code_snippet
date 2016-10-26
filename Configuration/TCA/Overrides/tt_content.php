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
                'items' => \DanielGoerz\FsCodeSnippet\Utility\FsCodeSnippetConfigurationUtility::getItemArrayForTCA(),
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
            programming_language,pi_flexform,
            bodytext,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
				layout;' . $frontendLanguageFilePrefix . 'layout_formlabel,
				--palette--;' . $frontendLanguageFilePrefix . 'palette.appearanceLinks;appearanceLinks,
            --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
        ',
    ];

    // Overwrite behavior of bodytext and pi_flexform for fs_code_snippet
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
        'pi_flexform' => [
            'label' => 'Command-line options',
            'displayCond' => 'FIELD:programming_language:=:' . \DanielGoerz\FsCodeSnippet\Enumeration\CodeSnippetLanguage::COMMANDLINE
        ]
    ];

    // Add a flexform to the fs_code_snippet CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        '',
        'FILE:EXT:fs_code_snippet/Configuration/FlexForms/fs_code_snippet_flexform.xml',
        'fs_code_snippet'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('fs_code_snippet', 'Configuration/TypoScript', 'Code Snippet CE');
});
