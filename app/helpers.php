<?php

use App\Data\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use voku\helper\HtmlMin;

if (!function_exists('minifyHtml')) {
    /**
     * @param string $html
     * @return string
     */
    function minifyHtml(string $html): string
    {
        $htmlMin = new HtmlMin();

        return $htmlMin->minify($html);
    }
}

if (!function_exists('getImageDescriptionFor')) {
    /**
     * Get the description of a given image if there is one
     *
     * @param Image $image
     * @return string|null
     */
    function getImageDescriptionFor(Image $image): ?string
    {
        $localStorage = Storage::disk('local');

        // if there's a Markdown file with the same name as the image we return its contents
        $markdownFilePath = $image->getDirname() . '/' . $image->getFilename() . '.md';

        if ($localStorage->has($markdownFilePath)) {
            return parseMarkdown($localStorage->get($markdownFilePath));
        }

        return null;
    }
}

if (!function_exists('parseMarkdown')) {
    /**
     * @param string $text
     * @return string
     */
    function parseMarkdown(string $text): string
    {
        $markdownConverter = new GithubFlavoredMarkdownConverter();

        return $markdownConverter->convert($text);
    }
}

if (!function_exists('getImageManager')) {
    /**
     * @return ImageManager
     */
    function getImageManager(): ImageManager
    {
         return new ImageManager();
    }
}
