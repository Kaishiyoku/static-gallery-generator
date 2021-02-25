@extends('app')

@section('title', 'Galleries')

@section('content')
    <div class="container mx-auto py-12 px-12 lg:px-4">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-6 lg:gap-y-4">
            @foreach ($galleries->chunk((int) round($galleries->count() / 2)) as $chunk)
                @foreach ($chunk as $gallery)
                    <div class="h-40 rounded bg-full bg-center mb-4 lg:mb-0" style="background-image: url('/{{ $gallery->getImages()->first()->getPathWithSlug(\App\Console\Commands\BuildGalleries::THUMBNAIL_SUFFIX) }}');">
                        <a href="{{ $gallery->getPathWithSlug() }}.html" class="rounded block h-full py-2 px-3 border-2 border-gray-600 border-opacity-25 outline-none transition-all duration-300 hover:border-gray-200 hover:border-opacity-75 hover:bg-gray-200 hover:bg-opacity-25 focus:ring-4 focus:ring-gray-200 focus:ring-opacity-75">
                            <div class="text-shadow">{{ $gallery->getGalleryInfo()->getName() ?? $gallery->getBaseName() }}</div>
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
