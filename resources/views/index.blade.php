@extends('app')

@section('title', 'Galleries')

@section('content')
    <div class="container mt-5">
        <div class="row">
            @foreach ($galleries->chunk(2) as $chunk)
                <div class="col-lg-6">
                    <ul class="list-style-none">
                        @foreach ($chunk as $gallery)
                            <li>
                                <a href="{{ $gallery->getPathWithSlug() }}.html" class="lg btn btn-block">
                                    {{ $gallery->getGalleryInfo()->getName() ?? $gallery->getBaseName() }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection
