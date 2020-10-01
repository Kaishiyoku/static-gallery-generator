<div class="container mx-auto px-8">
    <div>
        @foreach ($gallery->getImages()->skip(1) as $i => $image)
            <div class="pb-5">
                <div class="lg:w-1/2 pb-2 {{ $i % 2 === 0 ? 'lg:float-left lg:pr-6' : 'lg:float-right lg:pl-6' }}">
                    @include('_image', ['image' => $image])
                </div>

                @if (getImageDescriptionFor($gallery, $image))
                    <div class="prose max-w-none text-justify pt-4 pb-20">
                        {!! getImageDescriptionFor($gallery, $image) !!}
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <p class="my-8">
        <a href="/index.html" class="border border-gray-700 rounded py-2 px-3 hover:border-gray-200 hover:bg-gray-200 hover:text-gray-900 transition-all duration-300">Back</a>
    </p>
</div>
