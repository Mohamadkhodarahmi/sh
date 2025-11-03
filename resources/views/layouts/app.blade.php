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
    @if(View::hasSection('og_title'))
        <meta property="og:title" content="@yield('og_title')">
    @else
        <meta property="og:title" content="@yield('title', 'فروشگاه اینترنتی')">
    @endif
    @if(View::hasSection('og_description'))
        <meta property="og:description" content="@yield('og_description')">
    @else
        <meta property="og:description" content="@yield('description', 'فروشگاه اینترنتی با بهترین محصولات')">
    @endif
    @if(View::hasSection('og_image'))
        <meta property="og:image" content="@yield('og_image')">
    @else
        <meta property="og:image" content="{{ asset('storage/products/تست.webp') }}">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:site_name" content="فروشگاه">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'فروشگاه اینترنتی')">
    <meta name="twitter:description" content="@yield('description', 'فروشگاه اینترنتی با بهترین محصولات')">
    @if(View::hasSection('og_image'))
        <meta name="twitter:image" content="@yield('og_image')">
    @else
        <meta name="twitter:image" content="{{ asset('storage/products/تست.webp') }}">
    @endif
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Font Preconnect for faster loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font loaded asynchronously to prevent render blocking -->
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'; this.onload=null;">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </noscript>
    
    <!-- Structured Data (JSON-LD) -->
    @stack('structured_data')
    
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #ffffff;
            color: #000000;
        }
        /* Font will be applied once loaded */
        html.fonts-loaded body,
        html.fonts-loaded {
            font-family: 'Vazirmatn', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        .minimal-nav-link {
            text-decoration: none;
            color: #000;
            font-weight: 400;
            letter-spacing: 0.5px;
            position: relative;
            display: inline-block;
            transition: opacity 0.2s;
        }
        .minimal-nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            right: 0;
            width: 100%;
            height: 2px;
            background-color: #000;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }
        .minimal-nav-link:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }
        .minimal-nav-link:hover {
            opacity: 1;
        }
        .minimal-nav-link.font-bold::after {
            transform: scaleX(1);
            transform-origin: left;
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
        /* Header scroll effect */
        header {
            transition: all 0.3s ease;
            background: #ffffff;
            box-shadow: none;
            will-change: transform, opacity;
        }
        header.scrolled {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        header.scrolled .border-b {
            border-bottom-width: 1px;
        }
        header.scrolled nav[aria-label="منوی اصلی"] {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        header.scrolled nav[aria-label="منوی اصلی"] > div:first-child {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        header.scrolled nav[aria-label="منوی اصلی"] a.text-4xl {
            font-size: 1.5rem;
            transition: font-size 0.3s ease;
        }
        header.scrolled nav[aria-label="منوی اصلی"] > div:last-child {
            padding-bottom: 0.5rem;
        }
        /* Prevent layout shift */
        header > div:first-child {
            transition: opacity 0.3s ease, visibility 0.3s ease;
            min-height: 40px;
        }
        header.scrolled > div:first-child {
            opacity: 0;
            visibility: hidden;
            height: 0;
            min-height: 0;
            overflow: hidden;
            border-bottom: none;
            pointer-events: none;
            margin: 0;
            padding: 0;
        }
        header nav[aria-label="ابزارهای سایت"] {
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        header.scrolled nav[aria-label="ابزارهای سایت"] {
            opacity: 0;
            visibility: hidden;
            height: 0;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-white text-black antialiased">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 focus:z-50 focus:p-2 focus:bg-black focus:text-white">
        رفتن به محتوای اصلی
    </a>
    
    <!-- Minimal Header -->
    <header class="fixed top-0 left-0 right-0 z-50 border-b border-black bg-white" role="banner" id="main-header">
        <!-- Top Utility Bar -->
        <div class="border-b border-black transition-all duration-300 hidden md:block">
            <div class="max-w-7xl mx-auto px-4 transition-all duration-300">
                <nav class="flex justify-between items-center h-10 text-xs transition-all duration-300" aria-label="ابزارهای سایت">
                    <div class="flex items-center gap-6">
                        @auth
                            <div class="flex items-center gap-2">
                                <span class="text-black font-medium">{{ auth()->user()->name }}</span>
                            </div>
                        @endauth
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="tel:09057449268" class="minimal-nav-link text-xs" aria-label="تماس با پشتیبانی ۰۹۰۵۷۴۴۹۲۶۸">
                            پشتیبانی: ۰۹۰۵۷۴۴۹۲۶۸
                        </a>
                        <span class="text-xs text-black hidden lg:inline" aria-label="ساعت کاری پشتیبانی">ساعت کاری: ۱۰ شب تا ۵</span>
                        <a href="#search" class="minimal-nav-link text-xs">جستجو</a>
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
        
        <!-- Mobile Utility Bar -->
        <div class="border-b border-black md:hidden">
            <div class="px-4 py-2">
                <div class="flex justify-between items-center gap-4 text-xs">
                    <div class="flex items-center gap-3 overflow-x-auto">
                        @auth
                            <span class="text-black font-medium whitespace-nowrap">{{ auth()->user()->name }}</span>
                        @endauth
                        <a href="tel:09057449268" class="minimal-nav-link whitespace-nowrap">پشتیبانی</a>
                        @auth
                            <a href="{{ route('cart.index') }}" class="minimal-nav-link relative whitespace-nowrap">
                                سبد خرید
                                @php
                                    $cartCount = \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity');
                                @endphp
                                @if($cartCount > 0)
                                    <span class="absolute -top-1 -right-1 bg-black text-white text-[8px] w-3 h-3 flex items-center justify-center rounded-full">{{ $cartCount }}</span>
                                @endif
                            </a>
                            <a href="{{ route('orders.index') }}" class="minimal-nav-link whitespace-nowrap">سفارشات</a>
                        @else
                            <a href="{{ route('login') }}" class="minimal-nav-link whitespace-nowrap">ورود</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="max-w-7xl mx-auto px-4 transition-all duration-300" role="navigation" aria-label="منوی اصلی">
            <div class="flex justify-center items-center py-4 md:py-6 transition-all duration-300">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl md:text-4xl font-bold tracking-tight text-black hover:opacity-70 transition-all duration-300" aria-label="صفحه اصلی فروشگاه">
                    فروشگاه
                </a>
            </div>
            
            <!-- Main Menu -->
            <div class="flex justify-center items-center gap-6 md:gap-12 pb-4 md:pb-6 transition-all duration-300">
                <a href="{{ route('home') }}" class="minimal-nav-link text-sm md:text-base {{ request()->routeIs('home') ? 'font-bold' : '' }}" aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}">خانه</a>
                <a href="{{ route('products.index') }}" class="minimal-nav-link text-sm md:text-base {{ request()->routeIs('products.*') ? 'font-bold' : '' }}" aria-current="{{ request()->routeIs('products.*') ? 'page' : 'false' }}">محصولات</a>
            </div>
        </nav>
    </header>
    
    <!-- Header spacer to prevent layout shift -->
    <div id="header-spacer" style="transition: height 0.3s ease;"></div>

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
