@extends('layouts.app')

@section('title', 'تکمیل سفارش')

@section('content')
<h1 class="text-4xl font-bold mb-8">تکمیل سفارش</h1>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Order Form -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-6">اطلاعات ارسال</h2>
            
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="shipping_name" class="block text-gray-700 mb-2">نام و نام خانوادگی *</label>
                    <input type="text" id="shipping_name" name="shipping_name" 
                           value="{{ old('shipping_name', auth()->user()->name) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" 
                           required>
                </div>
                
                <div class="mb-4">
                    <label for="shipping_phone" class="block text-gray-700 mb-2">شماره تلفن *</label>
                    <input type="text" id="shipping_phone" name="shipping_phone" 
                           value="{{ old('shipping_phone', auth()->user()->phone) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" 
                           required>
                </div>
                
                <div class="mb-4">
                    <label for="shipping_city" class="block text-gray-700 mb-2">شهر *</label>
                    <input type="text" id="shipping_city" name="shipping_city" 
                           value="{{ old('shipping_city', auth()->user()->city) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" 
                           required>
                </div>
                
                <div class="mb-4">
                    <label for="shipping_address" class="block text-gray-700 mb-2">آدرس کامل *</label>
                    <textarea id="shipping_address" name="shipping_address" rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" 
                              required>{{ old('shipping_address', auth()->user()->address) }}</textarea>
                </div>
                
                <div class="mb-4">
                    <label for="shipping_postal_code" class="block text-gray-700 mb-2">کد پستی</label>
                    <input type="text" id="shipping_postal_code" name="shipping_postal_code" 
                           value="{{ old('shipping_postal_code', auth()->user()->postal_code) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                </div>
                
                <div class="mb-6">
                    <label for="notes" class="block text-gray-700 mb-2">یادداشت (اختیاری)</label>
                    <textarea id="notes" name="notes" rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">{{ old('notes') }}</textarea>
                </div>
                
                <button type="submit" class="w-full bg-green-600 text-white py-3 rounded hover:bg-green-700 font-bold text-lg">
                    ثبت و نهایی کردن سفارش
                </button>
            </form>
        </div>
    </div>
    
    <!-- Order Summary -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
            <h2 class="text-2xl font-bold mb-6">خلاصه سفارش</h2>
            
            <div class="space-y-4 mb-6">
                @foreach($cartItems as $item)
                    <div class="flex justify-between items-center pb-4 border-b">
                        <div>
                            <p class="font-bold">{{ $item->product->name_fa }}</p>
                            <p class="text-sm text-gray-600">{{ $item->quantity }} عدد × {{ number_format($item->price) }} تومان</p>
                        </div>
                        <p class="font-bold">{{ number_format($item->total) }} تومان</p>
                    </div>
                @endforeach
            </div>
            
            <div class="space-y-2 mb-6">
                <div class="flex justify-between">
                    <span>جمع محصولات:</span>
                    <span>{{ number_format($cartItems->sum('total')) }} تومان</span>
                </div>
                <div class="flex justify-between">
                    <span>هزینه ارسال:</span>
                    <span>{{ number_format(50000) }} تومان</span>
                </div>
                <div class="flex justify-between text-xl font-bold pt-4 border-t">
                    <span>جمع کل:</span>
                    <span class="text-green-600">{{ number_format($cartItems->sum('total') + 50000) }} تومان</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

