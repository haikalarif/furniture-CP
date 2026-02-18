<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $query = Product::active()->ordered();
        
        // Filter by category if provided
        if (request('category')) {
            $query->where('category', request('category'));
        }
        
        $products = $query->paginate(12);
        
        $categories = Product::active()
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('frontend.products.index', compact('products', 'categories'));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedProducts = Product::active()
            ->where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->ordered()
            ->take(4)
            ->get();

        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }
}
