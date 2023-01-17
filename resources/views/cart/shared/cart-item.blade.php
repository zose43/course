<tr>
    <td class="py-4 px-4 md:px-6 rounded-l-2xl bg-card" scope="row">
        <div class="flex flex-col lg:flex-row min-w-[200px] gap-2 lg:gap-6">
            <div class="shrink-0 overflow-hidden w-[64px] lg:w-[84px] h-[64px] lg:h-[84px] rounded-2xl">
                <img alt="{{ $item->product->title }}" class="object-cover w-full h-full" src="{{ $item->product->makeThumbnail('345x320') }}">
            </div>
            <div class="py-3">
                <h4 class="text-xs sm:text-sm xl:text-md font-bold">
                    <a class="inline-block text-white hover:text-pink" href="{{ route('product', $item->product) }}">
                        {{ $item->product->title }}
                    </a>
                </h4>
                <x-cart.option-value :values="$item->optionValues"></x-cart.option-value>
            </div>
        </div>
    </td>
    <td class="py-4 px-4 md:px-6 bg-card">
        <div class="font-medium whitespace-nowrap">{{ $item->product->price }}</div>
    </td>
    <td class="py-4 px-4 md:px-6 bg-card">
        <div class="flex items-stretch h-[56px] gap-2">
            @include('cart.shared.quantity', $item)
        </div>
    </td>
    <td class="py-4 px-4 md:px-6 bg-card">
        <div class="font-medium whitespace-nowrap">{{ $item->amount }}</div>
    </td>
    <td class="py-4 px-4 md:px-6 rounded-r-2xl bg-card">
        <form method="POST" action="{{ route('cart.delete', $item) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-12 !h-12 !px-0 btn btn-pink" title="Удалить из корзины">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M49.327 7.857H2.673a2.592 2.592 0 0 0 0 5.184h5.184v31.102a7.778 7.778 0 0 0 7.776 7.776h20.735a7.778 7.778 0 0 0 7.775-7.776V13.041h5.184a2.592 2.592 0 0 0 0-5.184Zm-25.919 28.51a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96Zm10.368 0a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96ZM20.817 5.265h10.367a2.592 2.592 0 0 0 0-5.184H20.817a2.592 2.592 0 1 0 0 5.184Z"/>
                </svg>
            </button>
        </form>
    </td>
</tr>