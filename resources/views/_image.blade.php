<img
    src="/{{ $image->getPathWithSlug('-thumbnail') }}"
    alt="{{ $image->getBasenameWithSlug() }}"
    data-provide="zoomable"
    data-zoom-src="/{{ $image->getPathWithSlug() }}"
/>
