<?php

namespace App\Data;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GalleryInfo
{
    /**
     * @var string@null
     */
    private $name;

    /**
     * @var string
     */
    private $layout;

    /**
     * @param string|null $str
     * @return GalleryInfo|null
     */
    public static function fromJsonStr(?string $str): ?GalleryInfo
    {
        $jsonData = $str ? json_decode($str, true, 512) : [];

        $galleryInfo = new GalleryInfo();
        $galleryInfo->name = Arr::get($jsonData, 'name');
        $galleryInfo->layout = Arr::get($jsonData, 'layout', 'default');

        return $galleryInfo;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLayout(): string
    {
        return $this->layout;
    }
}
