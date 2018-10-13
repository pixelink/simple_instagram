<?php
/**
 * Created by PhpStorm.
 * User: briezler
 * Date: 13.10.18
 * Time: 15:18
 */

namespace Pixelink\SimpleInstagram\Domain\Repository;

use Vinkla\Instagram\Instagram;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class InstagramRepository
{

    protected $instagram = null;

    public function __construct()
    {
        $this->instagram = GeneralUtility::makeInstance(Instagram::class, '1349960364.d7908a2.5212b25429ac4c979231d3f122a3de3c');
    }

    public function getMedia() {
        return $this->instagram->media();
    }

    public function getUserInfo() {
        return $this->instagram->self();
    }

}