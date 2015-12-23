<?php

$EM_CONF[$_EXTKEY] = [
    'title'            => 'Code Snippet CE',
    'description'      => 'A content element to render code snippet of various programming languages.',
    'category'         => 'fe',
    'author'           => 'Daniel Goerz',
    'author_email'     => 'ervaude@gmail.com',
    'state'            => 'stable',
    'uploadfolder'     => false,
    'clearCacheOnLoad' => 1,
    'author_company'   => '',
    'version'          => '1.0.0',
    'constraints'      =>
        [
            'depends'   =>
                [
                    'typo3' => '7.6.2-8.99.99',
                ],
            'conflicts' => [],
            'suggests'  => [],
        ],
    'createDirs'       => null,
    'clearcacheonload' => true,
    'autoload'         => [
        'psr-4' => [
            'DanielGoerz\\FsCodeSnippet\\' => 'Classes'
        ]
    ]
];
