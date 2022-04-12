<?php

namespace App\Data;

use ColorThief\Color;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Gallery
{
    private string $basename;

    private string $dirname;

    private string $path;

    /**
     * @var Collection<Image>
     */
    private Collection $images;

    private Color $prominentColor;

    private ?GalleryInfo $galleryInfo = null;

    public function __construct(string $basename, string $dirname, string $path, Collection $images, Color $prominentColor, string $galleryInfoJsonStr = null)
    {
        $this->basename = $basename;
        $this->dirname = $dirname;
        $this->path = $path;
        $this->images = $images;
        $this->prominentColor = $prominentColor;
        $this->galleryInfo = GalleryInfo::fromJsonStr($galleryInfoJsonStr);
    }

    public function getBasename(): string
    {
        return $this->basename;
    }

    public function getDirname(): string
    {
        return $this->dirname;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function getProminentColor(): Color
    {
        return $this->prominentColor;
    }

    public function getGalleryInfo(): ?GalleryInfo
    {
        return $this->galleryInfo;
    }

    public function getPathWithSlug(): string
    {
        return $this->getDirname() . '/' . Str::slug($this->getBasename());
    }

    public function getCssClassName(): string
    {
        return 'gallery-' . Str::slug($this->getBaseName());
    }

    public function getProminentColorAsRgba(float $alpha): string
    {
        return 'rgba(' . implode(', ', $this->getProminentColor()->getArray()) . ', ' . $alpha . ')';
    }
}
