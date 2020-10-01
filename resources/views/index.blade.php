@extends('app')

@section('title', 'Galleries')

@section('content')
    <div class="container mx-auto py-12 px-12 lg:px-4">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-6 lg:gap-y-4">
            @foreach ($galleries->chunk((int) round($galleries->count() / 2)) as $chunk)
                @foreach ($chunk as $gallery)
                    <div style="background-image: url('/{{ $gallery->getImages()->first()->getPathWithSlug(\App\Console\Commands\BuildGalleries::THUMBNAIL_SUFFIX) }}');" class="h-40 rounded bg-full bg-center mb-4 lg:mb-0">
                        <a href="{{ $gallery->getPathWithSlug() }}.html" class="rounded block h-full hover:bg-gray-200 py-2 px-3 border-2 border-gray-600 border-opacity-25 hover:border-opacity-50 hover:bg-gray-200 hover:bg-opacity-25 transition-all duration-300">
                            <div class="text-shadow">{{ $gallery->getGalleryInfo()->getName() ?? $gallery->getBaseName() }}</div>
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
