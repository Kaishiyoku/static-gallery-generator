<?php

namespace App;

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
     * @param array $data
     * @return Image
     */
    public static function fromArray(array $data): Image {
        $image = new Image();

        $image->path = $data['path'];
        $image->timestamp = $data['timestamp'];
        $image->size = $data['size'];
        $image->dirname = $data['dirname'];
        $image->basename = $data['basename'];
        $image->extension = $data['extension'];
        $image->filename = $data['filename'];

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
}
