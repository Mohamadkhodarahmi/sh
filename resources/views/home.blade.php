@extends('layouts.app')

@section('title', 'خانه')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold mb-4">خوش آمدید به فروشگاه ما</h1>
    <p class="text-xl text-gray-600">بهترین محصولات با بهترین قیمت</p>
</div>

@if($featuredProducts->count() > 0)
<section class="mb-12">
    <h2 class="text-2xl font-bold mb-6">محصولات ویژه</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($featuredProducts as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                @if($product->images && is_array($product->images) && count($product->images) > 0)
                    <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name_fa }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                        <span class="text-gray-500 text-sm">بدون تصویر</span>
                    </div>
                @endif
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2 line-clamp-2">{{ $product->name_fa }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($product->short_description ?? $product->description, 60) }}</p>
                    <div class="flex justify-between items-center flex-wrap gap-2">
                        <div class="flex flex-col">
                            @if($product->discount_price)
                                <span class="text-red-600 font-bold text-lg">{{ number_format($product->discount_price) }} تومان</span>
                                <span class="text-gray-400 line-through text-xs">{{ number_format($product->price) }} تومان</span>
                            @else
                                <span class="text-blue-600 font-bold text-lg">{{ number_format($product->price) }} تومان</span>
                            @endif
                        </div>
                        <a href="{{ route('products.show', $product->slug) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm whitespace-nowrap">مشاهده</a>
                    </div>
                    @if($product->stock > 0)
                        <p class="text-green-600 text-xs mt-2">✓ موجود ({{ $product->stock }} عدد)</p>
                    @else
                        <p class="text-red-600 text-xs mt-2">✗ ناموجود</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>
@else
<div class="bg-yellow-50 border-r-4 border-yellow-400 p-4 mb-8 rounded">
    <p class="text-yellow-800">هیچ محصول ویژه‌ای موجود نیست</p>
</div>
@endif

@if($latestProducts->count() > 0)
<section class="mb-12">
    <h2 class="text-2xl font-bold mb-6">جدیدترین محصولات</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($latestProducts as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                @if($product->images && is_array($product->images) && count($product->images) > 0)
                    <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name_fa }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-green-100 to-blue-100 flex items-center justify-center">
                        <span class="text-gray-500 text-sm">بدون تصویر</span>
                    </div>
                @endif
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2 line-clamp-2">{{ $product->name_fa }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($product->short_description ?? $product->description, 60) }}</p>
                    <div class="flex justify-between items-center flex-wrap gap-2">
                        <div class="flex flex-col">
                            @if($product->discount_price)
                                <span class="text-red-600 font-bold text-lg">{{ number_format($product->discount_price) }} تومان</span>
                                <span class="text-gray-400 line-through text-xs">{{ number_format($product->price) }} تومان</span>
                            @else
                                <span class="text-blue-600 font-bold text-lg">{{ number_format($product->price) }} تومان</span>
                            @endif
                        </div>
                        <a href="{{ route('products.show', $product->slug) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm whitespace-nowrap">مشاهده</a>
                    </div>
                    @if($product->stock > 0)
                        <p class="text-green-600 text-xs mt-2">✓ موجود ({{ $product->stock }} عدد)</p>
                    @else
                        <p class="text-red-600 text-xs mt-2">✗ ناموجود</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>
@else
<div class="bg-yellow-50 border-r-4 border-yellow-400 p-4 mb-8 rounded">
    <p class="text-yellow-800">هیچ محصول جدیدی موجود نیست</p>
</div>
@endif
@endsection

