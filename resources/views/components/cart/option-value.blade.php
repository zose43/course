@if($values->isNotEmpty())
    <ul class="space-y-1 mt-2 text-xs">
        @foreach($values as $value)
            <li class="text-body">{{$value->option->title . ': ' . $value->title }}</li>
        @endforeach
    </ul>
@endif