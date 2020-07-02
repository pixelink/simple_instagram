<?php
/**
 * Created by PhpStorm.
 * User: briezler
 * Date: 13.10.18
 * Time: 15:18
 */

namespace Pixelink\SimpleInstagram\Domain\Repository;

use Instagram\Api;
use Pixelink\SimpleInstagram\Service\ImageService;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\GeneralUtility;

;

use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;

class InstagramRepository
{
    /** @var ImageService
     */
    private $imageService;
    protected $instagram = null;
    protected $instaAccount;

    public function __construct()
    {
        $this->imageService = GeneralUtility::makeInstance(ImageService::class);
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $configurationManager = $objectManager->get(ConfigurationManager::class);
        $extbaseFrameworkConfiguration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $settings = $extbaseFrameworkConfiguration['plugin.']['tx_simpleinstagram_instafeed.']['settings.'];
        $username = $settings['username'];
        $password = $settings['password'];
        $this->instaAccount = $settings['instaAccount'];
        $this->instagram = GeneralUtility::makeInstance(Api::class);


    }

    /**
     * get entries
     * @return mixed
     */
    public function getMedia()
    {
        //$this->instagram->login($username, $password);
        $this->instagram->setUserName($this->instaAccount);
        $feed = $this->instagram->getFeed();
        $entries = $feed->getMedias();

        $this->imageService->persistImages($entries);
        return $entries;
    }

    /**
     * get account settings
     * @return mixed
     */
    public function getUserInfo()
    {
        return $this->instagram->getProfile();
    }

}