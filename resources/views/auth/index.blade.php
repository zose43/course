@extends('layouts.auth')

@section('title', 'Вход в аккаунт')
@section('content')

    <x-forms.auth-form title="Вход в аккаунт" action="{{ route('sign-in') }}">
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

        <x-forms.text-input
            name="password"
            :is-error="$errors->has('email')"
            type="password"
            placeholder="Пароль"
            required="true"
        />

        <x-forms.primary-button>
            Войти
        </x-forms.primary-button>

        <x-slot:socialAuth>
            <ul class="space-y-3 my-3">
                <li>
                    <x-forms.github-link action="{{ route('socialite.github') }}"/>
                </li>
            </ul>
        </x-slot:socialAuth>

        <x-slot:buttons>
            <div class="space-y-3 mt-5">
                <div class="text-xxs md:text-xs"><a class="text-white hover:text-white/70 font-bold" href="{{ route('password.email') }}">Забыли пароль?</a>
                </div>
                <div class="text-xxs md:text-xs"><a class="text-white hover:text-white/70 font-bold" href="{{ route('sign-up') }}">Регистрация</a></div>
            </div>
        </x-slot:buttons>

    </x-forms.auth-form>

@endsection