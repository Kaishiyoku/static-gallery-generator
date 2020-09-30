<img
    src="/{{ $image->getPathWithSlug(\App\Console\Commands\BuildGalleries::THUMBNAIL_SUFFIX) }}"
    alt="{{ $image->getBasenameWithSlug() }}"
    data-provide="zoomable"
    data-zoom-src="/{{ $image->getPathWithSlug() }}"
    class="m-w-full"
/>
