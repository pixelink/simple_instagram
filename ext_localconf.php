<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Pixelink.SimpleInstagram',
            'Instafeed',
            [
                'Instagram' => 'showFeed'
            ],
            // non-cacheable actions
            [
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    instafeed {
                        iconIdentifier = simple_instagram-plugin-instafeed
                        title = LLL:EXT:simple_instagram/Resources/Private/Language/locallang_db.xlf:tx_simple_instagram_instafeed.name
                        description = LLL:EXT:simple_instagram/Resources/Private/Language/locallang_db.xlf:tx_simple_instagram_instafeed.description
                        tt_content_defValues {
                            CType = list
                            list_type = simpleinstagram_instafeed
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'simple_instagram-plugin-instafeed',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:simple_instagram/Resources/Public/Icons/user_plugin_instafeed.svg']
			);
		
    }
);

if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['simple_instagram_cache'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['simple_instagram_cache'] = [];
}