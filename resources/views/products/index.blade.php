@extends('layouts.app')

@section('title', 'محصولات')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold mb-4">محصولات</h1>
    
    <!-- Search -->
    <form method="GET" action="{{ route('products.index') }}" class="mb-6">
        <div class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="جستجوی محصول..." 
                   class="flex-1 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                جستجو
            </button>
        </div>
    </form>
    
    <!-- Categories -->
    @if($categories->count() > 0)
    <div class="mb-6">
        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('products.index') }}" 
               class="px-4 py-2 rounded {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                همه
            </a>
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" 
                   class="px-4 py-2 rounded {{ request('category') == $category->id ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                    {{ $category->name_fa }}
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Products Grid -->
@if($products->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @foreach($products as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            @if($product->images && count($product->images) > 0)
                <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name_fa }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">بدون تصویر</span>
                </div>
            @endif
            <div class="p-4">
                <h3 class="font-bold text-lg mb-2">{{ $product->name_fa }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->short_description ?? $product->description, 60) }}</p>
                <div class="flex justify-between items-center">
                    <div>
                        @if($product->discount_price)
                            <span class="text-red-600 font-bold text-lg">{{ number_format($product->discount_price) }} تومان</span>
                            <span class="text-gray-400 line-through text-sm mr-2">{{ number_format($product->price) }}</span>
                        @else
                            <span class="text-blue-600 font-bold text-lg">{{ number_format($product->price) }} تومان</span>
                        @endif
                    </div>
                    <a href="{{ route('products.show', $product->slug) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">مشاهده</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="mt-8">
    {{ $products->links() }}
</div>
@else
<div class="text-center py-12">
    <p class="text-gray-600 text-xl">محصولی یافت نشد</p>
</div>
@endif
@endsection

