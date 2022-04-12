<?php

namespace App\Console\Commands;

use App\Data\Gallery;
use App\Data\Image;
use Closure;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use League\Flysystem\DirectoryAttributes;
use League\Flysystem\FileAttributes;
use League\Flysystem\StorageAttributes;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class BuildGalleries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'galleries:build {--skip-images}';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $galleries = collect(Storage::disk('local')->listContents('/galleries'))
            ->filter(fn(StorageAttributes $data) => $data->isDir());

        $totalNumberOfImages = $galleries->reduce(fn($accum, $galleryData) => $accum + $this->getImagesForGallery($galleryData)->count(), 0);

        $this->progressBar = $this->output->createProgressBar($totalNumberOfImages);

        $galleries = $galleries
            ->map($this->mapGalleries())
            ->each($this->storeHtml());

        $this->progressBar->finish();
        $this->line('');

        $indexPageView = view('index', ['galleries' => $galleries]);

        Storage::disk('build')->put('index.html', $indexPageView->toHtml());

        $this->line('Finished.');

        return 0;
    }

    /**
     * Map found "galleries", directories with images and store the images and generated HTML in the public folder
     *
     * @return Closure
     */
    private function mapGalleries(): Closure
    {
        return function (DirectoryAttributes $galleryData) {
            $images = $this->getImagesForGallery($galleryData);

            $images->each(function (Image $image) use ($galleryData) {
                if ($this->option('skip-images')) {
                    return;
                }

                $resizedThumbnailImageResponse = $this->resizeImage(
                    $image->getPath(),
                    config('gallery.max_thumbnail_resize_width'),
                    config('gallery.thumbnail_quality')
                );
                $resizedImageResponse = $this->resizeImage(
                    $image->getPath(),
                    config('gallery.max_image_resize_width'),
                    config('gallery.image_quality')
                );

                Storage::disk('build')->put($image->getPathWithSlug(config('gallery.thumbnail_suffix')), $resizedThumbnailImageResponse->getBody()->getContents());
                Storage::disk('build')->put($image->getPathWithSlug(), $resizedImageResponse->getBody()->getContents());

                $fileName = File::name($galleryData->path());

                $this->progressBar->advance();
                $this->output->write(" <info>Processed image for gallery \"{$fileName}\": \"{$image->getFilename()}.{$image->getExtension()}\"</info>");
            });

            $galleryInfoPath = $galleryData->path() . '/info.json';

            $galleryInfoJsonStr = Storage::disk('local')->exists($galleryInfoPath) ? Storage::disk('local')->get($galleryInfoPath) : null;

            return new Gallery(File::basename($galleryData->path()), File::dirname($galleryData->path()), $galleryData->path(), $images, $galleryInfoJsonStr);
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
     * @param StorageAttributes $galleryData
     * @return Collection<Image>
     */
    private function getImagesForGallery(StorageAttributes $galleryData): Collection
    {
        return collect(Storage::disk('local')->listContents($galleryData->path()))
            ->filter(fn(StorageAttributes $data) => !$data->isDir() && Str::startsWith(Storage::disk('local')->mimeType($data->path()), 'image/'))
            ->map(fn(FileAttributes $data) => Image::fromArray($data));
    }

    /**
     * Generate and store the HTML to the public folder
     *
     * @return Closure
     */
    private function storeHtml(): Closure
    {
        return function (Gallery $gallery) {
            $view = view('gallery', ['gallery' => $gallery]);

            Storage::disk('build')->put($gallery->getPathWithSlug() . '.html', $view->toHtml());
        };
    }
}
