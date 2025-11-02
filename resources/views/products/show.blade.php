@extends('layouts.app')

@section('title', $product->name_fa)

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
    <!-- Product Images -->
    <div>
        @if($product->images && count($product->images) > 0)
            <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name_fa }}" class="w-full rounded-lg shadow-lg">
        @else
            <div class="w-full h-96 bg-gray-200 flex items-center justify-center rounded-lg">
                <span class="text-gray-400 text-xl">بدون تصویر</span>
            </div>
        @endif
    </div>
    
    <!-- Product Info -->
    <div>
        <h1 class="text-4xl font-bold mb-4">{{ $product->name_fa }}</h1>
        
        @if($product->category)
        <p class="text-gray-600 mb-4">
            دسته‌بندی: <a href="{{ route('products.index', ['category' => $product->category_id]) }}" class="text-blue-600 hover:underline">{{ $product->category->name_fa }}</a>
        </p>
        @endif
        
        <div class="mb-6">
            @if($product->discount_price)
                <div class="flex items-center gap-4 mb-2">
                    <span class="text-3xl font-bold text-red-600">{{ number_format($product->discount_price) }} تومان</span>
                    <span class="text-xl text-gray-400 line-through">{{ number_format($product->price) }}</span>
                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded">{{ $product->discount_percent }}% تخفیف</span>
                </div>
            @else
                <span class="text-3xl font-bold text-blue-600">{{ number_format($product->price) }} تومان</span>
            @endif
        </div>
        
        @if($product->stock > 0)
            <p class="text-green-600 mb-4">موجود در انبار ({{ $product->stock }} عدد)</p>
        @else
            <p class="text-red-600 mb-4">ناموجود</p>
        @endif
        
        @if($product->description)
        <div class="mb-6">
            <h3 class="font-bold text-lg mb-2">توضیحات:</h3>
            <p class="text-gray-700">{{ $product->description }}</p>
        </div>
        @endif
        
        @auth
            @if($product->stock > 0)
            <form action="{{ route('cart.store') }}" method="POST" class="flex gap-4 items-center">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                       class="w-20 px-4 py-2 border border-gray-300 rounded text-center">
                <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded hover:bg-blue-700 font-bold">
                    افزودن به سبد خرید
                </button>
            </form>
            @endif
        @else
            <p class="text-gray-600 mb-4">برای خرید باید وارد حساب کاربری خود شوید</p>
            <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-8 py-2 rounded hover:bg-blue-700">
                ورود / ثبت‌نام
            </a>
        @endauth
    </div>
</div>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<section class="mt-12">
    <h2 class="text-2xl font-bold mb-6">محصولات مرتبط</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($relatedProducts as $relatedProduct)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                @if($relatedProduct->images && count($relatedProduct->images) > 0)
                    <img src="{{ asset('storage/' . $relatedProduct->images[0]) }}" alt="{{ $relatedProduct->name_fa }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">بدون تصویر</span>
                    </div>
                @endif
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">{{ $relatedProduct->name_fa }}</h3>
                    <div class="mb-4">
                        @if($relatedProduct->discount_price)
                            <span class="text-red-600 font-bold">{{ number_format($relatedProduct->discount_price) }} تومان</span>
                            <span class="text-gray-400 line-through text-sm mr-2">{{ number_format($relatedProduct->price) }}</span>
                        @else
                            <span class="text-blue-600 font-bold">{{ number_format($relatedProduct->price) }} تومان</span>
                        @endif
                    </div>
                    <a href="{{ route('products.show', $relatedProduct->slug) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 block text-center">مشاهده</a>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif
@endsection

