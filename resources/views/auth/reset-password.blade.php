@extends('layouts.auth')

@section('title', 'Сброс пароля')
@section('content')

    <x-forms.auth-form title="Сброс пароля" action="{{ route('reset.handler') }}">
        @csrf

        <x-forms.text-input
            name="token"
            type="hidden"
            value="{{ $token }}"
        />

        <x-forms.text-input
            name="email"
            :is-error="$errors->has('email')"
            type="email"
            placeholder="E-mail"
            required="true"
            value="{{ old('email') ?? $email }}"
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
            Сохранить
        </x-forms.primary-button>

        <x-slot:socialAuth></x-slot:socialAuth>

        <x-slot:buttons></x-slot:buttons>

    </x-forms.auth-form>

@endsection