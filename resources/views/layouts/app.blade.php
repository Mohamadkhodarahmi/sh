<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', 'فروشگاه اینترنتی') | فروشگاه</title>
    <meta name="description" content="@yield('description', 'فروشگاه اینترنتی با بهترین محصولات و قیمت‌های مناسب. خرید آسان و سریع از فروشگاه ما.')">
    <meta name="keywords" content="@yield('keywords', 'فروشگاه اینترنتی, خرید آنلاین, محصولات, فروشگاه')">
    <meta name="author" content="فروشگاه اینترنتی">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@hasSection('og_title')@yield('og_title')@else@yield('title', 'فروشگاه اینترنتی')@endif">
    <meta property="og:description" content="@hasSection('og_description')@yield('og_description')@else@yield('description', 'فروشگاه اینترنتی با بهترین محصولات')@endif">
    <meta property="og:image" content="@hasSection('og_image')@yield('og_image')@else{{ asset('storage/products/تست.webp') }}@endif">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:site_name" content="فروشگاه">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'فروشگاه اینترنتی')">
    <meta name="twitter:description" content="@yield('description', 'فروشگاه اینترنتی با بهترین محصولات')">
    <meta name="twitter:image" content="@hasSection('og_image')@yield('og_image')@else{{ asset('storage/products/تست.webp') }}@endif">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Structured Data (JSON-LD) -->
    @hasSection('structured_data')
        @yield('structured_data')
    @endif
    @stack('structured_data')
    
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
            background: #ffffff;
            color: #000000;
        }
        .minimal-nav-link {
            text-decoration: none;
            color: #000;
            font-weight: 400;
            letter-spacing: 0.5px;
            transition: opacity 0.2s;
        }
        .minimal-nav-link:hover {
            opacity: 0.6;
        }
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        /* Focus styles for accessibility */
        a:focus, button:focus, input:focus {
            outline: 2px solid #000;
            outline-offset: 2px;
        }
        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s ease-in-out infinite;
        }
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>
<body class="bg-white text-black antialiased">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 focus:z-50 focus:p-2 focus:bg-black focus:text-white">
        رفتن به محتوای اصلی
    </a>
    
    <!-- Minimal Header -->
    <header class="border-b border-black" role="banner">
        <!-- Top Utility Bar -->
        <div class="border-b border-black">
            <div class="max-w-7xl mx-auto px-4">
                <nav class="flex justify-between items-center h-10 text-xs" aria-label="ابزارهای سایت">
                    <div class="flex items-center gap-6">
                        @auth
                            <span class="text-black">{{ auth()->user()->name }}</span>
                        @endauth
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="#search" class="minimal-nav-link text-xs" aria-label="جستجو">جستجو</a>
                        @auth
                            <a href="{{ route('cart.index') }}" class="minimal-nav-link text-xs relative" aria-label="سبد خرید">
                                سبد خرید
                                @php
                                    $cartCount = \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity');
                                @endphp
                                @if($cartCount > 0)
                                    <span class="absolute -top-2 -right-2 bg-black text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full" aria-label="{{ $cartCount }} آیتم در سبد">{{ $cartCount }}</span>
                                @endif
                            </a>
                            <a href="{{ route('orders.index') }}" class="minimal-nav-link text-xs">سفارشات</a>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="minimal-nav-link text-xs">خروج</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="minimal-nav-link text-xs">ورود</a>
                            <a href="{{ route('register') }}" class="minimal-nav-link text-xs">ثبت‌نام</a>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="max-w-7xl mx-auto px-4" role="navigation" aria-label="منوی اصلی">
            <div class="flex justify-center items-center py-6">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-4xl font-bold tracking-tight text-black hover:opacity-70 transition" aria-label="صفحه اصلی فروشگاه">
                    فروشگاه
                </a>
            </div>
            
            <!-- Main Menu -->
            <div class="flex justify-center items-center gap-12 pb-6">
                <a href="{{ route('home') }}" class="minimal-nav-link {{ request()->routeIs('home') ? 'font-bold' : '' }}" aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}">خانه</a>
                <a href="{{ route('products.index') }}" class="minimal-nav-link {{ request()->routeIs('products.*') ? 'font-bold' : '' }}" aria-current="{{ request()->routeIs('products.*') ? 'page' : 'false' }}">محصولات</a>
            </div>
        </nav>
    </header>

    <!-- Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 py-3 text-sm border-b border-black" role="alert" aria-live="polite">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 py-3 text-sm text-black border-b border-black bg-gray-50" role="alert" aria-live="polite">
            {{ session('error') }}
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="max-w-7xl mx-auto px-4 py-3 text-sm border-b border-black bg-gray-50" role="alert" aria-live="polite">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Content -->
    <main id="main-content" role="main">
        @yield('content')
    </main>

    <!-- Minimal Footer -->
    <footer class="border-t border-black mt-20" role="contentinfo">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="text-center text-sm text-black">
                <p>&copy; {{ date('Y') }} فروشگاه اینترنتی. تمامی حقوق محفوظ است.</p>
            </div>
        </div>
    </footer>
</body>
</html>
