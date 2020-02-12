<?php

if (!function_exists('publicPath')) {
    function publicPath($path = null)
    {
        return rtrim(app()->basePath('public/' . $path), '/');
    }
}
