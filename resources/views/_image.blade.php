<img
    src="/{{ $image->getPathWithSlug(\App\Console\Commands\BuildGalleries::THUMBNAIL_SUFFIX) }}"
    alt="{{ $image->getBasenameWithSlug() }}"
    data-provide="zoomable"
    data-original="/{{ $image->getPathWithSlug() }}"
    class="w-full"
/>
