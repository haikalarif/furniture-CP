<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Article;
use App\Models\Page;
use App\Models\Feature;
use App\Models\Gallery;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::active()->featured()->ordered()->take(6)->get();
        $promoProducts = Product::active()->promo()->ordered()->take(6)->get();
        $testimonials = Testimonial::active()->ordered()->take(6)->get();
        $latestArticles = Article::published()->latest()->take(3)->get();
        $features = Feature::active()->ordered()->take(6)->get();
        $galleries = Gallery::active()->ordered()->take(12)->get();
        $homePage = Page::getByKey('home');

        return view('frontend.home', compact(
            'featuredProducts',
            'promoProducts',
            'testimonials',
            'latestArticles',
            'features',
            'galleries',
            'homePage'
        ));
    }

    public function about()
    {
        $aboutPage = Page::getByKey('about');
        
        return view('frontend.about', compact('aboutPage'));
    }

    public function process()
    {
        $processPage = Page::getByKey('process');
        
        return view('frontend.process', compact('processPage'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'subject.required' => 'Subjek wajib diisi',
            'message.required' => 'Pesan wajib diisi',
            'message.min' => 'Pesan minimal 10 karakter',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('contact')
            ->with('success', 'Terima kasih! Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');
    }
}
