<div class="container mx-auto px-8">
    <div class="lg:flex">
        @foreach ($images->chunk(2) as $chunk)
            <div class="lg:px-4">
                @foreach ($chunk as $image)
                    @include('_image', ['image' => $image])

                    @if (getImageDescriptionFor($image))
                        <div class="prose max-w-none text-justify pt-4 pb-20">
                            {!! getImageDescriptionFor($image) !!}
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>

    <p class="my-8">
        <a href="/index.html" class="border border-gray-700 rounded py-2 px-3 hover:border-gray-200 hover:bg-gray-200 hover:text-gray-900 transition-all duration-300">Back</a>
    </p>
</div>
