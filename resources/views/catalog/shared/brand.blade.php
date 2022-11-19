<a class="p-6 rounded-xl bg-card hover:bg-card/60" href="#">
    <div class="h-12 md:h-16">
        <img alt="{{ $item->title }}" class="object-contain w-full h-full" src="{{ $item->makeThumbnail('70x70') }}">
    </div>
    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">{{ $item->title }}</div>
</a>