@extends('layouts.app')

@section('title', 'سبد خرید')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <header class="mb-12">
        <h1 class="text-3xl font-bold mb-2">سبد خرید</h1>
    </header>

    @if($cartItems->count() > 0)
    <div class="space-y-8">
        @foreach($cartItems as $item)
            <article class="border-b border-black pb-8">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Product Image -->
                    @if($item->product->images && count($item->product->images) > 0)
                        <div class="w-full md:w-32 flex-shrink-0">
                            <img src="{{ asset('storage/' . $item->product->images[0]) }}" 
                                 alt="{{ $item->product->name_fa }}" 
                                 class="w-full h-32 md:h-32 object-cover">
                        </div>
                    @endif
                    
                    <!-- Product Info -->
                    <div class="flex-1">
                        <h2 class="text-xl font-bold mb-2">{{ $item->product->name_fa }}</h2>
                        @if($item->product->short_description)
                            <p class="text-sm text-black mb-4">{{ Str::limit($item->product->short_description, 80) }}</p>
                        @endif
                        
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex flex-col gap-2">
                                <span class="text-sm">قیمت واحد: <span class="font-medium">{{ number_format($item->price) }} تومان</span></span>
                                <span class="text-sm">جمع: <span class="font-bold text-lg">{{ number_format($item->total) }} تومان</span></span>
                            </div>
                            
                            <div class="flex flex-col gap-3">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" 
                                           name="quantity" 
                                           value="{{ $item->quantity }}" 
                                           min="1" 
                                           max="{{ $item->product->stock }}"
                                           class="w-20 px-0 py-2 border-0 border-b border-black bg-transparent focus:outline-none focus:border-black text-sm text-center">
                                    <button type="submit" class="text-xs underline hover:opacity-60 transition">
                                        بروزرسانی
                                    </button>
                                </form>
                                
                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs underline hover:opacity-60 transition text-black">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
    
    <div class="mt-12 pt-8 border-t border-black">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <span class="text-sm">جمع کل:</span>
                <span class="text-3xl font-bold mr-2">{{ number_format($total) }} تومان</span>
            </div>
            <a href="{{ route('orders.checkout') }}" 
               class="bg-black text-white px-8 py-3 text-sm font-medium hover:opacity-80 transition text-center">
                ادامه و ثبت سفارش
            </a>
        </div>
    </div>
    @else
    <div class="text-center py-20">
        <p class="text-sm mb-6">سبد خرید شما خالی است</p>
        <a href="{{ route('products.index') }}" 
           class="bg-black text-white px-8 py-3 text-sm font-medium hover:opacity-80 transition inline-block">
            مشاهده محصولات
        </a>
    </div>
    @endif
</div>
@endsection

