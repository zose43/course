@extends('layouts.app')

@section('title','Корзина')

@section('content')
    <!-- Breadcrumbs -->
    <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
        <li><a class="text-body hover:text-pink text-xs" href="index.html">Главная</a></li>
        <li><span class="text-body text-xs">Корзина покупок</span></li>
    </ul>


    <section>
        <!-- Section heading -->
        <h1 class="mb-8 text-lg lg:text-[42px] font-black">Корзина покупок</h1>

        @if($items->isEmpty())
            <div class="py-3 px-6 rounded-lg bg-pink text-white">Корзина пуста</div>
        @else
            <!-- Message -->
            <div class="lg:hidden py-3 px-6 rounded-lg bg-pink text-white">Таблицу можно пролистать вправо →</div>

            <!-- Adaptive table -->
            <div class="overflow-auto">
                <table class="min-w-full border-spacing-y-4 text-white text-sm text-left" style="border-collapse: separate">
                    <thead class="text-xs uppercase">
                    <th class="py-3 px-6" scope="col">Товар</th>
                    <th class="py-3 px-6" scope="col">Цена</th>
                    <th class="py-3 px-6" scope="col">Количество</th>
                    <th class="py-3 px-6" scope="col">Сумма</th>
                    <th class="py-3 px-6" scope="col"></th>
                    </thead>
                    <tbody>
                    @each('cart.shared.cart-item', $items, 'item')
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mt-8">
                <div class="text-[32px] font-black">Итого: {{ cart()->amount() }}</div>
                <div class="pb-3 lg:pb-0">
                    <form method="POST" action="{{ route('cart.truncate') }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-body hover:text-pink font-medium">
                            Очистить корзину
                        </button>
                    </form>
                </div>
                <div class="flex flex-col sm:flex-row lg:justify-end gap-4">
                    <a class="btn btn-pink" href="{{ route('catalog') }}">За покупками</a>
                    <a class="btn btn-purple" href="{{ route('order.index') }}">Оформить заказ</a>
                </div>
            </div>
        @endif

    </section>
@endsection