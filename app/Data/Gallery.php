<?php

namespace App\Data;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Gallery
{
    /**
     * @var string
     */
    private $basename;

    /**
     * @var string
     */
    private $dirname;

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
     * @param string $dirname
     * @param string $path
     * @param Collection $images
     * @param string|null $galleryInfoJsonStr
     */
    public function __construct(string $basename, string $dirname, string $path, Collection $images, string $galleryInfoJsonStr = null)
    {
        $this->basename = $basename;
        $this->dirname = $dirname;
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
    public function getDirname(): string
    {
        return $this->dirname;
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

    /**
     * @return string
     */
    public function getPathWithSlug(): string
    {
        return $this->getDirname() . '/' . Str::slug($this->getBasename());
    }
}
