<?php

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class GalleryInfo
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Collection<string>
     */
    private $imageDescriptions;

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
        $galleryInfo->imageDescriptions = collect(Arr::get($jsonData, 'imageDescriptions'))
            ->map(function ($imageDescription) {
                return parseMarkdown($imageDescription);
            });

        return $galleryInfo;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<string>
     */
    public function getImageDescriptions(): Collection
    {
        return $this->imageDescriptions;
    }
}
