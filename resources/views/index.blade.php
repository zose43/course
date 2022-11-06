@extends('layouts.app')

@section('content')
    @auth()
        <form method="POST" action="{{ route('log-out') }}">
            @csrf
            @method('DELETE')

            <button type="submit">Выйти</button>
        </form>
    @endauth
@endsection