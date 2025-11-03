@extends('layouts.app')

@section('title', 'ورود')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-8 text-center">ورود</h1>
    
    <form action="{{ route('login') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label for="email" class="block text-sm mb-2">ایمیل</label>
            <input type="email" 
                   id="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   class="w-full px-0 py-2 border-0 border-b border-black bg-transparent focus:outline-none focus:border-black text-sm" 
                   required 
                   autofocus>
        </div>
        
        <div>
            <label for="password" class="block text-sm mb-2">رمز عبور</label>
            <input type="password" 
                   id="password" 
                   name="password" 
                   class="w-full px-0 py-2 border-0 border-b border-black bg-transparent focus:outline-none focus:border-black text-sm" 
                   required>
        </div>
        
        <div class="flex items-center">
            <input type="checkbox" 
                   id="remember" 
                   name="remember" 
                   class="ml-2">
            <label for="remember" class="text-sm">مرا به خاطر بسپار</label>
        </div>
        
        <button type="submit" class="w-full bg-black text-white py-3 text-sm font-medium hover:opacity-80 transition mt-8">
            ورود
        </button>
    </form>
    
    <p class="mt-6 text-center text-sm">
        حساب کاربری ندارید؟ 
        <a href="{{ route('register') }}" class="underline hover:opacity-60 transition">ثبت‌نام کنید</a>
    </p>
</div>
@endsection

