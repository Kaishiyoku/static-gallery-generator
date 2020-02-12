<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
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
        $galleryDirectoryPaths = collect(Storage::disk('local')->directories('galleries'));

        $galleries = $galleryDirectoryPaths->mapWithKeys(function ($galleryDirectoryPath) {
            return [$galleryDirectoryPath => collect(Storage::disk('local')->allFiles($galleryDirectoryPath))];
        });

        $publicAdapter = new Local(publicPath());
        $publicFilesystem = new Filesystem($publicAdapter);

        $htmlFileNames = $galleries->map(function (Collection $gallery, $galleryDirectoryPath) use ($publicFilesystem) {
            $gallery
                ->filter(function ($file) {
                    return !Str::endsWith($file, '.json'); // TODO: only allow images
                })
                ->each(function ($file) use ($publicFilesystem) {

                    $publicFilesystem->put($file, Storage::disk('local')->get($file));
                });

            $galleryInfo = json_decode(Storage::disk('local')->get(
                $gallery
                    ->filter(function ($file) {
                        return Str::endsWith($file, '.json');
                    })
                    ->first()
            ), false, 512, JSON_THROW_ON_ERROR);

            $parts = explode('/', $galleryDirectoryPath);
            $view = view('gallery', ['files' => $gallery, 'galleryInfo' => $galleryInfo]);

            $htmlFileName = '/galleries/' . $parts[array_key_last($parts)] . '.html';

            $publicFilesystem->put($htmlFileName, minifyHtml($view->toHtml()));

            return $htmlFileName;
        });

        $indexPageView = view('index', ['galleries' => $htmlFileNames]);

        $publicFilesystem->put('index.html', minifyHtml($indexPageView->toHtml()));

        $this->line('Finished.');
    }
}
