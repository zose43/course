<tr>
    <td scope="row" class="pb-3 border-b border-body/10">
        <h4 class="font-bold">
            <a href="{{ route('product', $item->product) }}" class="inline-block text-white hover:text-pink break-words pr-3">
                {{ $item->product->title }}
            </a>
        </h4>
        <x-cart.option-value :values="$item->optionValues"></x-cart.option-value>
    </td>
    <td class="px-2 pb-3 border-b border-body/20 whitespace-nowrap">{{ $item->quantity }} шт.</td>
    <td class="px-2 pb-3 border-b border-body/20 whitespace-nowrap">{{ $item->product->price }}</td>
</tr>