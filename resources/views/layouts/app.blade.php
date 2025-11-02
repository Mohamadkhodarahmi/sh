<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'فروشگاه اینترنتی')</title>
    
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-700">فروشگاه</a>
                    
                    <div class="hidden md:flex gap-4">
                        <a href="{{ route('home') }}" class="px-4 py-2 hover:text-blue-600 transition {{ request()->routeIs('home') ? 'text-blue-600 font-bold' : '' }}">خانه</a>
                        <a href="{{ route('products.index') }}" class="px-4 py-2 hover:text-blue-600 transition {{ request()->routeIs('products.*') ? 'text-blue-600 font-bold' : '' }}">محصولات</a>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('cart.index') }}" class="relative px-4 py-2 hover:text-blue-600">
                            سبد خرید
                            @php
                                $cartCount = \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity');
                            @endphp
                            @if($cartCount > 0)
                                <span class="absolute top-0 left-0 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
                            @endif
                        </a>
                        <a href="{{ route('orders.index') }}" class="px-4 py-2 hover:text-blue-600">سفارشات</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-red-600 hover:text-red-700">خروج</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 hover:text-blue-600">ورود</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">ثبت‌نام</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Messages -->
    @if(session('success'))
        <div class="bg-green-100 border-r-4 border-green-500 text-green-700 p-4 m-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-r-4 border-red-500 text-red-700 p-4 m-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border-r-4 border-red-500 text-red-700 p-4 m-4 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} فروشگاه اینترنتی. تمامی حقوق محفوظ است.</p>
        </div>
    </footer>
</body>
</html>

