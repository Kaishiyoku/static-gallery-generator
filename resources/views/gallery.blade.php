@extends('app')

@section('title', $gallery->getGalleryInfo()->getName())

@section('content')
    <div class="cover">
        @if (!empty($gallery->getGalleryInfo()->getName()))
            <div class="cover-text">{{ $gallery->getGalleryInfo()->getName() }}</div>
        @endif

        <img src="/{{ $gallery->getImages()->first()->getPath() }}" alt="{{ $gallery->getImages()->first()->getBasename() }}"/>

        @if (getImageDescriptionFor($gallery, $gallery->getImages()->first()))
            <div class="container blocktext pb-4">
                {!! getImageDescriptionFor($gallery, $gallery->getImages()->first()) !!}
            </div>
        @endif
    </div>

    @include('gallery_layout.' . $gallery->getGalleryInfo()->getLayout(), ['gallery' => $gallery, 'images' => $gallery->getImages()->skip(1)])
@endsection
