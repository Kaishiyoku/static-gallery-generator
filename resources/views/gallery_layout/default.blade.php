<div class="container mx-auto px-8">
    <div>
        @foreach ($gallery->getImages()->skip(1) as $image)
            <div class="mt-4">
                <x-image :image="$image"/>
            </div>

            @if (getImageDescriptionFor($image))
                <div class="prose max-w-none text-justify pt-4 pb-20">
                    {!! getImageDescriptionFor($image) !!}
                </div>
            @endif
        @endforeach
    </div>

    <p class="mt-32 mb-8">
        <x-back-button-link :href="url('index.html')"/>
    </p>
</div>
