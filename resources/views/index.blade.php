@extends('app')

@section('title', 'Galleries')

@section('content')
    <div class="sm:p-2 mx-auto">
        <div class="sm:grid lg:grid-cols-2 xl:grid-cols-3 sm:gap-4">
            @foreach ($galleries as $gallery)
                <div class="h-72 sm:rounded bg-cover bg-center" style="background-image: url('/{{ $gallery->getImages()->first()->getPathWithSlug(config('gallery.thumbnail_suffix')) }}');">
                    <a href="{{ $gallery->getPathWithSlug() }}.html" class="block sm:rounded h-full py-2 px-3 outline-none shadow-xl transition ease-in-out duration-500 hover:bg-white hover:bg-opacity-30 focus:ring-4 focus:ring-white focus:ring-opacity-50">
                        <div class="text-shadow">{{ $gallery->getGalleryInfo()->getName() ?? $gallery->getBaseName() }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
