@extends('app')

@section('title', $gallery->getGalleryInfo()->getName())

@section('content')
    <div>
        @if (!empty($gallery->getGalleryInfo()->getName()))
            <div class="absolute p-4 sm:text-xl md:text-4xl lg:text-6xl text-shadow bg-gray-900 bg-opacity-50">{{ $gallery->getGalleryInfo()->getName() }}</div>
        @endif

        <img src="/{{ $gallery->getImages()->first()->getPathWithSlug() }}" alt="{{ $gallery->getImages()->first()->getBasenameWithSlug() }}" class="w-full"/>

        @if (getImageDescriptionFor($gallery->getImages()->first()))
            <div class="container mx-auto px-8 pb-20">
                <div class="relative bg-gray-900 bg-opacity-50" style="margin-top: -100px; min-height: 100px;"></div>
                <div class="relative text-shadow p-4" style="margin-top: -100px; min-height: 100px;">
                    {!! getImageDescriptionFor($gallery->getImages()->first()) !!}
                </div>
            </div>
        @endif
    </div>

    @include('gallery_layout.' . $gallery->getGalleryInfo()->getLayout(), ['gallery' => $gallery, 'images' => $gallery->getImages()->skip(1)])
@endsection
