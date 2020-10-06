<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'SiteConfig Modifier',
    'description' => 'Adds the new TypoScript modifier := getSiteConfig() for TYPO3',
    'category' => 'misc',
    'author' => 'Felix Althaus',
    'author_email' => 'felix.althaus@undkonsorten.com',
    'state' => 'beta',
    'uploadfolder' => '',
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'version' => '0.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0 - 9.99.99',
            'php' => '^7.2 || ^7.3',
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Undkonsorten\\SiteConfigModifier\\' => 'Classes/'
        ]
    ],
];
