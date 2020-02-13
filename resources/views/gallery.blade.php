@extends('app')

@section('title', optional($gallery->getGalleryInfo())->getName())

@section('content')
    @foreach ($gallery->getImages() as $image)
        <div>
            <a data-fslightbox href="/{{ $image->getPath() }}">
                <img src="/{{ $image->getPath() }}" alt="{{ $image->getBasename() }}"/>
            </a>
        </div>
    @endforeach
@endsection
