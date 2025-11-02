@extends('layouts.app')

@section('title', 'سفارشات من')

@section('content')
<h1 class="text-4xl font-bold mb-8">سفارشات من</h1>

@if($orders->count() > 0)
<div class="space-y-6">
    @foreach($orders as $order)
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-bold">سفارش #{{ $order->order_number }}</h3>
                    <p class="text-gray-600 text-sm">{{ $order->created_at->format('Y/m/d H:i') }}</p>
                </div>
                <div class="text-left">
                    @php
                        $statusLabels = [
                            'pending' => ['text' => 'در انتظار', 'color' => 'bg-yellow-100 text-yellow-800'],
                            'processing' => ['text' => 'در حال پردازش', 'color' => 'bg-blue-100 text-blue-800'],
                            'shipped' => ['text' => 'ارسال شده', 'color' => 'bg-purple-100 text-purple-800'],
                            'delivered' => ['text' => 'تحویل داده شده', 'color' => 'bg-green-100 text-green-800'],
                            'cancelled' => ['text' => 'لغو شده', 'color' => 'bg-red-100 text-red-800'],
                        ];
                        $status = $statusLabels[$order->status] ?? $statusLabels['pending'];
                    @endphp
                    <span class="px-3 py-1 rounded {{ $status['color'] }} text-sm font-bold">
                        {{ $status['text'] }}
                    </span>
                </div>
            </div>
            
            <div class="mb-4">
                <h4 class="font-bold mb-2">محصولات:</h4>
                <ul class="space-y-2">
                    @foreach($order->items as $item)
                        <li class="flex justify-between text-sm">
                            <span>{{ $item->product_name }} ({{ $item->quantity }} عدد)</span>
                            <span>{{ number_format($item->total) }} تومان</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <div class="flex justify-between items-center pt-4 border-t">
                <div>
                    <span class="text-gray-600">جمع کل:</span>
                    <span class="text-xl font-bold text-green-600 mr-2">{{ number_format($order->total) }} تومان</span>
                </div>
                <a href="{{ route('orders.show', $order->id) }}" 
                   class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    مشاهده جزئیات
                </a>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-8">
    {{ $orders->links() }}
</div>
@else
<div class="text-center py-12 bg-white rounded-lg shadow-md">
    <p class="text-gray-600 text-xl mb-4">شما هنوز سفارشی ثبت نکرده‌اید</p>
    <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 inline-block">
        مشاهده محصولات
    </a>
</div>
@endif
@endsection

