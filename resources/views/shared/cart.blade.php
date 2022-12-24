<a href="{{ route('cart.index') }}" class="flex items-center gap-3 text-pink hover:text-white">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 md:w-7 w-6 md:h-7" fill="currentColor" viewBox="0 0 52 52">
        <path
            d="M26 0a10.4 10.4 0 0 0-10.4 10.4v1.733h-1.439a5.668 5.668 0 0 0-5.668 5.408L7.124 46.055A5.685 5.685 0 0 0 12.792 52h26.416a5.686 5.686 0 0 0 5.668-5.945l-1.37-28.514a5.668 5.668 0 0 0-5.667-5.408H36.4V10.4A10.4 10.4 0 0 0 26 0Zm-6.933 10.4a6.934 6.934 0 0 1 13.866 0v1.733H19.067V10.4Zm-2.843 8.996a1.734 1.734 0 1 1 3.468 0 1.734 1.734 0 0 1-3.468 0Zm16.085 0a1.733 1.733 0 1 1 3.467 0 1.733 1.733 0 0 1-3.467 0Z"/>
    </svg>
    <div class="hidden sm:flex flex-col gap-2">
        <span class="text-body text-xxs leading-none">{{ cart()->count() }} шт.</span>
        <span class="text-white text-xxs 2xl:text-xs font-bold !leading-none">{{ cart()->amount() }}</span>
    </div>
</a>