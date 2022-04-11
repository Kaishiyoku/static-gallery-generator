<?php

namespace App\Data;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use League\Flysystem\FileAttributes;

class Image
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var int
     */
    private $timestamp;

    /**
     * @var int
     */
    private $size;

    /**
     * @var string
     */
    private $dirname;

    /**
     * @var string
     */
    private $basename;

    /**
     * @var string
     */
    private $extension;

    /**
     * @var string
     */
    private $filename;

    /**
     * @param FileAttributes $data
     * @return Image
     */
    public static function fromArray(FileAttributes $data): Image {
        $image = new Image();

        $image->path = $data->path();
        $image->timestamp = $data->lastModified();
        $image->size = $data->fileSize();
        $image->dirname = File::dirname($data->path());
        $image->basename = File::basename($data->path());
        $image->extension = File::extension($data->path());
        $image->filename = File::name($data->path());

        return $image;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
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
    public function getBasename(): string
    {
        return $this->basename;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getBasenameWithSlug(): string
    {
        return Str::slug($this->getBasename());
    }

    /**
     * @param string|null $suffix
     * @return string
     */
    public function getPathWithSlug(?string $suffix = null): string
    {
        $directories = explode('/', $this->getDirname());

        $subDirname = Arr::last($directories);
        $otherDirname = implode('/', Arr::except($directories, count($directories) - 1));

        $fullDirname = $otherDirname . '/' . Str::slug($subDirname);

        return $fullDirname . '/' . Str::slug($this->getFilename()) . $suffix . '.' . $this->getExtension();
    }
}
