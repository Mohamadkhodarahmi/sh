<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_fa' => 'الکترونیک',
                'name_en' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'لوازم الکترونیکی و دیجیتال',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name_fa' => 'لباس و پوشاک',
                'name_en' => 'Clothing',
                'slug' => 'clothing',
                'description' => 'لباس، کفش و پوشاک',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name_fa' => 'خانه و آشپزخانه',
                'name_en' => 'Home & Kitchen',
                'slug' => 'home-kitchen',
                'description' => 'لوازم خانه و آشپزخانه',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name_fa' => 'کتاب و لوازم تحریر',
                'name_en' => 'Books & Stationery',
                'slug' => 'books-stationery',
                'description' => 'کتاب، مجله و لوازم تحریر',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name_fa' => 'ورزش و سرگرمی',
                'name_en' => 'Sports & Entertainment',
                'slug' => 'sports-entertainment',
                'description' => 'لوازم ورزشی و سرگرمی',
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
