# فروشگاه اینترنتی Laravel (فارسی)

یک سیستم فروشگاه اینترنتی کامل با Laravel که به زبان فارسی و با پشتیبانی کامل RTL طراحی شده است.

## ویژگی‌ها

### کاربری
- ✅ صفحه اصلی با نمایش محصولات ویژه و جدید
- ✅ جستجو و فیلتر محصولات بر اساس دسته‌بندی
- ✅ صفحه جزئیات محصول
- ✅ سبد خرید با امکان ویرایش و حذف
- ✅ ثبت و مدیریت سفارشات
- ✅ سیستم احراز هویت (ثبت‌نام و ورود)

### مدیریتی
- ✅ ساختار پایگاه داده کامل
- ✅ روابط Eloquent بین جداول
- ✅ مدیریت موجودی محصولات
- ✅ محاسبه خودکار قیمت نهایی
- ✅ پشتیبانی از تخفیف

### طراحی
- ✅ رابط کاربری RTL
- ✅ فونت فارسی Vazirmatn
- ✅ طراحی ریسپانسیو با Tailwind CSS
- ✅ UI مدرن و کاربرپسند

## پیش‌نیازها

- PHP >= 8.1
- Composer
- Node.js & npm
- SQLite (یا MySQL/PostgreSQL)

## نصب و راه‌اندازی

### 1. نصب وابستگی‌ها

```bash
composer install
npm install
```

### 2. پیکربندی محیط

فایل `.env` را بررسی کنید:

```env
APP_NAME="فروشگاه"
APP_LOCALE=fa
APP_FALLBACK_LOCALE=fa

DB_CONNECTION=sqlite
# یا برای MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=shop
# DB_USERNAME=root
# DB_PASSWORD=
```

### 3. ساخت کلید اپلیکیشن و اجرای Migration

```bash
php artisan key:generate
php artisan migrate
```

### 4. ساخت لینک Storage

```bash
php artisan storage:link
```

### 5. Build فایل‌های Frontend

```bash
npm run build
```

یا برای توسعه:

```bash
npm run dev
```

### 6. اجرای سرور

```bash
php artisan serve
```

سپس به آدرس `http://localhost:8000` بروید.

## ساختار پایگاه داده

### جداول اصلی:
- `users` - کاربران
- `categories` - دسته‌بندی محصولات
- `products` - محصولات
- `cart_items` - آیتم‌های سبد خرید
- `orders` - سفارشات
- `order_items` - آیتم‌های سفارش

## استفاده

### ایجاد کاربر اولیه

```bash
php artisan tinker
```

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'مدیر',
    'email' => 'admin@example.com',
    'password' => Hash::make('password'),
    'phone' => '09123456789'
]);
```

### اضافه کردن دسته‌بندی

```php
use App\Models\Category;

Category::create([
    'name_fa' => 'الکترونیک',
    'name_en' => 'Electronics',
    'slug' => 'electronics',
    'is_active' => true
]);
```

### اضافه کردن محصول

```php
use App\Models\Product;
use App\Models\Category;

$category = Category::first();

Product::create([
    'category_id' => $category->id,
    'name_fa' => 'لپ‌تاپ Dell',
    'name_en' => 'Dell Laptop',
    'slug' => 'dell-laptop',
    'description' => 'توضیحات کامل محصول',
    'short_description' => 'توضیحات کوتاه',
    'price' => 15000000,
    'discount_price' => 13500000,
    'stock' => 10,
    'is_active' => true,
    'is_featured' => true
]);
```

## Routes

### عمومی
- `GET /` - صفحه اصلی
- `GET /products` - لیست محصولات
- `GET /products/{slug}` - جزئیات محصول
- `GET /login` - صفحه ورود
- `GET /register` - صفحه ثبت‌نام

### نیازمند احراز هویت
- `GET /cart` - سبد خرید
- `POST /cart` - افزودن به سبد
- `PUT /cart/{id}` - بروزرسانی سبد
- `DELETE /cart/{id}` - حذف از سبد
- `GET /orders` - لیست سفارشات
- `GET /orders/{id}` - جزئیات سفارش
- `GET /checkout` - صفحه تکمیل سفارش
- `POST /orders` - ثبت سفارش

## نکات مهم

1. **آپلود تصاویر**: تصاویر محصولات در `storage/app/public/products` ذخیره می‌شوند.
2. **محاسبه هزینه ارسال**: هزینه ارسال به صورت ثابت 50,000 تومان در نظر گرفته شده که می‌توانید در `OrderController` تغییر دهید.
3. **وضعیت سفارشات**: 
   - `pending` - در انتظار
   - `processing` - در حال پردازش
   - `shipped` - ارسال شده
   - `delivered` - تحویل داده شده
   - `cancelled` - لغو شده

## توسعه بیشتر

پیشنهادات برای بهبود پروژه:

- [ ] پنل ادمین برای مدیریت محصولات
- [ ] سیستم پرداخت آنلاین
- [ ] ایمیل تایید سفارش
- [ ] سیستم کوپن تخفیف
- [ ] نظر و امتیاز محصولات
- [ ] مقایسه محصولات
- [ ] لیست علاقه‌مندی‌ها

## مجوز

این پروژه برای استفاده شخصی و آموزشی رایگان است.
