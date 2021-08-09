@extends('app')

@section('title', 'Galleries')

@section('content')
    <div class="p-2 mx-auto">
        <div class="grid lg:grid-cols-2 xl:grid-cols-3 gap-2">
            @foreach ($galleries as $gallery)
                <div class="h-72 rounded bg-cover bg-center" style="background-image: url('/{{ $gallery->getImages()->first()->getPathWithSlug(\App\Console\Commands\BuildGalleries::THUMBNAIL_SUFFIX) }}');">
                    <a href="{{ $gallery->getPathWithSlug() }}.html" class="block h-full rounded py-2 px-3 outline-none shadow transition ease-in-out duration-500 hover:bg-white hover:bg-opacity-30 focus:ring-4 focus:ring-white focus:ring-opacity-50">
                        <div class="text-shadow">{{ $gallery->getGalleryInfo()->getName() ?? $gallery->getBaseName() }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
