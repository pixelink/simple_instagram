<?php

namespace Pixelink\SimpleInstagram\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Http\RequestFactory;

class ImageService
{
    /**
     * @var string
     */
    protected $imageFolder = 'typo3temp/assets/simple_instagram/images/';

    /**
     * @var bool
     */
    protected $storeImages = true;

    /**
     * Store images locally.
     * @param array $entries
     * @throws FetchCouldNotBeResolvedException
     */
    public function persistImages($entries): array
    {
        if ($this->storeImages === true) {
            $path = GeneralUtility::getFileAbsFileName($this->imageFolder);
            GeneralUtility::mkdir_deep($path);

            foreach ($entries as $item) {
                $guid = $item->getId();
                $imageUrl = $item->getThumbnailSrc();
                $pathAndName = GeneralUtility::getFileAbsFileName($this->imageFolder) . $guid . '.jpg';
                if (is_file($pathAndName) === false && $imageUrl !== '') {
                    $imageContent = $this->getImageContent($imageUrl);
                    GeneralUtility::writeFile($pathAndName, $imageContent, true);
                }
            }
        }
        return $entries;
    }

    /**
     * @param string $url
     * @return string
     * @throws FetchCouldNotBeResolvedException
     */
    protected function getImageContent(string $url): string
    {
        $content = '';
        try {
            $requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
            /** @var Response $response */
            $response = $requestFactory->request($url, 'GET', ['headers' => ['Cache-Control' => 'no-cache']]);
            if ($response->getStatusCode() === 200) {
                $content = $response->getBody()->getContents();
            } else {
                throw new FetchCouldNotBeResolvedException('Image could not be fetched from ' . $url, 1588947571);
            }
        } catch (\Exception $exception) {
            throw new FetchCouldNotBeResolvedException($exception->getMessage(), 1588947539);
        }
        return $content;
    }
}