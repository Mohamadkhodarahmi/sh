@extends('layouts.app')

@section('title', 'ثبت‌نام')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
    <h2 class="text-3xl font-bold mb-6 text-center">ثبت‌نام</h2>
    
    <form action="{{ route('register') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="name" class="block text-gray-700 mb-2">نام و نام خانوادگی</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" 
                   required autofocus>
        </div>
        
        <div class="mb-4">
            <label for="email" class="block text-gray-700 mb-2">ایمیل</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" 
                   required>
        </div>
        
        <div class="mb-4">
            <label for="phone" class="block text-gray-700 mb-2">شماره تلفن (اختیاری)</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
        </div>
        
        <div class="mb-4">
            <label for="password" class="block text-gray-700 mb-2">رمز عبور</label>
            <input type="password" id="password" name="password" 
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" 
                   required>
        </div>
        
        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 mb-2">تکرار رمز عبور</label>
            <input type="password" id="password_confirmation" name="password_confirmation" 
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" 
                   required>
        </div>
        
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-bold">
            ثبت‌نام
        </button>
    </form>
    
    <p class="mt-4 text-center text-gray-600">
        قبلا ثبت‌نام کرده‌اید؟ 
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">وارد شوید</a>
    </p>
</div>
@endsection

