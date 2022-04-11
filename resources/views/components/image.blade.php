@props(['image' => null])

<img
    {{ $attributes->merge(['class' => 'w-full']) }}
    src="/{{ $image->getPathWithSlug(config('gallery.thumbnail_suffix')) }}"
    alt="{{ $image->getBasenameWithSlug() }}"
    data-provide="zoomable"
    data-original="/{{ $image->getPathWithSlug() }}"
    loading="lazy"
/>
