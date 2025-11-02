<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml for SEO';

    public function handle()
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        // Home page
        $xml .= '  <url>' . PHP_EOL;
        $xml .= '    <loc>' . url('/') . '</loc>' . PHP_EOL;
        $xml .= '    <lastmod>' . now()->toAtomString() . '</lastmod>' . PHP_EOL;
        $xml .= '    <changefreq>daily</changefreq>' . PHP_EOL;
        $xml .= '    <priority>1.0</priority>' . PHP_EOL;
        $xml .= '  </url>' . PHP_EOL;

        // Products index
        $xml .= '  <url>' . PHP_EOL;
        $xml .= '    <loc>' . route('products.index') . '</loc>' . PHP_EOL;
        $xml .= '    <lastmod>' . now()->toAtomString() . '</lastmod>' . PHP_EOL;
        $xml .= '    <changefreq>daily</changefreq>' . PHP_EOL;
        $xml .= '    <priority>0.9</priority>' . PHP_EOL;
        $xml .= '  </url>' . PHP_EOL;

        // Categories
        Category::where('is_active', true)->each(function ($category) use (&$xml) {
            $xml .= '  <url>' . PHP_EOL;
            $xml .= '    <loc>' . route('products.index', ['category' => $category->id]) . '</loc>' . PHP_EOL;
            $xml .= '    <lastmod>' . $category->updated_at->toAtomString() . '</lastmod>' . PHP_EOL;
            $xml .= '    <changefreq>weekly</changefreq>' . PHP_EOL;
            $xml .= '    <priority>0.8</priority>' . PHP_EOL;
            $xml .= '  </url>' . PHP_EOL;
        });

        // Products
        Product::where('is_active', true)->each(function ($product) use (&$xml) {
            $xml .= '  <url>' . PHP_EOL;
            $xml .= '    <loc>' . route('products.show', $product->slug) . '</loc>' . PHP_EOL;
            $xml .= '    <lastmod>' . $product->updated_at->toAtomString() . '</lastmod>' . PHP_EOL;
            $xml .= '    <changefreq>weekly</changefreq>' . PHP_EOL;
            $xml .= '    <priority>0.7</priority>' . PHP_EOL;
            $xml .= '  </url>' . PHP_EOL;
        });

        $xml .= '</urlset>';

        File::put(public_path('sitemap.xml'), $xml);

        $this->info('Sitemap generated successfully at: ' . public_path('sitemap.xml'));
    }
}
