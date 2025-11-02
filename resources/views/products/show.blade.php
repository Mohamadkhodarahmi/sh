@extends('layouts.app')

@section('title', $product->name_fa)
@section('description', $product->short_description ?? Str::limit($product->description, 160))
@section('keywords', $product->name_fa . ', ' . ($product->category->name_fa ?? '') . ', خرید, محصول')

@section('og_type', 'product')
@section('og_title', $product->name_fa)
@section('og_description', $product->short_description ?? Str::limit($product->description, 160))
@section('og_image', $product->images && count($product->images) > 0 ? asset('storage/' . $product->images[0]) : asset('storage/products/تست.webp'))

@push('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "{{ $product->name_fa }}",
    "description": "{{ $product->description ?? $product->short_description ?? '' }}",
    "image": "{{ $product->images && count($product->images) > 0 ? asset('storage/' . $product->images[0]) : '' }}",
    "brand": {
        "@type": "Brand",
        "name": "فروشگاه"
    },
    "offers": {
        "@type": "Offer",
        "url": "{{ url()->current() }}",
        "priceCurrency": "IRR",
        "price": "{{ $product->discount_price ?? $product->price }}",
        "priceValidUntil": "{{ now()->addYear()->format('Y-m-d') }}",
        "availability": "{{ $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
        "itemCondition": "https://schema.org/NewCondition"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.5",
        "reviewCount": "{{ $product->sales_count }}"
    }
}
</script>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <nav aria-label="breadcrumb" class="mb-8 text-sm">
        <ol class="flex gap-2">
            <li><a href="{{ route('home') }}" class="hover:opacity-60">خانه</a></li>
            <li>/</li>
            <li><a href="{{ route('products.index') }}" class="hover:opacity-60">محصولات</a></li>
            @if($product->category)
                <li>/</li>
                <li><a href="{{ route('products.index', ['category' => $product->category_id]) }}" class="hover:opacity-60">{{ $product->category->name_fa }}</a></li>
            @endif
            <li>/</li>
            <li class="text-gray-600">{{ $product->name_fa }}</li>
        </ol>
    </nav>

    <article itemscope itemtype="https://schema.org/Product">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
            <!-- Product Image -->
            <div>
                @if($product->images && is_array($product->images) && count($product->images) > 0)
                    <img src="{{ asset('storage/' . $product->images[0]) }}" 
                         alt="{{ $product->name_fa }}" 
                         class="w-full aspect-square object-cover bg-gray-50"
                         itemprop="image"
                         loading="eager"
                         width="800"
                         height="800">
                @else
                    <div class="w-full aspect-square bg-gray-50 flex items-center justify-center" role="img" aria-label="بدون تصویر">
                        <span class="text-gray-400 text-sm">بدون تصویر</span>
                    </div>
                @endif
            </div>
            
            <!-- Product Info -->
            <div>
                @if($product->category)
                    <a href="{{ route('products.index', ['category' => $product->category_id]) }}" 
                       class="text-xs uppercase tracking-wider mb-4 inline-block hover:opacity-60 transition"
                       itemprop="category">
                        {{ $product->category->name_fa }}
                    </a>
                @endif
                
                <h1 class="text-3xl font-bold mb-6 tracking-tight" itemprop="name">{{ $product->name_fa }}</h1>
                
                <!-- Price -->
                <div class="mb-8" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                    @if($product->discount_price)
                        <div class="flex items-baseline gap-4 mb-2">
                            <span class="text-2xl font-medium" itemprop="price" content="{{ $product->discount_price }}">
                                {{ number_format($product->discount_price) }} تومان
                            </span>
                            <meta itemprop="priceCurrency" content="IRR">
                            <span class="text-sm line-through text-gray-500" aria-label="قیمت اصلی">{{ number_format($product->price) }}</span>
                            <span class="text-xs bg-black text-white px-2 py-1" aria-label="تخفیف">{{ $product->discount_percent }}%</span>
                        </div>
                    @else
                        <span class="text-2xl font-medium" itemprop="price" content="{{ $product->price }}">
                            {{ number_format($product->price) }} تومان
                        </span>
                        <meta itemprop="priceCurrency" content="IRR">
                    @endif
                    <meta itemprop="availability" content="{{ $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}">
                    <meta itemprop="url" content="{{ url()->current() }}">
                </div>
                
                <!-- Stock Status -->
                @if($product->stock > 0)
                    <p class="text-sm mb-8" itemprop="availability" content="https://schema.org/InStock">موجود ({{ $product->stock }} عدد)</p>
                @else
                    <p class="text-sm text-gray-500 mb-8" itemprop="availability" content="https://schema.org/OutOfStock">ناموجود</p>
                @endif
                
                <!-- Description -->
                @if($product->description)
                    <div class="mb-8 border-t border-black pt-8" itemprop="description">
                        <h2 class="text-xs uppercase tracking-wider font-bold mb-4">توضیحات</h2>
                        <div class="text-sm leading-relaxed">{{ $product->description }}</div>
                    </div>
                @endif
                
                <!-- Add to Cart -->
                @auth
                    @if($product->stock > 0)
                        <form action="{{ route('cart.store') }}" method="POST" class="border-t border-black pt-8">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="flex gap-4 items-center mb-4">
                                <label for="quantity" class="text-sm">تعداد:</label>
                                <input type="number" 
                                       id="quantity" 
                                       name="quantity" 
                                       value="1" 
                                       min="1" 
                                       max="{{ $product->stock }}" 
                                       class="w-20 px-0 py-2 border-0 border-b border-black bg-transparent focus:outline-none text-center"
                                       aria-label="تعداد محصول">
                            </div>
                            <button type="submit" 
                                    class="w-full bg-black text-white py-4 font-medium hover:opacity-80 transition text-sm"
                                    aria-label="افزودن به سبد خرید">
                                افزودن به سبد خرید
                            </button>
                        </form>
                    @endif
                @else
                    <div class="border-t border-black pt-8">
                        <p class="text-sm mb-4 text-gray-600">برای خرید باید وارد حساب کاربری خود شوید</p>
                        <a href="{{ route('login') }}" 
                           class="inline-block bg-black text-white px-8 py-4 font-medium hover:opacity-80 transition text-sm">
                            ورود / ثبت‌نام
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <section class="mt-20 border-t border-black pt-16" aria-label="محصولات مرتبط">
                <h2 class="text-2xl font-bold mb-8 tracking-tight">محصولات مرتبط</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($relatedProducts as $relatedProduct)
                        <article class="group" itemscope itemtype="https://schema.org/Product">
                            <a href="{{ route('products.show', $relatedProduct->slug) }}" class="block" itemprop="url">
                                <div class="relative mb-4 bg-gray-50 aspect-square overflow-hidden">
                                    @if($relatedProduct->images && is_array($relatedProduct->images) && count($relatedProduct->images) > 0)
                                        <img src="{{ asset('storage/' . $relatedProduct->images[0]) }}" 
                                             alt="{{ $relatedProduct->name_fa }}" 
                                             class="w-full h-full object-cover group-hover:opacity-80 transition"
                                             itemprop="image"
                                             loading="lazy"
                                             width="400"
                                             height="400">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="text-gray-400 text-xs">بدون تصویر</span>
                                        </div>
                                    @endif
                                    
                                    @if($relatedProduct->discount_price)
                                        <div class="absolute top-0 left-0 bg-black text-white text-xs px-2 py-1">
                                            {{ $relatedProduct->discount_percent }}%
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium mb-1 line-clamp-2" itemprop="name">{{ $relatedProduct->name_fa }}</h3>
                                    <div class="flex items-baseline gap-2" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                        @if($relatedProduct->discount_price)
                                            <span class="text-sm font-medium" itemprop="price" content="{{ $relatedProduct->discount_price }}">
                                                {{ number_format($relatedProduct->discount_price) }} تومان
                                            </span>
                                            <meta itemprop="priceCurrency" content="IRR">
                                            <span class="text-xs line-through text-gray-500">{{ number_format($relatedProduct->price) }}</span>
                                        @else
                                            <span class="text-sm font-medium" itemprop="price" content="{{ $relatedProduct->price }}">
                                                {{ number_format($relatedProduct->price) }} تومان
                                            </span>
                                            <meta itemprop="priceCurrency" content="IRR">
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </article>
</div>
@endsection
