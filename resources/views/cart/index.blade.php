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
                <tr>
                    <td class="py-4 px-4 md:px-6 rounded-l-2xl bg-card" scope="row">
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
                    <td class="py-4 px-4 md:px-6 bg-card">
                        <div class="font-medium whitespace-nowrap">43 900 ₽</div>
                    </td>
                    <td class="py-4 px-4 md:px-6 bg-card">
                        <div class="flex items-stretch h-[56px] gap-2">
                            <button class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition"
                                    type="button">
                                -
                            </button>
                            <input class="h-full px-2 lg:px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition"
                                   max="999"
                                   min="1" placeholder="К-во" type="number" value="2">
                            <button class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition"
                                    type="button">
                                +
                            </button>
                        </div>
                    </td>
                    <td class="py-4 px-4 md:px-6 bg-card">
                        <div class="font-medium whitespace-nowrap">87 800 ₽</div>
                    </td>
                    <td class="py-4 px-4 md:px-6 rounded-r-2xl bg-card">
                        <a class="w-12 !h-12 !px-0 btn btn-pink" href="#" title="Удалить из корзины">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M49.327 7.857H2.673a2.592 2.592 0 0 0 0 5.184h5.184v31.102a7.778 7.778 0 0 0 7.776 7.776h20.735a7.778 7.778 0 0 0 7.775-7.776V13.041h5.184a2.592 2.592 0 0 0 0-5.184Zm-25.919 28.51a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96Zm10.368 0a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96ZM20.817 5.265h10.367a2.592 2.592 0 0 0 0-5.184H20.817a2.592 2.592 0 1 0 0 5.184Z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="py-4 px-4 md:px-6 rounded-l-2xl bg-card" scope="row">
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
                    <td class="py-4 px-4 md:px-6 bg-card">
                        <div class="font-medium whitespace-nowrap">58 730 ₽</div>
                    </td>
                    <td class="py-4 px-4 md:px-6 bg-card">
                        <div class="flex items-stretch h-[56px] gap-2">
                            <button class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition"
                                    type="button">
                                -
                            </button>
                            <input class="h-full px-2 lg:px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition"
                                   max="999"
                                   min="1" placeholder="К-во" type="number" value="1">
                            <button class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition"
                                    type="button">
                                +
                            </button>
                        </div>
                    </td>
                    <td class="py-4 px-4 md:px-6 bg-card">
                        <div class="font-medium whitespace-nowrap">58 730 ₽</div>
                    </td>
                    <td class="py-4 px-4 md:px-6 rounded-r-2xl bg-card">
                        <a class="w-12 !h-12 !px-0 btn btn-pink" href="#" title="Удалить из корзины">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M49.327 7.857H2.673a2.592 2.592 0 0 0 0 5.184h5.184v31.102a7.778 7.778 0 0 0 7.776 7.776h20.735a7.778 7.778 0 0 0 7.775-7.776V13.041h5.184a2.592 2.592 0 0 0 0-5.184Zm-25.919 28.51a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96Zm10.368 0a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96ZM20.817 5.265h10.367a2.592 2.592 0 0 0 0-5.184H20.817a2.592 2.592 0 1 0 0 5.184Z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="py-4 px-4 md:px-6 rounded-l-2xl bg-card" scope="row">
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
                    <td class="py-4 px-4 md:px-6 bg-card">
                        <div class="font-medium whitespace-nowrap">142 800 ₽</div>
                    </td>
                    <td class="py-4 px-4 md:px-6 bg-card">
                        <div class="flex items-stretch h-[56px] gap-2">
                            <button class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition"
                                    type="button">
                                -
                            </button>
                            <input class="h-full px-2 lg:px-4 rounded-lg border border-body/10 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition"
                                   max="999"
                                   min="1" placeholder="К-во" type="number" value="1">
                            <button class="w-12 h-full rounded-lg border border-body/10 hover:bg-card/20 active:bg-card/50 focus:border-pink focus:shadow-[0_0_0_3px_#EC4176] bg-white/5 text-white text-xs text-center font-bold shadow-transparent outline-0 transition"
                                    type="button">
                                +
                            </button>
                        </div>
                    </td>
                    <td class="py-4 px-4 md:px-6 bg-card">
                        <div class="font-medium whitespace-nowrap">142 800 ₽</div>
                    </td>
                    <td class="py-4 px-4 md:px-6 rounded-r-2xl bg-card">
                        <a class="w-12 !h-12 !px-0 btn btn-pink" href="#" title="Удалить из корзины">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M49.327 7.857H2.673a2.592 2.592 0 0 0 0 5.184h5.184v31.102a7.778 7.778 0 0 0 7.776 7.776h20.735a7.778 7.778 0 0 0 7.775-7.776V13.041h5.184a2.592 2.592 0 0 0 0-5.184Zm-25.919 28.51a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96Zm10.368 0a2.592 2.592 0 0 1-5.184 0V23.409a2.592 2.592 0 1 1 5.184 0v12.96ZM20.817 5.265h10.367a2.592 2.592 0 0 0 0-5.184H20.817a2.592 2.592 0 1 0 0 5.184Z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mt-8">
            <div class="text-[32px] font-black">Итого: 289 330 ₽</div>
            <div class="pb-3 lg:pb-0">
                <a class="text-body hover:text-pink font-medium" href="#">Очистить корзину</a>
            </div>
            <div class="flex flex-col sm:flex-row lg:justify-end gap-4">
                <a class="btn btn-pink" href="catalog.html">За покупками</a>
                <a class="btn btn-purple" href="checkout.html">Оформить заказ</a>
            </div>
        </div>

    </section>
@endsection

