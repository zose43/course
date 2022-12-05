<form class="overflow-auto max-h-[320px] lg:max-h-[100%] space-y-10 p-6 2xl:p-8 rounded-2xl bg-card"
      action="{{ route('catalog', $category) }}">
    <!-- Filter item -->
    <div>
        <h5 class="mb-4 text-sm 2xl:text-md font-bold">Цена</h5>
        <div class="flex items-center justify-between gap-3 mb-2">
            <span class="text-body text-xxs font-medium">От, ₽</span>
            <span class="text-body text-xxs font-medium">До, ₽</span>
        </div>
        <div class="flex items-center gap-3">
            <input type="number"
                   name="filters[price][from]"
                   class="w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                   value="{{ request('filters.price.from',0) }}"
                   placeholder="От">
            <span class="text-body text-sm font-medium">–</span>
            <input type="number"
                   name="filters[price][to]"
                   class="w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs shadow-transparent outline-0 transition"
                   value="{{ request('filters.price.to',100000) }}"
                   placeholder="До">
        </div>
    </div>
    <!-- Filter item -->
    <div>
        <h5 class="mb-4 text-sm 2xl:text-md font-bold">Бренд</h5>
        @foreach($brands as $brand)
            <div class="form-checkbox">
                <input type="checkbox"
                       name="filters[brands][{{ $brand->id }}]"
                       value="{{ $brand->id }}"
                       @checked(request("filters.brands.$brand->id"))
                       id="filters-item-{{ $brand->id }}">

                <label for="filters-item-{{ $brand->id }}" class="form-checkbox-label">
                    {{ $brand->title }}
                </label>
            </div>
        @endforeach
    </div>

    <div>
        <button type="submit" class="w-full !h-16 btn btn-outline">Поиск</button>
    </div>

    @if(request('filters'))
        <div>
            <a href="{{ route('catalog',$category) }}" class="w-full !h-16 btn btn-outline">Сбросить фильтры</a>
        </div>
    @endif

</form>