<div class="container mx-auto px-8">
    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pt-8">
        @foreach ($gallery->getImages()->skip(1) as $image)
            <div>
                <x-image :image="$image" class="h-40 object-cover"/>
            </div>
        @endforeach
    </div>

    <p class="mt-32 mb-8">
        <x-back-button-link :href="url('index.html')"/>
    </p>
</div>
