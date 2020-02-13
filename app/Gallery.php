<?php

namespace App;

use Illuminate\Support\Collection;

class Gallery
{
    /**
     * @var string
     */
    private $basename;

    /**
     * @var string
     */
    private $path;

    /**
     * @var Collection<Image>
     */
    private $images;

    /**
     * @var GalleryInfo|null
     */
    private $galleryInfo = null;

    /**
     * @param string $basename
     * @param string $path
     * @param Collection $images
     * @param string|null $galleryInfoJsonStr
     */
    public function __construct(string $basename, string $path, Collection $images, string $galleryInfoJsonStr = null)
    {
        $this->basename = $basename;
        $this->path = $path;
        $this->images = $images;
        $this->galleryInfo = GalleryInfo::fromJsonStr($galleryInfoJsonStr);
    }

    /**
     * @return string
     */
    public function getBasename(): string
    {
        return $this->basename;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @return GalleryInfo|null
     */
    public function getGalleryInfo(): ?GalleryInfo
    {
        return $this->galleryInfo;
    }
}
