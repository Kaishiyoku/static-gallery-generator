<div class="container mx-auto px-8">
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
        <a href="/index.html" class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 border border-gray-600 rounded-md font-semibold text-xs text-gray-400 uppercase tracking-widest shadow-sm hover:text-gray-300 focus:outline-none focus:border-gray-500 focus:ring focus:ring-gray-600 active:text-gray-200 active:bg-gray-600 disabled:opacity-25 transition">Back</a>
    </p>
</div>
