<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Code Snippet CE',
    'description' => 'A content element to render code snippet of various programming languages.',
    'category' => 'fe',
    'author' => 'Daniel Goerz',
    'author_email' => 'usetypo3@posteo.de',
    'state' => 'stable',
    'uploadfolder' => false,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author_company' => '',
    'version' => '3.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-10.4.99',
            'fluid_styled_content' => '',
            't3editor' => ''
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'DanielGoerz\\FsCodeSnippet\\' => 'Classes'
        ]
    ]
];
