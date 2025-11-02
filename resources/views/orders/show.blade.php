@extends('layouts.app')

@section('title', 'جزئیات سفارش')

@section('content')
<h1 class="text-4xl font-bold mb-8">جزئیات سفارش #{{ $order->order_number }}</h1>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Order Details -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Status -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4">وضعیت سفارش</h2>
            @php
                $statusLabels = [
                    'pending' => ['text' => 'در انتظار پردازش', 'color' => 'bg-yellow-100 text-yellow-800'],
                    'processing' => ['text' => 'در حال پردازش', 'color' => 'bg-blue-100 text-blue-800'],
                    'shipped' => ['text' => 'ارسال شده', 'color' => 'bg-purple-100 text-purple-800'],
                    'delivered' => ['text' => 'تحویل داده شده', 'color' => 'bg-green-100 text-green-800'],
                    'cancelled' => ['text' => 'لغو شده', 'color' => 'bg-red-100 text-red-800'],
                ];
                $status = $statusLabels[$order->status] ?? $statusLabels['pending'];
            @endphp
            <span class="inline-block px-4 py-2 rounded {{ $status['color'] }} font-bold text-lg">
                {{ $status['text'] }}
            </span>
            <p class="text-gray-600 mt-2">تاریخ ثبت: {{ $order->created_at->format('Y/m/d H:i') }}</p>
        </div>
        
        <!-- Items -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4">محصولات سفارش</h2>
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-right">محصول</th>
                        <th class="px-4 py-3 text-center">تعداد</th>
                        <th class="px-4 py-3 text-center">قیمت واحد</th>
                        <th class="px-4 py-3 text-center">جمع</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $item->product_name }}</td>
                            <td class="px-4 py-3 text-center">{{ $item->quantity }}</td>
                            <td class="px-4 py-3 text-center">{{ number_format($item->price) }} تومان</td>
                            <td class="px-4 py-3 text-center font-bold">{{ number_format($item->total) }} تومان</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Summary -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
            <h2 class="text-2xl font-bold mb-6">خلاصه سفارش</h2>
            
            <div class="space-y-3 mb-6">
                <div class="flex justify-between">
                    <span>جمع محصولات:</span>
                    <span>{{ number_format($order->subtotal) }} تومان</span>
                </div>
                <div class="flex justify-between">
                    <span>هزینه ارسال:</span>
                    <span>{{ number_format($order->shipping_cost) }} تومان</span>
                </div>
                @if($order->discount > 0)
                <div class="flex justify-between text-red-600">
                    <span>تخفیف:</span>
                    <span>-{{ number_format($order->discount) }} تومان</span>
                </div>
                @endif
                <div class="flex justify-between text-xl font-bold pt-4 border-t">
                    <span>جمع کل:</span>
                    <span class="text-green-600">{{ number_format($order->total) }} تومان</span>
                </div>
            </div>
            
            <div class="border-t pt-6">
                <h3 class="font-bold mb-3">اطلاعات ارسال:</h3>
                <p class="text-sm text-gray-700 mb-1"><strong>نام:</strong> {{ $order->shipping_name }}</p>
                <p class="text-sm text-gray-700 mb-1"><strong>تلفن:</strong> {{ $order->shipping_phone }}</p>
                <p class="text-sm text-gray-700 mb-1"><strong>شهر:</strong> {{ $order->shipping_city }}</p>
                <p class="text-sm text-gray-700 mb-1"><strong>آدرس:</strong> {{ $order->shipping_address }}</p>
                @if($order->shipping_postal_code)
                    <p class="text-sm text-gray-700 mb-1"><strong>کد پستی:</strong> {{ $order->shipping_postal_code }}</p>
                @endif
                @if($order->notes)
                    <p class="text-sm text-gray-700 mt-3"><strong>یادداشت:</strong> {{ $order->notes }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-6">
    <a href="{{ route('orders.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700">
        بازگشت به لیست سفارشات
    </a>
</div>
@endsection

