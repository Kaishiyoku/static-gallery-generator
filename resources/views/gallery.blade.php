@extends('app')

@section('title', optional($gallery->getGalleryInfo())->getName())

@section('content')
    <div class="cover">
        @if (!empty(optional($gallery->getGalleryInfo())->getName()))
            <div class="cover-text">{{ optional($gallery->getGalleryInfo())->getName() }}</div>
        @endif

        <img src="/{{ $gallery->getImages()->first()->getPath() }}" alt="{{ $gallery->getImages()->first()->getBasename() }}"/>
    </div>

    <div class="container gallery pswp_container" id="gallery">
        @foreach ($gallery->getImages()->skip(1) as $image)
            <a href="/{{ $image->getPath() }}">
                <img src="/{{ $image->getPath() }}" alt="{{ $image->getBasename() }}"/>
            </a>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#gallery").lightGallery({
                // mode: 'lg-fade',
                // speed: 500,
                // useLeft: true,
                loop: false,
                mousewheel: false,
                download: false,

                // keyPress: false,
                // controls: false,
                enableDrag: false,
                // enableSwipe: false,

                speed:0,
                slideEndAnimation: false,
            });
        });
    </script>
@endsection
