<?php

use voku\helper\HtmlMin;

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
