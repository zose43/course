<form class="overflow-auto max-h-[320px] lg:max-h-[100%] space-y-10 p-6 2xl:p-8 rounded-2xl bg-card"
      action="{{ route('catalog', $category) }}">

    @foreach(filters() as $filter)
        {!! $filter !!}
    @endforeach

    <div>
        <button type="submit" class="w-full !h-16 btn btn-outline">Поиск</button>
    </div>

    @if(request('filters'))
        <div>
            <a href="{{ route('catalog',$category) }}" class="w-full !h-16 btn btn-outline">Сбросить фильтры</a>
        </div>
    @endif

</form>