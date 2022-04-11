<div class="container mx-auto px-8">
    <div class="lg:flex">
        @foreach ($images->chunk(2) as $chunk)
            <div class="lg:px-4">
                @foreach ($chunk as $image)
                    <x-image :image="$image"/>

                    @if (getImageDescriptionFor($image))
                        <div class="prose max-w-none text-justify pt-4 pb-20">
                            {!! getImageDescriptionFor($image) !!}
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>

    <p class="mt-32 mb-8">
        <a href="/index.html" class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 border border-gray-600 rounded-md font-semibold text-xs text-gray-400 uppercase tracking-widest shadow-sm hover:text-gray-300 focus:outline-none focus:border-gray-500 focus:ring focus:ring-gray-600 active:text-gray-200 active:bg-gray-600 disabled:opacity-25 transition">Back</a>
    </p>
</div>
