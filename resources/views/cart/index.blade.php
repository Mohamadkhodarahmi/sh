@extends('layouts.app')

@section('title', 'سبد خرید')

@section('content')
<h1 class="text-4xl font-bold mb-8">سبد خرید</h1>

@if($cartItems->count() > 0)
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-4 text-right">محصول</th>
                <th class="px-6 py-4 text-center">قیمت واحد</th>
                <th class="px-6 py-4 text-center">تعداد</th>
                <th class="px-6 py-4 text-center">جمع</th>
                <th class="px-6 py-4 text-center">عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
                <tr class="border-t">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            @if($item->product->images && count($item->product->images) > 0)
                                <img src="{{ asset('storage/' . $item->product->images[0]) }}" 
                                     alt="{{ $item->product->name_fa }}" 
                                     class="w-20 h-20 object-cover rounded">
                            @endif
                            <div>
                                <h3 class="font-bold">{{ $item->product->name_fa }}</h3>
                                <p class="text-sm text-gray-600">{{ Str::limit($item->product->short_description, 50) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ number_format($item->price) }} تومان
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center justify-center gap-2">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" 
                                   min="1" max="{{ $item->product->stock }}"
                                   class="w-20 px-2 py-1 border border-gray-300 rounded text-center">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 text-sm">
                                بروزرسانی
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-center font-bold">
                        {{ number_format($item->total) }} تومان
                    </td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                حذف
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-gray-100">
            <tr>
                <td colspan="3" class="px-6 py-4 text-left font-bold">جمع کل:</td>
                <td colspan="2" class="px-6 py-4 text-center font-bold text-2xl">
                    {{ number_format($total) }} تومان
                </td>
            </tr>
        </tfoot>
    </table>
    
    <div class="p-6 text-left">
        <a href="{{ route('orders.checkout') }}" class="bg-green-600 text-white px-8 py-3 rounded hover:bg-green-700 font-bold text-lg">
            ادامه و ثبت سفارش
        </a>
    </div>
</div>
@else
<div class="text-center py-12 bg-white rounded-lg shadow-md">
    <p class="text-gray-600 text-xl mb-4">سبد خرید شما خالی است</p>
    <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 inline-block">
        مشاهده محصولات
    </a>
</div>
@endif
@endsection

