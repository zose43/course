@extends('layouts.auth')

@section('title', 'Регистрация')
@section('content')

    <x-forms.auth-form title="Регистрация" action="{{ route('sign-up.handler') }}">
        @csrf
        <x-forms.text-input
            name="name"
            :is-error="$errors->has('name')"
            placeholder="Имя"
            required="true"
            value="{{ old('name') }}"
        />

        @error('name')
        <x-forms.error>
            {{$message}}
        </x-forms.error>
        @enderror

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
            :is-error="$errors->has('password')"
            type="password"
            placeholder="Пароль"
            required="true"
        />

        @error('password')
        <x-forms.error>
            {{$message}}
        </x-forms.error>
        @enderror

        <x-forms.text-input
            name="password_confirmation"
            :is-error="$errors->has('password_confirmation')"
            type="password"
            placeholder="Подтвердите пароль"
            required="true"
        />

        @error('password_confirmation')
        <x-forms.error>
            {{$message}}
        </x-forms.error>
        @enderror

        <x-forms.primary-button>
            Зарегистрироваться
        </x-forms.primary-button>

        <x-slot:socialAuth>
            <ul class="space-y-3 my-3">
                <li>
                    <x-forms.github-link action="{{ route('socialite.github', ['driver' => 'github']) }}"/>
                </li>
            </ul>
        </x-slot:socialAuth>

        <x-slot:buttons>
            <div class="space-y-3 mt-5">
                <div class="text-xxs md:text-xs">
                    <a class="text-white hover:text-white/70 font-bold" href="{{  route('login') }}">Войти в аккаунт</a>
                </div>
            </div>
        </x-slot:buttons>

    </x-forms.auth-form>

@endsection