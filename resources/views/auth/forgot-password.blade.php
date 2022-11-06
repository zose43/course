@extends('layouts.auth')

@section('title', 'Восстановить пароль')
@section('content')

    <x-forms.auth-form title="Восстановить пароль" action="{{ route('forgot.handler') }}">
        @csrf
        <x-forms.text-input
            name="email"
            :is-error="$errors->has('email')"
            type="email"
            placeholder="E-mail"
            required="true"
            value="{{ old('email') }}"
        />

        @error('email')
        <x-forms.error>
            {{$message}}
        </x-forms.error>
        @enderror

        <x-forms.primary-button>
            Отправить
        </x-forms.primary-button>

        <x-slot:socialAuth></x-slot:socialAuth>

        <x-slot:buttons>
            <div class="space-y-3 mt-5">
                <div class="text-xxs md:text-xs"><a class="text-white hover:text-white/70 font-bold" href="{{ route('login') }}">Вспомнил пароль</a></div>
            </div>
        </x-slot:buttons>

    </x-forms.auth-form>

@endsection