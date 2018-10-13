<?php
/**
 * Created by PhpStorm.
 * User: briezler
 * Date: 13.10.18
 * Time: 15:18
 */

namespace Pixelink\SimpleInstagram\Domain\Repository;

use Vinkla\Instagram\Instagram;
use TYPO3\CMS\Core\Utility\GeneralUtility;;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;

class InstagramRepository
{

    protected $instagram = null;

    public function __construct()
    {

        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $configurationManager = $objectManager->get(ConfigurationManager::class);
        $extbaseFrameworkConfiguration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $settings = $extbaseFrameworkConfiguration['plugin.']['tx_simpleinstagram_instafeed.']['settings.'];

        $token = $settings['accessToken'];

        $this->instagram = GeneralUtility::makeInstance(Instagram::class,$token);
    }

    /**
     * get images
     * @return mixed
     */
    public function getMedia() {
        return $this->instagram->media();
    }

    /**
     * get account settings
     * @return mixed
     */
    public function getUserInfo() {
        return $this->instagram->self();
    }

}