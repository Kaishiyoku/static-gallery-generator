<div class="container">
    <div class="gallery">
        @foreach ($gallery->getImages()->skip(1) as $image)
            @include('_image', ['image' => $image])

            @if (getImageDescriptionFor($gallery, $image))
                <div class="text-justify pb-5">
                    {!! getImageDescriptionFor($gallery, $image) !!}
                </div>
            @endif
        @endforeach
    </div>

    <p class="mt-3">
        <a href="/index.html" class="btn">Back</a>
    </p>
</div>
