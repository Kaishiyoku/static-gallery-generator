@extends('app')

@section('title', config('app.name') ?: 'Galleries')

@section('content')
    <div class="sm:p-2 mx-auto">
        <div class="sm:grid lg:grid-cols-2 xl:grid-cols-3 sm:gap-4">
            @foreach ($galleries as $gallery)
                <div class="{{ $gallery->getCssClassName() }} h-72 sm:rounded bg-cover bg-center">
                    <a href="{{ $gallery->getPathWithSlug() }}.html" class="block sm:rounded h-full py-2 px-3 outline-none shadow-xl transition ease-in-out duration-500 focus:ring-4 focus:ring-white focus:ring-opacity-50">
                        <div class="text-shadow">{{ $gallery->getGalleryInfo()->getName() ?? $gallery->getBaseName() }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        @foreach ($galleries as $gallery)
            .{{ $gallery->getCssClassName() }} {
                background-image: url('/{{ $gallery->getImages()->first()->getPathWithSlug(config('gallery.thumbnail_suffix')) }}');
            }
            .{{ $gallery->getCssClassName() }}:hover > a {
                background-color: {{ $gallery->getProminentColorAsRgba(0.25) }};
            }
            .{{ $gallery->getCssClassName() }} > a:focus {
                background-color: {{ $gallery->getProminentColorAsRgba(0.5) }};
                --tw-ring-color: {{ $gallery->getProminentColorAsRgba(1) }};
            }
        @endforeach
    </style>
@endsection
