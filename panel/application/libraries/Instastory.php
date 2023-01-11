<?php

use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Instagram\Utils\MediaDownloadHelper;

class Instastory
{
    public $cachePool = null;
    public $api = null;
    public $profile = null;

    public function __construct()
    {
        $this->cachePool = new FilesystemAdapter('Instastory', 0, __DIR__ . '/../cache');
        $this->api = new Api($this->cachePool);
    }

    public function login($username = null, $password = null)
    {
        return $this->api->login($username, $password);
    }

    public function getProfile($profile = null)
    {
        return $this->profile = $this->api->getProfile($profile);
    }

    public function getMedias()
    {
        return $this->profile->getMedias();
    }

    public function downloadMedias()
    {
        if (!empty($this->getMedias())) {
            // define directory
            $downloadDir = __DIR__ . '/../../uploads/instastory'; // change it
            foreach ($this->getMedias() as $mediaKey => $mediaValue) {
                $url = substr(str_replace('/', '-', parse_url($mediaValue->getDisplaySrc(), PHP_URL_PATH)), 1);
                $filePath = $downloadDir . '/' . $url;
                if (file_exists($filePath)) {
                    continue;
                } else {
                    MediaDownloadHelper::downloadMedia($mediaValue->getDisplaySrc(), $downloadDir);
                }
            }
        }
    }
}
