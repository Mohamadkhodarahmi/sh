@extends('layouts.app')

@section('title', 'ورود')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
    <h2 class="text-3xl font-bold mb-6 text-center">ورود به حساب کاربری</h2>
    
    <form action="{{ route('login') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="email" class="block text-gray-700 mb-2">ایمیل</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" 
                   required autofocus>
        </div>
        
        <div class="mb-4">
            <label for="password" class="block text-gray-700 mb-2">رمز عبور</label>
            <input type="password" id="password" name="password" 
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" 
                   required>
        </div>
        
        <div class="mb-4 flex items-center">
            <input type="checkbox" id="remember" name="remember" class="ml-2">
            <label for="remember" class="text-gray-700">مرا به خاطر بسپار</label>
        </div>
        
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-bold">
            ورود
        </button>
    </form>
    
    <p class="mt-4 text-center text-gray-600">
        حساب کاربری ندارید؟ 
        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">ثبت‌نام کنید</a>
    </p>
</div>
@endsection

