@extends('app')

@section('title', optional($gallery->getGalleryInfo())->getName())

@section('content')
    <div class="cover">
        @if (!empty(optional($gallery->getGalleryInfo())->getName()))
            <div class="cover-text">{{ optional($gallery->getGalleryInfo())->getName() }}</div>
        @endif

        <img src="/{{ $gallery->getImages()->first()->getPath() }}" alt="{{ $gallery->getImages()->first()->getBasename() }}"/>

        @if (getImageDescriptionFor($gallery, $gallery->getImages()->first()))
            <div class="container blocktext pb-4">
                {!! getImageDescriptionFor($gallery, $gallery->getImages()->first()) !!}
            </div>
        @endif
    </div>

    @include('gallery_layout.' . (optional($gallery->getGalleryInfo())->getLayout() ?? 'default'), ['gallery' => $gallery, 'images' => $gallery->getImages()->skip(1)])
@endsection
