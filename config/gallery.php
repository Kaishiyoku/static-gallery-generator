<?php

return [

    'max_thumbnail_resize_width' => env('GALLERY_MAX_THUMBNAIL_RESIZE_WIDTH', 1250),
    'max_image_resize_width' => env('GALLERY_MAX_IMAGE_RESIZE_WIDTH', 2500),
    'thumbnail_quality' => env('GALLERY_THUMBNAIL_QUALITY', 50),
    'image_quality' => env('GALLERY_IMAGE_QUALITY', 70),
    'thumbnail_suffix' => env('GALLERY_THUMBNAIL_SUFFIX', '-thumbnail'),

];
