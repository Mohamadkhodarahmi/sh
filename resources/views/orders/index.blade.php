@extends('layouts.app')

@section('title', 'سفارشات من')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <header class="mb-12">
        <h1 class="text-3xl font-bold mb-2">سفارشات من</h1>
    </header>

    @if($orders->count() > 0)
    <div class="space-y-8">
        @foreach($orders as $order)
            <article class="border-b border-black pb-8" itemscope itemtype="https://schema.org/Order">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-xl font-bold mb-1" itemprop="orderNumber">
                            سفارش #{{ $order->order_number }}
                        </h2>
                        <time class="text-xs text-black" datetime="{{ $order->created_at->toIso8601String() }}" itemprop="orderDate">
                            {{ $order->created_at->format('d F Y، H:i') }}
                        </time>
                    </div>
                    <div>
                        @php
                            $statusLabels = [
                                'pending' => 'در انتظار',
                                'processing' => 'در حال پردازش',
                                'shipped' => 'ارسال شده',
                                'delivered' => 'تحویل داده شده',
                                'cancelled' => 'لغو شده',
                            ];
                            $statusText = $statusLabels[$order->status] ?? 'در انتظار';
                        @endphp
                        <span class="text-xs font-medium">
                            {{ $statusText }}
                        </span>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-sm font-bold mb-4">محصولات:</h3>
                    <ul class="space-y-3">
                        @foreach($order->items as $item)
                            <li class="flex justify-between items-center text-sm">
                                <span>{{ $item->product_name }} <span class="text-xs text-black">({{ $item->quantity }} عدد)</span></span>
                                <span class="font-medium">{{ number_format($item->total) }} تومان</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="flex justify-between items-center pt-4 border-t border-black">
                    <div>
                        <span class="text-sm">جمع کل:</span>
                        <span class="text-xl font-bold mr-2" itemprop="totalPrice">{{ number_format($order->total) }} تومان</span>
                    </div>
                    <a href="{{ route('orders.show', $order->id) }}" 
                       class="bg-black text-white px-6 py-2 text-xs font-medium hover:opacity-80 transition">
                        مشاهده جزئیات
                    </a>
                </div>
            </article>
        @endforeach
    </div>

    @if($orders->hasPages())
        <nav class="mt-16 border-t border-black pt-8" aria-label="صفحه‌بندی سفارشات">
            {{ $orders->links('pagination::simple-tailwind') }}
        </nav>
    @endif
    @else
    <div class="text-center py-20">
        <p class="text-sm mb-6">شما هنوز سفارشی ثبت نکرده‌اید</p>
        <a href="{{ route('products.index') }}" class="bg-black text-white px-8 py-3 text-sm font-medium hover:opacity-80 transition inline-block">
            مشاهده محصولات
        </a>
    </div>
    @endif
</div>
@endsection

