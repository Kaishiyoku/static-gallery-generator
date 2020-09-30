<?php

use App\Gallery;
use App\Image;
use Intervention\Image\ImageManager;
use League\CommonMark\Converter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\Ext\Table\TableExtension;
use League\CommonMark\HtmlRenderer;
use voku\helper\HtmlMin;
use Webuni\CommonMark\AttributesExtension\AttributesExtension;

if (!function_exists('publicPath')) {
    /**
     * Get the public path or a subfolder of it
     *
     * @param string|null $path
     * @return string
     */
    function publicPath(?string $path = null): string
    {
        return rtrim(app()->basePath('public/' . $path), '/');
    }
}

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
     * @param Gallery $gallery
     * @param Image $image
     * @return string|null
     */
    function getImageDescriptionFor(Gallery $gallery, Image $image): ?string
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
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new AttributesExtension());

        $converter = new Converter(new DocParser($environment), new HtmlRenderer($environment));

        return $converter->convertToHtml($text);
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
