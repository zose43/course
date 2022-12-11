<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    @include('catalog.shared.product-view')

    <div x-data="{sort: '{{ catalogUrl($category, [$sort->name() => request($sort->name())]) }}'}"
         class="flex flex-col sm:flex-row sm:items-center gap-3">
        <span class="text-body text-xxs sm:text-xs">{{ $sort->title() }}</span>

        <select name="{{ $sort->name() }}"
                x-model="sort"
                x-on:change="window.location = sort"
                class="form-select w-full h-12 px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xxs sm:text-xs shadow-transparent outline-0 transition">

            @each('catalog.shared.sort-option',$sort->all(), 'item')

        </select>
        </form>
    </div>
</div>