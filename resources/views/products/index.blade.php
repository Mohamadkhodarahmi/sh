@extends('layouts.app')

@section('title', 'محصولات')
@section('description', 'مشاهده و خرید محصولات با کیفیت با قیمت‌های مناسب')
@section('keywords', 'محصولات, خرید, فروشگاه, قیمت, تخفیف')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex gap-12">
        <!-- Sidebar Filters -->
        <aside class="w-64 flex-shrink-0 hidden lg:block" role="complementary" aria-label="فیلترها">
            <div class="sticky top-24">
                <!-- Search -->
                <form method="GET" action="{{ route('products.index') }}" class="mb-8" role="search">
                    <label for="search-input" class="sr-only">جستجوی محصولات</label>
                    <input type="text" 
                           id="search-input"
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="جستجو..." 
                           class="w-full px-0 py-2 border-0 border-b border-black bg-transparent focus:outline-none focus:border-black text-sm"
                           aria-label="جستجوی محصولات">
                    <button type="submit" class="mt-2 text-xs text-black underline">جستجو</button>
                </form>

                <!-- Categories -->
                <nav class="mb-8" aria-label="دسته‌بندی محصولات">
                    <h3 class="text-xs font-bold uppercase tracking-wider mb-4">دسته‌بندی‌ها</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('products.index') }}" 
                               class="text-sm {{ !request('category') ? 'font-bold' : '' }} hover:opacity-60 transition"
                               aria-current="{{ !request('category') ? 'page' : 'false' }}">
                                همه
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('products.index', ['category' => $category->id]) }}" 
                                   class="text-sm {{ request('category') == $category->id ? 'font-bold' : '' }} hover:opacity-60 transition"
                                   aria-current="{{ request('category') == $category->id ? 'page' : 'false' }}">
                                    {{ $category->name_fa }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Page Title -->
            <header class="mb-8">
                <h1 class="text-3xl font-bold mb-2">
                    @if(request('category'))
                        @php
                            $cat = $categories->where('id', request('category'))->first();
                        @endphp
                        {{ $cat ? $cat->name_fa : 'محصولات' }}
                    @else
                        محصولات
                    @endif
                </h1>
                
                <!-- Filters Bar -->
                <div class="flex items-center gap-6 mt-6 text-xs border-b border-black pb-4">
                    <span class="font-bold">فیلتر:</span>
                    <button class="hover:opacity-60 transition" aria-label="فیلتر بر اساس قیمت">قیمت</button>
                    <button class="hover:opacity-60 transition" aria-label="فیلتر بر اساس موجودی">موجودی</button>
                </div>
            </header>

            <!-- Products Grid -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" role="list" aria-label="لیست محصولات">
                    @foreach($products as $product)
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
                                    <h2 class="text-sm font-medium mb-1 line-clamp-2" itemprop="name">{{ $product->name_fa }}</h2>
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

                <!-- Pagination -->
                @if($products->hasPages())
                    <nav class="mt-16 border-t border-black pt-8" aria-label="صفحه‌بندی محصولات">
                        {{ $products->links('pagination::simple-tailwind') }}
                    </nav>
                @endif
            @else
                <div class="text-center py-20">
                    <p class="text-sm text-gray-500">محصولی یافت نشد</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
