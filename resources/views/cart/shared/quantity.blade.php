<form method="POST" action="{{ route('cart.quantity', $item) }}">
    @csrf
    <button
        class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition"
        type="button">
        -
    </button>
    <input name="quantity"
           class="h-full px-2 lg:px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition"
           max="100"
           min="1"
           placeholder="К-во"
           type="number"
           value="{{ $item->quantity }}">
    <button
        class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition"
        type="button">
        +
    </button>
</form>