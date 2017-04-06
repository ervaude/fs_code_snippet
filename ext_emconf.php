<?php

$EM_CONF[$_EXTKEY] = [
    'title'            => 'Code Snippet CE',
    'description'      => 'A content element to render code snippet of various programming languages.',
    'category'         => 'fe',
    'author'           => 'Daniel Goerz',
    'author_email'     => 'ervaude@gmail.com',
    'state'            => 'stable',
    'uploadfolder'     => false,
    'createDirs'       => '',
    'clearCacheOnLoad' => 1,
    'author_company'   => '',
    'version'          => '1.8.0',
    'constraints'      => [
        'depends'   => [
            'typo3' => '7.6.0-8.7.99',
            'fluid_styled_content' => '',
            't3editor' => ''
        ],
        'conflicts' => [],
        'suggests'  => [],
    ],
    'autoload'         => [
        'psr-4' => [
            'DanielGoerz\\FsCodeSnippet\\' => 'Classes'
        ]
    ]
];
