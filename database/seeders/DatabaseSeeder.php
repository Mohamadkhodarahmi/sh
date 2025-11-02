<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ایجاد کاربر نمونه
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'مدیر سیستم',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'phone' => '09123456789',
            ]
        );

        // ایجاد کاربر عادی
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'کاربر تست',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'phone' => '09187654321',
            ]
        );

        // ایجاد دسته‌بندی‌ها
        $this->call([
            CategorySeeder::class,
        ]);

        // ایجاد محصولات
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
