<div class="container">
    <div class="gallery">
        @foreach ($gallery->getImages()->skip(1) as $i => $image)
            <div class="{{ $i % 2 === 0 ? 'flex' : 'flex-reverse' }}">
                <img src="/{{ $image->getPath() }}" alt="{{ $image->getBasename() }}" data-provide="zoomable"/>

                @if (getImageDescriptionFor($gallery, $image))
                    <div class="text-justify">
                        {!! getImageDescriptionFor($gallery, $image) !!}
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <p class="mt-3">
        <a href="/index.html" class="btn">Back</a>
    </p>
</div>