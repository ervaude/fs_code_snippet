<?php /** @noinspection PhpUndefinedVariableInspection */

$EM_CONF[$_EXTKEY] = [
    'title' => 'Code Snippet CE',
    'description' => 'A content element to render code snippet of various programming languages.',
    'category' => 'fe',
    'author' => 'Daniel Goerz',
    'author_email' => 'usetypo3@posteo.de',
    'state' => 'stable',
    'author_company' => '',
    'version' => '4.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-14.3.99',
            'fluid_styled_content' => ''
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
