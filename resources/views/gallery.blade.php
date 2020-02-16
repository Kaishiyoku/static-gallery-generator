@extends('app')

@section('title', optional($gallery->getGalleryInfo())->getName())

@section('content')
    <div class="cover">
        @if (!empty(optional($gallery->getGalleryInfo())->getName()))
            <div class="cover-text">{{ optional($gallery->getGalleryInfo())->getName() }}</div>
        @endif

        <img src="/{{ $gallery->getImages()->first()->getPath() }}" alt="{{ $gallery->getImages()->first()->getBasename() }}"/>
    </div>

    <div class="container">
        <div class="gallery">
            @foreach ($gallery->getImages()->skip(1) as $image)
                {{--            <a href="/{{ $image->getPath() }}">--}}
                <img src="/{{ $image->getPath() }}" alt="{{ $image->getBasename() }}" data-provide="zoomable"/>
                {{--            </a>--}}
            @endforeach
        </div>

        <p class="mt-3">
            <a href="/index.html" class="btn">Back</a>
        </p>
    </div>
@endsection
