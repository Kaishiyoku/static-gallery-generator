<div class="container mx-auto px-8 pt-8">
    @foreach ($gallery->getImages()->skip(1) as $i => $image)
        <div class="lg:flex pb-12">
            <div class="lg:w-1/2 lg:mr-4">
                <x-image :image="$image"/>
            </div>

            @if (getImageDescriptionFor($image))
                <div class="lg:w-1/2 pt-4 lg:pt-0 prose max-w-none text-justify">
                    {!! getImageDescriptionFor($image) !!}
                </div>
            @endif
        </div>
    @endforeach

    <p class="mt-32 mb-8">
        <x-back-button-link :href="url('index.html')"/>
    </p>
</div>
