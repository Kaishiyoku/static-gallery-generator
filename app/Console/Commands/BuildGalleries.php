<?php

namespace App\Console\Commands;

use App\Gallery;
use App\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class BuildGalleries extends Command
{
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
            ->filter(function ($data) {
                return $data['type'] === 'dir';
            })
            ->map(function ($data) use ($localStorage, $publicFilesystem) {
                $images = collect($localStorage->listContents($data['path']))
                    ->filter(function ($data) use ($localStorage) {
                        $mimetype = $localStorage->getMimetype($data['path']);

                        $isDirectory = $data['type'] === 'dir';
                        $isImage = Str::startsWith($mimetype, 'image/');

                        return !$isDirectory && $isImage;
                    })
                    ->map(function ($data) {
                        return Image::fromArray($data);
                    });

                $images->each(function (Image $image) use ($localStorage, $publicFilesystem) {
                    $publicFilesystem->put($image->getPath(), $localStorage->get($image->getPath()));
                });

                $galleryInfoPath = $data['path'] . '/info.json';

                $galleryInfoJsonStr = $localStorage->exists($galleryInfoPath) ? $localStorage->get($galleryInfoPath) : null;

                return new Gallery($data['basename'], $data['path'], $images, $galleryInfoJsonStr);
            })
            ->each(function (Gallery $gallery) use ($publicFilesystem) {
                $view = view('gallery', ['gallery' => $gallery]);

                $publicFilesystem->put($gallery->getPath() . '.html', $view->toHtml());
            });

        $indexPageView = view('index', ['galleries' => $galleries]);

        $publicFilesystem->put('index.html', $indexPageView->toHtml());

        $this->line('Finished.');
    }
}
