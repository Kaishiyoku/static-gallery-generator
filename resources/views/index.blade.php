@extends('app')

@section('title', 'Galleries')

@section('content')
    <div class="container">
        <ul class="list-style-none">
            @foreach ($galleries as $gallery)
                <li>
                    <a href="{{ $gallery->getPath() }}.html" class="lg">
                        {{ optional($gallery->getGalleryInfo())->getName() ?? $gallery->getBaseName() }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
