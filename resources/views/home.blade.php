@extends('layouts.app')

@section('title', 'خانه')
@section('description', 'فروشگاه اینترنتی با بهترین محصولات و قیمت‌های مناسب. محصولات ویژه و جدید با تخفیف‌های عالی')
@section('keywords', 'فروشگاه اینترنتی, خرید آنلاین, محصولات ویژه, تخفیف, بهترین قیمت')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <!-- Hero Section -->
    <header class="text-center mb-16">
        <h1 class="text-5xl font-bold mb-4 tracking-tight">محصولات ویژه</h1>
        <p class="text-sm text-gray-600">بهترین محصولات با بهترین قیمت</p>
    </header>

    @if($featuredProducts->count() > 0)
    <section class="mb-20" aria-labelledby="featured-products-heading">
        <h2 id="featured-products-heading" class="sr-only">محصولات ویژه</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" role="list" aria-label="لیست محصولات ویژه">
            @foreach($featuredProducts as $product)
                <article class="group" role="listitem" itemscope itemtype="https://schema.org/Product">
                    <a href="{{ route('products.show', $product->slug) }}" class="block" itemprop="url">
                        <!-- Product Image -->
                        <div class="relative mb-4 bg-gray-50 aspect-square overflow-hidden">
                            @if($product->images && is_array($product->images) && count($product->images) > 0)
                                <img src="{{ asset('storage/' . $product->images[0]) }}" 
                                     alt="{{ $product->name_fa }}" 
                                     class="w-full h-full object-cover group-hover:opacity-80 transition"
                                     itemprop="image"
                                     loading="lazy"
                                     width="400"
                                     height="400">
                            @else
                                <div class="w-full h-full flex items-center justify-center" role="img" aria-label="بدون تصویر">
                                    <span class="text-gray-400 text-xs">بدون تصویر</span>
                                </div>
                            @endif
                            
                            @if($product->discount_price)
                                <div class="absolute top-0 left-0 bg-black text-white text-xs px-2 py-1" aria-label="تخفیف {{ $product->discount_percent }} درصد">
                                    {{ $product->discount_percent }}%
                                </div>
                            @endif
                        </div>
                        
                        <!-- Product Info -->
                        <div>
                            <h3 class="text-sm font-medium mb-1 line-clamp-2" itemprop="name">{{ $product->name_fa }}</h3>
                            <div class="flex items-baseline gap-2" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                @if($product->discount_price)
                                    <span class="text-sm font-medium" itemprop="price" content="{{ $product->discount_price }}">
                                        {{ number_format($product->discount_price) }} تومان
                                    </span>
                                    <meta itemprop="priceCurrency" content="IRR">
                                    <span class="text-xs line-through text-gray-500" aria-label="قیمت اصلی">{{ number_format($product->price) }}</span>
                                @else
                                    <span class="text-sm font-medium" itemprop="price" content="{{ $product->price }}">
                                        {{ number_format($product->price) }} تومان
                                    </span>
                                    <meta itemprop="priceCurrency" content="IRR">
                                @endif
                                <meta itemprop="availability" content="{{ $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}">
                            </div>
                            @if($product->stock <= 0)
                                <p class="text-xs text-gray-500 mt-1" aria-label="محصول ناموجود">ناموجود</p>
                            @endif
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </section>
    @endif

    @if($latestProducts->count() > 0)
    <section class="mb-20" aria-labelledby="latest-products-heading">
        <header class="text-center mb-12">
            <h2 id="latest-products-heading" class="text-3xl font-bold tracking-tight">جدیدترین محصولات</h2>
        </header>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" role="list" aria-label="لیست جدیدترین محصولات">
            @foreach($latestProducts as $product)
                <article class="group" role="listitem" itemscope itemtype="https://schema.org/Product">
                    <a href="{{ route('products.show', $product->slug) }}" class="block" itemprop="url">
                        <!-- Product Image -->
                        <div class="relative mb-4 bg-gray-50 aspect-square overflow-hidden">
                            @if($product->images && is_array($product->images) && count($product->images) > 0)
                                <img src="{{ asset('storage/' . $product->images[0]) }}" 
                                     alt="{{ $product->name_fa }}" 
                                     class="w-full h-full object-cover group-hover:opacity-80 transition"
                                     itemprop="image"
                                     loading="lazy"
                                     width="400"
                                     height="400">
                            @else
                                <div class="w-full h-full flex items-center justify-center" role="img" aria-label="بدون تصویر">
                                    <span class="text-gray-400 text-xs">بدون تصویر</span>
                                </div>
                            @endif
                            
                            @if($product->discount_price)
                                <div class="absolute top-0 left-0 bg-black text-white text-xs px-2 py-1" aria-label="تخفیف {{ $product->discount_percent }} درصد">
                                    {{ $product->discount_percent }}%
                                </div>
                            @endif
                        </div>
                        
                        <!-- Product Info -->
                        <div>
                            <h3 class="text-sm font-medium mb-1 line-clamp-2" itemprop="name">{{ $product->name_fa }}</h3>
                            <div class="flex items-baseline gap-2" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                @if($product->discount_price)
                                    <span class="text-sm font-medium" itemprop="price" content="{{ $product->discount_price }}">
                                        {{ number_format($product->discount_price) }} تومان
                                    </span>
                                    <meta itemprop="priceCurrency" content="IRR">
                                    <span class="text-xs line-through text-gray-500" aria-label="قیمت اصلی">{{ number_format($product->price) }}</span>
                                @else
                                    <span class="text-sm font-medium" itemprop="price" content="{{ $product->price }}">
                                        {{ number_format($product->price) }} تومان
                                    </span>
                                    <meta itemprop="priceCurrency" content="IRR">
                                @endif
                                <meta itemprop="availability" content="{{ $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}">
                            </div>
                            @if($product->stock <= 0)
                                <p class="text-xs text-gray-500 mt-1" aria-label="محصول ناموجود">ناموجود</p>
                            @endif
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
