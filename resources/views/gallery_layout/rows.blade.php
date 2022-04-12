<div class="container mx-auto px-8">
    <div class="lg:flex">
        @foreach ($images->chunk(floor($images->count() / 2)) as $chunk)
            <div class="lg:px-4">
                @foreach ($chunk as $image)
                    <div class="pt-8">
                        <x-image :image="$image"/>

                        @if (getImageDescriptionFor($image))
                            <div class="prose max-w-none text-justify pt-4 pb-20">
                                {!! getImageDescriptionFor($image) !!}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <p class="mt-32 mb-8">
        <x-back-button-link :href="url('index.html')"/>
    </p>
</div>
