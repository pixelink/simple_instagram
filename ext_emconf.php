<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Simple Instagram',
    'description' => 'Shows a Instagram feed with a given access Token. Only installation via composer is supported!',
    'category' => 'plugin',
    'author' => 'Benjamin Riezler',
    'author_email' => 'b.riezler@pixel-ink.de',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '3.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-9.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
