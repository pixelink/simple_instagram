<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Pixelink.SimpleInstagram',
            'Instafeed',
            'Instagram Feed'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('simple_instagram', 'Configuration/TypoScript', 'Simple Instagram');

    }
);
