@extends('app')

@section('title', $galleryInfo->name)

@section('content')
    @foreach ($files as $file)
        <div>
            <a data-fslightbox href="/{{ $file }}">
                <img src="/{{ $file }}"/>
            </a>
        </div>
    @endforeach
@endsection
