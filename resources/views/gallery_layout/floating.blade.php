<div class="container mx-auto px-8">
    @foreach ($gallery->getImages()->skip(1) as $i => $image)
        <div class="lg:flex pb-12">
            <div class="lg:w-1/2 lg:mr-4">
                @include('_image', ['image' => $image])
            </div>

            @if (getImageDescriptionFor($image))
                <div class="lg:w-1/2 pt-4 lg:pt-0 prose max-w-none text-justify">
                    {!! getImageDescriptionFor($image) !!}
                </div>
            @endif
        </div>
    @endforeach

    <div class="my-8">
        <a href="/index.html" class="border border-gray-700 rounded py-2 px-3 hover:border-gray-200 hover:bg-gray-200 hover:text-gray-900 transition-all duration-300">Back</a>
    </div>
</div>
