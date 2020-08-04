@extends('app')

@section('title', 'Galleries')

@section('content')
    <div class="container mt-5 gallery-list">
        <div class="row">
            @foreach ($galleries->chunk((int) round($galleries->count() / 2)) as $chunk)
                <div class="col-lg-6">
                    @foreach ($chunk as $gallery)
                        <div style="background-image: url('/{{ $gallery->getImages()->first()->getPathWithSlug() }}');" class="gallery-item">
                            <a href="{{ $gallery->getPathWithSlug(\App\Console\Commands\BuildGalleries::THUMBNAIL_SUFFIX) }}.html" class="lg btn btn-block">
                                <div class="title">{{ $gallery->getGalleryInfo()->getName() ?? $gallery->getBaseName() }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
