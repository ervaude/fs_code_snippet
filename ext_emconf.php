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
    'version'          => '1.2.0',
    'constraints'      => [
        'depends'   => [
            'typo3' => '7.6.0-7.6.99',
            'fluid_styled_content' => '7.6.0'
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
