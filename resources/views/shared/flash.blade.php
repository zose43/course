@if($msg = flash()->message())
    <div class="{{ $msg->getClass() }} p-5">
        {{ $msg->getMessage() }}
    </div>
@endif