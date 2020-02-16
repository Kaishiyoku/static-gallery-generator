<?php

use App\Gallery;
use App\Image;
use App\Libraries\Markdown\LaboratoryMeasurementExtension;
use League\CommonMark\Converter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\Ext\Table\TableExtension;
use League\CommonMark\HtmlRenderer;
use voku\helper\HtmlMin;
use Webuni\CommonMark\AttributesExtension\AttributesExtension;

if (!function_exists('publicPath')) {
    function publicPath($path = null)
    {
        return rtrim(app()->basePath('public/' . $path), '/');
    }
}

if (!function_exists('minifyHtml')) {
    function minifyHtml($html)
    {
        $htmlMin = new HtmlMin();

        return $htmlMin->minify($html);
    }
}

if (!function_exists('getImageDescriptionFor')) {
    function getImageDescriptionFor(Gallery $gallery, Image $image)
    {
        $hasImageDescription = $gallery->getGalleryInfo() && $gallery->getGalleryInfo()->getImageDescriptions()->get($image->getBasename());

        if ($hasImageDescription) {
            return $gallery->getGalleryInfo()->getImageDescriptions()->get($image->getBasename());
        }

        return null;
    }
}

if (!function_exists('parseMarkdown')) {
    function parseMarkdown(string $text): string
    {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new AttributesExtension());

        $converter = new Converter(new DocParser($environment), new HtmlRenderer($environment));

        return $converter->convertToHtml($text);
    }
}
