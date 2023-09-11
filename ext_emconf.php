<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Code Snippet CE',
    'description' => 'A content element to render code snippet of various programming languages.',
    'category' => 'fe',
    'author' => 'Daniel Goerz',
    'author_email' => 'usetypo3@posteo.de',
    'state' => 'stable',
    'author_company' => '',
    'version' => '3.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.0.0-12.4.99',
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
