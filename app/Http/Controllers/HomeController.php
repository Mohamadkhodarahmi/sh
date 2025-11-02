<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->limit(8)
            ->get();
        
        $latestProducts = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();
        
        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->get();

        return view('home', compact('featuredProducts', 'latestProducts', 'categories'));
    }
}
