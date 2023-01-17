@extends('layouts.app')
@section('title', 'Оформление заказа')
@section('content')
    <!-- Breadcrumbs -->
    <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
        <li>
            <a href="{{ route('home') }}" class="text-body hover:text-pink text-xs">Главная</a>
        </li>
        <li>
            <a href="{{ route('cart.index') }}" class="text-body hover:text-pink text-xs">Корзина покупок</a>
        </li>
        <li>
            <span class="text-body text-xs">Оформление заказа</span>
        </li>
    </ul>

    <section>
        <!-- Section heading -->
        <h1 class="mb-8 text-lg lg:text-[42px] font-black">Оформление заказа</h1>

        <form method="POST"
              action="{{ route('order.handle') }}"
              class="grid xl:grid-cols-3 items-start gap-6 2xl:gap-8 mt-12">
            @csrf

            <!-- Contact information -->
            <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
                <h3 class="mb-6 text-md 2xl:text-lg font-bold">Контактная информация</h3>
                <div class="space-y-3">
                    <x-forms.text-input placeholder="Имя"
                                        name="customer[first_name]"
                                        :is-error="$errors->has('customer.first_name')"
                                        value="{{ old('customer.first_name') }}"
                                        required>
                    </x-forms.text-input>
                    @error('customer.first_name')
                    <x-forms.error>
                        {{$message}}
                    </x-forms.error>
                    @enderror


                    <x-forms.text-input placeholder="Фамилия"
                                        name="customer[last_name]"
                                        value="{{ old('customer.last_name') }}"
                                        :is-error="$errors->has('customer.last_name')"
                                        required>
                    </x-forms.text-input>
                    @error('customer.last_name')
                    <x-forms.error>
                        {{$message}}
                    </x-forms.error>
                    @enderror


                    <x-forms.text-input placeholder="Номер телефона"
                                        type="number"
                                        name="customer[phone]"
                                        :is-error="$errors->has('customer.phone')"
                                        value="{{ old('customer.phone') }}"
                                        required>
                    </x-forms.text-input>
                    @error('customer.phone')
                    <x-forms.error>
                        {{$message}}
                    </x-forms.error>
                    @enderror

                    <x-forms.text-input placeholder="E-mail"
                                        type="email"
                                        name="customer[email]"
                                        :is-error="$errors->has('customer.email')"
                                        value="{{ old('customer.email') }}"
                                        required>
                    </x-forms.text-input>
                    @error('customer.email')
                    <x-forms.error>
                        {{$message}}
                    </x-forms.error>
                    @enderror

                    <div x-data="{ createAccount: false }">
                        <div class="py-3 text-body">Вы можете создать аккаунт после оформления заказа</div>
                        <div class="form-checkbox">
                            <input type="checkbox"
                                   id="checkout-create-account"
                                   name="create_account"
                                   value="1">
                            <label for="checkout-create-account" class="form-checkbox-label" @click="createAccount = ! createAccount">Зарегистрировать
                                аккаунт</label>
                        </div>
                        <div
                            x-show="createAccount"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="mt-4 space-y-3"
                        >
                            <x-forms.text-input placeholder="Придумайте пароль"
                                                type="password"
                                                :is-error="$errors->has('customer.password')"
                                                name="customer[password]">
                            </x-forms.text-input>
                            @error('customer.password')
                            <x-forms.error>
                                {{$message}}
                            </x-forms.error>
                            @enderror

                            <x-forms.text-input placeholder="Повторите пароль"
                                                type="password"
                                                :is-error="$errors->has('customer.password_confirmation')"
                                                name="customer[password_confirmation]">
                            </x-forms.text-input>
                            @error('customer.password_confirmation')
                            <x-forms.error>
                                {{$message}}
                            </x-forms.error>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping & Payment -->
            <div class="space-y-6 2xl:space-y-8">
                <!-- Shipping-->
                @include('order.shared.delivery', $deliveries)
                <!-- Payment-->
                @include('order.shared.payment', $payments)
            </div>

            <!-- Checkout -->
            <div class="p-6 2xl:p-8 rounded-[20px] bg-card">
                <h3 class="mb-6 text-md 2xl:text-lg font-bold">Заказ</h3>
                <table class="w-full border-spacing-y-3 text-body text-xxs text-left" style="border-collapse: separate">
                    <thead class="text-[12px] text-body uppercase">
                    <th scope="col" class="pb-2 border-b border-body/60">Товар</th>
                    <th scope="col" class="px-2 pb-2 border-b border-body/60">К-во</th>
                    <th scope="col" class="px-2 pb-2 border-b border-body/60">Сумма</th>
                    </thead>
                    <tbody>
                    @each('order.shared.products-item', $items,'item')
                    </tbody>
                </table>
                <div class="text-xs font-semibold text-right">Всего: {{ cart()->amount() }}</div>

                <div class="mt-8 space-y-8">
                    <!-- Summary -->
                    <table class="w-full text-left">
                        <tbody>
                        <tr>
                            <th scope="row" class="pb-2 text-xs font-medium">Доставка:</th>
                            <td class="pb-2 text-xs">600 ₽</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-md 2xl:text-lg font-black">Итого:</th>
                            <td class="text-md 2xl:text-lg font-black">245 930 ₽</td>
                        </tr>
                        </tbody>
                    </table>

                    <!-- Process to check out -->
                    <button type="submit" class="w-full btn btn-pink">Оформить заказ</button>
                </div>
            </div>
        </form>
    </section>
@endsection