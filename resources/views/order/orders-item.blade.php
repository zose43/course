@extends('layouts.app')
@section('section')
    <!-- Breadcrumbs -->
    <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
        <li><a class="text-body hover:text-pink text-xs" href="index.html">Главная</a></li>
        <li><a class="text-body hover:text-pink text-xs" href="orders.html">Мои заказы</a></li>
        <li><span class="text-body text-xs">Заказ №3517</span></li>
    </ul>

    <section>
        <!-- Section heading -->
        <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-6 mb-8">
            <h1 class="pb-4 md:pb-0 text-lg lg:text-[42px] font-black">Заказ №3517</h1>
            <div class="px-6 py-3 rounded-lg bg-purple">Выполнено</div>
            <div class="px-6 py-3 rounded-lg bg-card">Дата заказа: 17.09.2022</div>
        </div>

        <!-- Message -->
        <div class="md:hidden py-3 px-6 rounded-lg bg-pink text-white">Таблицу можно пролистать вправо →</div>

        <!-- Adaptive table -->
        <div class="overflow-auto">
            <table class="min-w-full border-spacing-y-4 text-white text-sm text-left" style="border-collapse: separate">
                <thead class="text-xs uppercase">
                <th class="py-3 px-6" scope="col">Товар</th>
                <th class="py-3 px-6" scope="col">Цена</th>
                <th class="py-3 px-6" scope="col">Количество</th>
                <th class="py-3 px-6" scope="col">Сумма</th>
                </thead>
                <tbody>
                <tr>
                    <td class="py-4 px-6 rounded-l-2xl bg-card" scope="row">
                        <div class="flex flex-col lg:flex-row min-w-[200px] gap-2 lg:gap-6">
                            <div class="shrink-0 overflow-hidden w-[64px] lg:w-[84px] h-[64px] lg:h-[84px] rounded-2xl">
                                <img alt="SteelSeries Aerox 3 Snow" class="object-cover w-full h-full" src="../../images/products/1.jpg">
                            </div>
                            <div class="py-3">
                                <h4 class="text-xs sm:text-sm xl:text-md font-bold"><a class="inline-block text-white hover:text-pink" href="product.html">SteelSeries
                                        Aerox 3 Snow</a></h4>
                                <ul class="space-y-1 mt-2 text-xs">
                                    <li class="text-body">Цвет: Белый</li>
                                    <li class="text-body">Размер (хват): Средний</li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6 bg-card">
                        <div class="font-medium whitespace-nowrap">43 900 ₽</div>
                    </td>
                    <td class="py-4 px-6 bg-card">2</td>
                    <td class="py-4 px-6 bg-card rounded-r-2xl">
                        <div class="font-medium whitespace-nowrap">87 800 ₽</div>
                    </td>
                </tr>
                <tr>
                    <td class="py-4 px-6 rounded-l-2xl bg-card" scope="row">
                        <div class="flex flex-col lg:flex-row min-w-[200px] gap-2 lg:gap-6">
                            <div class="shrink-0 overflow-hidden w-[64px] lg:w-[84px] h-[64px] lg:h-[84px] rounded-2xl">
                                <img alt="SteelSeries Arctis 5 White 2019 Edition" class="object-cover w-full h-full" src="../../images/products/5.jpg">
                            </div>
                            <div class="py-3">
                                <h4 class="text-xs sm:text-sm xl:text-md font-bold"><a class="inline-block text-white hover:text-pink" href="product.html">SteelSeries
                                        Arctis 5 White 2019 Edition</a></h4>
                                <ul class="space-y-1 mt-2 text-xs">
                                    <li class="text-body">Цвет: Белый</li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6 bg-card">
                        <div class="font-medium whitespace-nowrap">58 730 ₽</div>
                    </td>
                    <td class="py-4 px-6 bg-card">1</td>
                    <td class="py-4 px-6 bg-card rounded-r-2xl">
                        <div class="font-medium whitespace-nowrap">58 730 ₽</div>
                    </td>
                </tr>
                <tr>
                    <td class="py-4 px-6 rounded-l-2xl bg-card" scope="row">
                        <div class="flex flex-col lg:flex-row min-w-[200px] gap-2 lg:gap-6">
                            <div class="shrink-0 overflow-hidden w-[64px] lg:w-[84px] h-[64px] lg:h-[84px] rounded-2xl">
                                <img alt="Hator Hypersport V2 (HTC-948) Black/White" class="object-cover w-full h-full" src="../../images/products/9.jpg">
                            </div>
                            <div class="py-3">
                                <h4 class="text-xs sm:text-sm xl:text-md font-bold"><a class="inline-block text-white hover:text-pink" href="product.html">Hator
                                        Hypersport V2 (HTC-948) Black/White</a></h4>
                                <ul class="space-y-1 mt-2 text-xs">
                                    <li class="text-body">Цвет: Черно-белый</li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6 bg-card">
                        <div class="font-medium whitespace-nowrap">142 800 ₽</div>
                    </td>
                    <td class="py-4 px-6 bg-card">1</td>
                    <td class="py-4 px-6 bg-card rounded-r-2xl">
                        <div class="font-medium whitespace-nowrap">142 800 ₽</div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="flex flex-col-reverse md:flex-row md:items-center md:justify-between mt-8 gap-6">
            <div class="flex md:justify-end">
                <a class="btn btn-pink" href="{{ route('order.index') }}">←&nbsp; Вернуться назад</a>
            </div>
            <div class="text-[32px] font-black md:text-right">Итого: 289 330 ₽</div>
        </div>
    </section>
@endsection