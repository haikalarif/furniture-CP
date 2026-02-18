<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Article;
use App\Models\Testimonial;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'promo_products' => Product::promo()->count(),
            'testimonials' => Testimonial::count(),
            'new_messages' => ContactMessage::new()->count(),
        ];

        $recentProducts = Product::latest()->take(5)->get();
        $promoProducts = Product::promo()->latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProducts', 'promoProducts', 'recentMessages'));
    }
}
