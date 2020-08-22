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
            'onChange' => 'reload',
            'exclude' => true,
            'label' => 'Programming Language',
            'description' => 'Select the coding language so that the correct syntax highlighting can be applied in the frontend.',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => \DanielGoerz\FsCodeSnippet\Utility\FsCodeSnippetConfigurationUtility::getItemArrayForTCA(),
                'default' => \DanielGoerz\FsCodeSnippet\Enumeration\CodeSnippetLanguage::PHP
            ]
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $newColumn);

    // Use type icon
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['fs_code_snippet'] = 'fs-code-snippet';
    // What fields should be displayed
    $GLOBALS['TCA']['tt_content']['types']['fs_code_snippet'] = [
        'showitem' => '
            programming_language,pi_flexform,
            bodytext,
            --div--;' . $frontendLanguageFilePrefix . 'header,
            --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
            --palette--;' . $frontendLanguageFilePrefix . 'palette.header;header,
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
            'description' => 'Syntax highlighting in the backend is limited to PHP, JavaScript, CSS, TypoScript and HTMl. Full syntax highlighting will be applied in the frontend.',
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
});
