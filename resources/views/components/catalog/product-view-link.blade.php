<a href="{!! $href !!}"
   class=" inline-flex items-center justify-center w-10 h-10 rounded-md bg-card
        {{ $active ? 'pointer-events-none text-pink' : ''}}">
    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 52 52">
        {{ $path }}
    </svg>
</a>