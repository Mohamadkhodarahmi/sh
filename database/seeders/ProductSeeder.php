<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::where('slug', 'electronics')->first();
        $clothing = Category::where('slug', 'clothing')->first();
        $home = Category::where('slug', 'home-kitchen')->first();
        $books = Category::where('slug', 'books-stationery')->first();
        $sports = Category::where('slug', 'sports-entertainment')->first();

        $products = [
            // الکترونیک
            [
                'category_id' => $electronics?->id ?? 1,
                'name_fa' => 'لپ‌تاپ Lenovo ThinkPad',
                'name_en' => 'Lenovo ThinkPad Laptop',
                'slug' => 'lenovo-thinkpad-laptop',
                'description' => 'لپ‌تاپ قدرتمند با پردازنده Intel Core i7، رم 16GB، هارد SSD 512GB. مناسب برای کارهای سنگین و طراحی گرافیک.',
                'short_description' => 'لپ‌تاپ حرفه‌ای با پردازنده قدرتمند',
                'price' => 35000000,
                'discount_price' => 31500000,
                'stock' => 15,
                'is_active' => true,
                'is_featured' => true,
                'views' => 245,
                'sales_count' => 32,
            ],
            [
                'category_id' => $electronics?->id ?? 1,
                'name_fa' => 'گوشی موبایل Samsung Galaxy S24',
                'name_en' => 'Samsung Galaxy S24',
                'slug' => 'samsung-galaxy-s24',
                'description' => 'گوشی هوشمند با نمایشگر 6.2 اینچ، دوربین 50 مگاپیکسل، پردازنده Snapdragon 8 Gen 3.',
                'short_description' => 'گوشی پرچمدار با دوربین قدرتمند',
                'price' => 45000000,
                'discount_price' => 40500000,
                'stock' => 8,
                'is_active' => true,
                'is_featured' => true,
                'views' => 521,
                'sales_count' => 67,
            ],
            [
                'category_id' => $electronics?->id ?? 1,
                'name_fa' => 'هدفون بی‌سیم Sony WH-1000XM5',
                'name_en' => 'Sony WH-1000XM5 Wireless Headphones',
                'slug' => 'sony-wh1000xm5',
                'description' => 'هدفون نویز کنسلینگ با کیفیت صوتی عالی، باتری 30 ساعته و شارژ سریع.',
                'short_description' => 'هدفون نویز کنسلینگ حرفه‌ای',
                'price' => 12000000,
                'discount_price' => null,
                'stock' => 25,
                'is_active' => true,
                'is_featured' => false,
                'views' => 189,
                'sales_count' => 45,
            ],
            [
                'category_id' => $electronics?->id ?? 1,
                'name_fa' => 'تبلت Apple iPad Pro',
                'name_en' => 'Apple iPad Pro',
                'slug' => 'apple-ipad-pro',
                'description' => 'تبلت حرفه‌ای با نمایشگر 11 اینچ، تراشه M2، قابلیت طراحی و ویرایش ویدیو.',
                'short_description' => 'تبلت حرفه‌ای برای کارهای خلاقانه',
                'price' => 55000000,
                'discount_price' => 49500000,
                'stock' => 12,
                'is_active' => true,
                'is_featured' => true,
                'views' => 312,
                'sales_count' => 28,
            ],
            
            // پوشاک
            [
                'category_id' => $clothing?->id ?? 2,
                'name_fa' => 'کت و شلوار مردانه',
                'name_en' => 'Men\'s Suit',
                'slug' => 'mens-suit',
                'description' => 'کت و شلوار کلاسیک مردانه از جنس پشم مرغوب، مناسب برای مجالس و محیط کار.',
                'short_description' => 'کت و شلوار کلاسیک و شیک',
                'price' => 8500000,
                'discount_price' => 6800000,
                'stock' => 30,
                'is_active' => true,
                'is_featured' => true,
                'views' => 156,
                'sales_count' => 23,
            ],
            [
                'category_id' => $clothing?->id ?? 2,
                'name_fa' => 'کفش ورزشی Nike Air Max',
                'name_en' => 'Nike Air Max Running Shoes',
                'slug' => 'nike-air-max',
                'description' => 'کفش ورزشی راحت و سبک با تکنولوژی Air Max، مناسب برای دویدن و ورزش.',
                'short_description' => 'کفش ورزشی با کیفیت بالا',
                'price' => 5200000,
                'discount_price' => null,
                'stock' => 45,
                'is_active' => true,
                'is_featured' => false,
                'views' => 278,
                'sales_count' => 89,
            ],
            [
                'category_id' => $clothing?->id ?? 2,
                'name_fa' => 'کت زمستانه زنانه',
                'name_en' => 'Women\'s Winter Coat',
                'slug' => 'womens-winter-coat',
                'description' => 'کت زمستانه گرم و شیک از جنس پارچه باکیفیت، با آستین‌های بلند و کلاه.',
                'short_description' => 'کت زمستانه گرم و راحت',
                'price' => 6200000,
                'discount_price' => 4960000,
                'stock' => 20,
                'is_active' => true,
                'is_featured' => true,
                'views' => 134,
                'sales_count' => 17,
            ],
            
            // خانه و آشپزخانه
            [
                'category_id' => $home?->id ?? 3,
                'name_fa' => 'ست قابلمه استیل',
                'name_en' => 'Stainless Steel Cookware Set',
                'slug' => 'stainless-steel-cookware',
                'description' => 'ست قابلمه 7 تکه از جنس استیل ضدزنگ، مناسب برای پخت و پز حرفه‌ای.',
                'short_description' => 'ست قابلمه باکیفیت و بادوام',
                'price' => 3200000,
                'discount_price' => 2560000,
                'stock' => 18,
                'is_active' => true,
                'is_featured' => false,
                'views' => 98,
                'sales_count' => 34,
            ],
            [
                'category_id' => $home?->id ?? 3,
                'name_fa' => 'مبلمان راحتی',
                'name_en' => 'Comfortable Sofa',
                'slug' => 'comfortable-sofa',
                'description' => 'مبلمان راحتی 3 نفره با پارچه مخمل، مناسب برای اتاق پذیرایی.',
                'short_description' => 'مبلمان راحتی و لوکس',
                'price' => 45000000,
                'discount_price' => 36000000,
                'stock' => 5,
                'is_active' => true,
                'is_featured' => true,
                'views' => 267,
                'sales_count' => 8,
            ],
            
            // کتاب
            [
                'category_id' => $books?->id ?? 4,
                'name_fa' => 'کتاب "هنر ظریف رهایی از دغدغه‌ها"',
                'name_en' => 'The Subtle Art of Not Giving a F*ck',
                'slug' => 'subtle-art-book',
                'description' => 'کتاب پرفروش مارک منسن درباره فلسفه زندگی و رهایی از نگرانی‌های بی‌معنا.',
                'short_description' => 'کتاب پرفروش در حوزه خودیاری',
                'price' => 850000,
                'discount_price' => null,
                'stock' => 50,
                'is_active' => true,
                'is_featured' => false,
                'views' => 445,
                'sales_count' => 156,
            ],
            [
                'category_id' => $books?->id ?? 4,
                'name_fa' => 'ست دفتر و خودکار لوکس',
                'name_en' => 'Luxury Notebook and Pen Set',
                'slug' => 'luxury-notebook-pen',
                'description' => 'ست دفتر چرمی با خودکار خودنویس از برند معتبر، مناسب برای هدیه.',
                'short_description' => 'ست دفتر و خودکار لوکس',
                'price' => 2800000,
                'discount_price' => 2240000,
                'stock' => 15,
                'is_active' => true,
                'is_featured' => true,
                'views' => 89,
                'sales_count' => 12,
            ],
            
            // ورزش
            [
                'category_id' => $sports?->id ?? 5,
                'name_fa' => 'توپ فوتبال Adidas',
                'name_en' => 'Adidas Football',
                'slug' => 'adidas-football',
                'description' => 'توپ فوتبال حرفه‌ای با تکنولوژی Adidas، مناسب برای تمرین و مسابقه.',
                'short_description' => 'توپ فوتبال باکیفیت',
                'price' => 1800000,
                'discount_price' => null,
                'stock' => 60,
                'is_active' => true,
                'is_featured' => false,
                'views' => 234,
                'sales_count' => 78,
            ],
            [
                'category_id' => $sports?->id ?? 5,
                'name_fa' => 'دوچرخه ورزشی',
                'name_en' => 'Exercise Bike',
                'slug' => 'exercise-bike',
                'description' => 'دوچرخه ثابت ورزشی با مانیتور نمایش اطلاعات، مناسب برای خانه.',
                'short_description' => 'دوچرخه ثابت ورزشی',
                'price' => 15000000,
                'discount_price' => 12000000,
                'stock' => 10,
                'is_active' => true,
                'is_featured' => true,
                'views' => 178,
                'sales_count' => 6,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
