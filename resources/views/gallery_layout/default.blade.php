<div class="container">
    <div class="gallery">
        @foreach ($gallery->getImages()->skip(1) as $image)
            <img src="/{{ $image->getPath() }}" alt="{{ $image->getBasename() }}" data-provide="zoomable"/>

            @if (getImageDescriptionFor($gallery, $image))
                <div class="blocktext">
                    {!! getImageDescriptionFor($gallery, $image) !!}
                </div>
            @endif
        @endforeach
    </div>

    <p class="mt-3">
        <a href="/index.html" class="btn">Back</a>
    </p>
</div>
