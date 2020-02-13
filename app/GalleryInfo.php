<?php

namespace App;

class GalleryInfo
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string|null $str
     * @return GalleryInfo|null
     */
    public static function fromJsonStr(string $str = null): ?GalleryInfo
    {
        if (!$str) {
            return null;
        }

        $jsonData = json_decode($str, true, 512, JSON_THROW_ON_ERROR);

        $galleryInfo = new GalleryInfo();
        $galleryInfo->name = $jsonData['name'];

        return $galleryInfo;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
