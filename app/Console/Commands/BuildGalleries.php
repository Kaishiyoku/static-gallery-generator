<?php

namespace App\Console\Commands;

use App\Gallery;
use App\Image;
use Closure;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class BuildGalleries extends Command
{
    /**
     * The maximum width in pixels image thumbnails should have
     *
     * @var int
     */
    private const MAX_THUMBNAIL_RESIZE_WIDTH = 1500;

    /**
     * The maximum width in pixels images should have
     *
     * @var int
     */
    private const MAX_IMAGE_RESIZE_WIDTH = 2000;

    /**
     * @var int
     */
    private const THUMBNAIL_QUALITY = 50;

    /**
     * @var int
     */
    private const IMAGE_QUALITY = 85;

    /**
     * Suffix of the thumbnail filenames
     *
     * @var string
     */
    public const THUMBNAIL_SUFFIX = '-thumbnail';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'galleries:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build all galleries';

    /**
     * @var ProgressBar
     */
    private $progressBar;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $localStorage = Storage::disk('local');
        $publicAdapter = new Local(publicPath());
        $publicFilesystem = new Filesystem($publicAdapter);

        $galleries = collect($localStorage->listContents('/galleries'))
            ->filter($this->filterByDir());

        $totalNumberOfImages = $galleries->reduce(function ($accum, $galleryData) {
            $images = $this->getImagesForGallery($galleryData);

            return $accum + $images->count();
        }, 0);

        $this->progressBar = $this->output->createProgressBar($totalNumberOfImages);

        $galleries = $galleries
            ->map($this->mapGalleries())
            ->each($this->storeHtml());

        $this->progressBar->finish();
        $this->line('');

        $indexPageView = view('index', ['galleries' => $galleries]);

        $publicFilesystem->put('index.html', $indexPageView->toHtml());

        $this->line('Finished.');
    }

    /**
     * Filter for directories only
     *
     * @return Closure
     */
    private function filterByDir(): Closure
    {
        return function ($data) {
            return $data['type'] === 'dir';
        };
    }

    /**
     * Map found "galleries", directories with images and store the images and generated HTML in the public folder
     *
     * @return Closure
     */
    private function mapGalleries(): Closure
    {
        $localStorage = Storage::disk('local');
        $publicAdapter = new Local(publicPath());
        $publicFilesystem = new Filesystem($publicAdapter);

        return function ($galleryData) use ($localStorage, $publicFilesystem) {
            $images = $this->getImagesForGallery($galleryData);

            $images->each(function (Image $image) use ($publicFilesystem, $galleryData) {
                $resizedThumbnailImageResponse = $this->resizeImage(
                    $image->getPath(),
                    self::MAX_THUMBNAIL_RESIZE_WIDTH,
                    self::THUMBNAIL_QUALITY
                );
                $resizedImageResponse = $this->resizeImage(
                    $image->getPath(),
                    self::MAX_IMAGE_RESIZE_WIDTH,
                    self::IMAGE_QUALITY
                );

                $publicFilesystem->put($image->getPathWithSlug(self::THUMBNAIL_SUFFIX), $resizedThumbnailImageResponse->getBody()->getContents());
                $publicFilesystem->put($image->getPathWithSlug(), $resizedImageResponse->getBody()->getContents());

                $this->progressBar->advance();
                $this->output->write(" <info>Processed image for gallery \"{$galleryData['filename']}\": \"{$image->getFilename()}.{$image->getExtension()}\"</info>");
            });

            $galleryInfoPath = $galleryData['path'] . '/info.json';

            $galleryInfoJsonStr = $localStorage->exists($galleryInfoPath) ? $localStorage->get($galleryInfoPath) : null;

            return new Gallery($galleryData['basename'], $galleryData['dirname'], $galleryData['path'], $images, $galleryInfoJsonStr);
        };
    }

    /**
     * Resize a image to a given maximum width; respects aspect ratio
     *
     * @param string $path
     * @param int $maxResizeWidth
     * @param int $quality
     * @return ResponseInterface
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function resizeImage(string $path, int $maxResizeWidth, int $quality = 90): ResponseInterface
    {
        $localStorage = Storage::disk('local');
        $imageManager = getImageManager();

        $resizedImage = $imageManager->make($localStorage->get($path))->resize($maxResizeWidth, null, function (Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        return $resizedImage->psrResponse('jpg', $quality);
    }

    /**
     * Get the images from a gallery folder
     *
     * @param array $galleryData
     * @return Collection<Image>
     */
    private function getImagesForGallery(array $galleryData): Collection
    {
        $localStorage = Storage::disk('local');

        return collect($localStorage->listContents($galleryData['path']))
            ->filter(function ($data) use ($localStorage) {
                $mimetype = $localStorage->getMimetype($data['path']);

                $isDirectory = $data['type'] === 'dir';
                $isImage = Str::startsWith($mimetype, 'image/');

                return !$isDirectory && $isImage;
            })
            ->map(function ($data) {
                return Image::fromArray($data);
            });
    }

    /**
     * Generate and store the HTML to the public folder
     *
     * @return Closure
     */
    private function storeHtml(): Closure
    {
        $publicAdapter = new Local(publicPath());
        $publicFilesystem = new Filesystem($publicAdapter);

        return function (Gallery $gallery) use ($publicFilesystem) {
            $view = view('gallery', ['gallery' => $gallery]);

            $publicFilesystem->put($gallery->getPathWithSlug() . '.html', $view->toHtml());
        };
    }
}
