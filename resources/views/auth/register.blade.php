@extends('layouts.app')

@section('title', 'ثبت‌نام')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-8 text-center">ثبت‌نام</h1>
    
    <form action="{{ route('register') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label for="name" class="block text-sm mb-2">نام و نام خانوادگی</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   value="{{ old('name') }}" 
                   class="w-full px-0 py-2 border-0 border-b border-black bg-transparent focus:outline-none focus:border-black text-sm" 
                   required 
                   autofocus>
        </div>
        
        <div>
            <label for="email" class="block text-sm mb-2">ایمیل</label>
            <input type="email" 
                   id="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   class="w-full px-0 py-2 border-0 border-b border-black bg-transparent focus:outline-none focus:border-black text-sm" 
                   required>
        </div>
        
        <div>
            <label for="phone" class="block text-sm mb-2">شماره تلفن (اختیاری)</label>
            <input type="text" 
                   id="phone" 
                   name="phone" 
                   value="{{ old('phone') }}" 
                   class="w-full px-0 py-2 border-0 border-b border-black bg-transparent focus:outline-none focus:border-black text-sm">
        </div>
        
        <div>
            <label for="password" class="block text-sm mb-2">رمز عبور</label>
            <input type="password" 
                   id="password" 
                   name="password" 
                   class="w-full px-0 py-2 border-0 border-b border-black bg-transparent focus:outline-none focus:border-black text-sm" 
                   required>
        </div>
        
        <div>
            <label for="password_confirmation" class="block text-sm mb-2">تکرار رمز عبور</label>
            <input type="password" 
                   id="password_confirmation" 
                   name="password_confirmation" 
                   class="w-full px-0 py-2 border-0 border-b border-black bg-transparent focus:outline-none focus:border-black text-sm" 
                   required>
        </div>
        
        <button type="submit" class="w-full bg-black text-white py-3 text-sm font-medium hover:opacity-80 transition mt-8">
            ثبت‌نام
        </button>
    </form>
    
    <p class="mt-6 text-center text-sm">
        قبلا ثبت‌نام کرده‌اید؟ 
        <a href="{{ route('login') }}" class="underline hover:opacity-60 transition">وارد شوید</a>
    </p>
</div>
@endsection

