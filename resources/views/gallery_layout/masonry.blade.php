<div class="container mx-auto px-8">
    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pt-8">
        @foreach ($gallery->getImages()->skip(1) as $image)
            <div>
                <x-image :image="$image" class="h-40 object-cover"/>
            </div>
        @endforeach
    </div>

    <p class="mt-32 mb-8">
        <a href="/index.html" class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 border border-gray-600 rounded-md font-semibold text-xs text-gray-400 uppercase tracking-widest shadow-sm hover:text-gray-300 focus:outline-none focus:border-gray-500 focus:ring focus:ring-gray-600 active:text-gray-200 active:bg-gray-600 disabled:opacity-25 transition">Back</a>
    </p>
</div>
