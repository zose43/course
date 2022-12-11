@extends('layouts.app')

@section('title', $category->title ?? 'Каталог')

@section('content')
    <!-- Breadcrumbs -->
    <ul class="breadcrumbs flex flex-wrap gap-y-1 gap-x-4 mb-6">
        @each('catalog.shared.breadcrumb', $breadcrumbs, 'item')
    </ul>

    <section>
        <!-- Section heading -->
        <h2 class="text-lg lg:text-[42px] font-black">Категории</h2>

        <!-- Categories -->
        <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5 mt-8">
            @if($categories->isNotEmpty())
                @each('catalog.shared.category',$categories,'item')
            @endif
        </div>
    </section>

    <section class="mt-16 lg:mt-24">
        <!-- Section heading -->
        <h2 class="text-lg lg:text-[42px] font-black">Каталог товаров</h2>

        <div class="flex flex-col lg:flex-row gap-12 lg:gap-6 2xl:gap-8 mt-8">

            <!-- Filters -->
            <aside class="basis-2/5 xl:basis-1/4">
                @include('catalog.shared.filter')
            </aside>

            <div class="basis-auto xl:basis-3/4">
                <!-- Sort by -->
                @include('catalog.shared.product-sort')

                <!-- Products list -->
                <div class="products grid @if(productView('line')) 'grid-cols-1 gap-y-8 gap-x-6' @else 'grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-x-6 2xl:gap-x-8 gap-y-8 lg:gap-y-10 2xl:gap-y-12' @endif">

                    @if(productView('block'))
                        @each('catalog.shared.product',$products, 'item')
                    @else
                        @each('catalog.shared.inline-product',$products, 'item')
                    @endif
                    
                </div>

                <!-- Page pagination -->
                <div class="mt-12">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>

    </section>
@endsection