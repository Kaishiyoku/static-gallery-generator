<div class="container">
    <div class="gallery">
        <div class="row">
            @foreach ($images->chunk(floor($images->count() / 2)) as $chunk)
                <div class="col-lg-6">
                    @foreach ($chunk as $image)
                        <img src="/{{ $image->getPathWithSlug() }}" alt="{{ $image->getBasenameWithSlug() }}" data-provide="zoomable"/>

                        @if (getImageDescriptionFor($gallery, $image))
                            <div class="text-justify">
                                {!! getImageDescriptionFor($gallery, $image) !!}
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <p class="mt-3">
        <a href="/index.html" class="btn">Back</a>
    </p>
</div>
