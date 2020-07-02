<?php

namespace Pixelink\SimpleInstagram\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Benjamin Riezler <support@pixel-ink.de>, Pixel Ink
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * InstagramController
 */
class InstagramController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /*
     * string cacheKey
     */
    protected $cacheKey = 'simpleInstagram';

    /**
     * Default cache live time is 24h
     *
     * @var int
     */
    protected $cacheLifeTime = 86400;
    /**
     * @var InstagramRepository
     */
    protected $instagramRepository = null;

    /**
     * @var CacheManager
     */
    private $cache;

    /**
     * InstagramController constructor.
     */
    public function __construct()
    {
        $this->cache = GeneralUtility::makeInstance(CacheManager::class)->getCache('simple_instagram_cache');
        $objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        $this->instagramRepository = $objectManager->get('Pixelink\SimpleInstagram\Domain\Repository\InstagramRepository');
    }

    /**
     * show media feeds 
     */
    public function showFeedAction()
    {
        $entries = $this->instagramRepository->getMedia();
        $this->getCachedMagic($entries);
        $this->view->assign('entries', $entries);
    }

    public function getCachedMagic($entry)
    {
        $cacheIdentifier = $this->getCacheIdentifier();

        // If $entry is null, it hasn't been cached. Calculate the value and store it in the cache:
        if (($entry = $this->cache->get($cacheIdentifier)) === false) {
            // Save value in cache
            $this->cache->set($cacheIdentifier, $entry, [$this->cacheKey], $this->cacheLifeTime);
        }
        return $entry;
    }

    /**
     * return string
     */
    public function getCacheIdentifier(): string
    {
        return sha1($this->cacheKey);
    }

}

