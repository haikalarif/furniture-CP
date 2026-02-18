@extends('layouts.frontend')

@section('title', 'KalKayu Living - Premium Furniture & Interior')

@section('content')

{{-- Debug Info (hanya tampil jika APP_DEBUG=true) --}}
@if(config('app.debug'))
<div class="fixed bottom-4 right-4 bg-black bg-opacity-90 text-white p-4 rounded-lg text-xs z-50 max-w-md shadow-2xl">
    <div class="font-bold mb-2 text-yellow-300">🔍 Hero Debug Info:</div>
    <div class="space-y-1">
        <div><span class="text-gray-400">Theme:</span> <span class="text-green-300">{{ $homePage->hero_theme ?? 'NULL' }}</span></div>
        <div><span class="text-gray-400">Title:</span> {{ Str::limit($homePage->hero_title ?? 'NULL', 30) }}</div>
        <div><span class="text-gray-400">Background:</span> <span class="text-blue-300">{{ $homePage->hero_background ?? 'NULL' }}</span></div>
        @if($homePage && $homePage->hero_background)
            <div><span class="text-gray-400">Full URL:</span> <span class="text-purple-300 break-all">{{ asset('storage/' . $homePage->hero_background) }}</span></div>
            <div><span class="text-gray-400">File Exists:</span> 
                <span class="{{ file_exists(public_path('storage/' . $homePage->hero_background)) ? 'text-green-400' : 'text-red-400' }}">
                    {{ file_exists(public_path('storage/' . $homePage->hero_background)) ? '✓ YES' : '✗ NO' }}
                </span>
            </div>
        @endif
    </div>
    <div class="mt-2 pt-2 border-t border-gray-600 text-gray-400 text-xs">
        Disable di .env: APP_DEBUG=false
    </div>
</div>
@endif

@php
    // Get hero theme colors and decorations
    $themeConfig = [
        'default' => [
            'gradient' => 'from-amber-50 to-stone-100',
            'accent' => 'text-amber-700',
            'decoration' => '',
        ],
        'ramadan' => [
            'gradient' => 'from-purple-900 via-indigo-900 to-blue-900',
            'accent' => 'text-yellow-300',
            'decoration' => '🌙✨',
            'text_color' => 'text-white',
        ],
        'idul-fitri' => [
            'gradient' => 'from-green-600 via-emerald-500 to-teal-500',
            'accent' => 'text-yellow-200',
            'decoration' => '✨🎉',
            'text_color' => 'text-white',
        ],
        'idul-adha' => [
            'gradient' => 'from-green-700 via-green-600 to-emerald-600',
            'accent' => 'text-yellow-100',
            'decoration' => '🐑🕌',
            'text_color' => 'text-white',
        ],
        'natal' => [
            'gradient' => 'from-red-700 via-green-700 to-red-700',
            'accent' => 'text-yellow-300',
            'decoration' => '🎄⛄',
            'text_color' => 'text-white',
        ],
        'tahun-baru' => [
            'gradient' => 'from-blue-900 via-purple-900 to-pink-900',
            'accent' => 'text-yellow-300',
            'decoration' => '🎆🎊',
            'text_color' => 'text-white',
        ],
        'imlek' => [
            'gradient' => 'from-red-600 via-red-500 to-yellow-500',
            'accent' => 'text-yellow-200',
            'decoration' => '🧧🐉',
            'text_color' => 'text-white',
        ],
        'kemerdekaan' => [
            'gradient' => 'from-red-600 via-white to-red-600',
            'accent' => 'text-red-700',
            'decoration' => '🇮🇩🎌',
            'text_color' => 'text-gray-900',
        ],
    ];

    $currentTheme = $homePage->hero_theme ?? 'default';
    $theme = $themeConfig[$currentTheme] ?? $themeConfig['default'];
    
    $heroTitle = $homePage->hero_title ?? 'Furniture Premium untuk Hunian Impian';
    $heroSubtitle = $homePage->hero_subtitle ?? 'Desain custom minimalis dengan material berkualitas tinggi, dibuat khusus untuk Anda';
@endphp

<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Layer -->
    <div class="absolute inset-0 z-0">
        @if($homePage && $homePage->hero_background)
            <!-- Custom Background Image -->
            <img src="{{ asset('storage/' . $homePage->hero_background) }}" 
                 alt="Hero Background"
                 class="w-full h-full object-cover">
            <!-- Overlay Gradient (lebih transparan) -->
            <div class="absolute inset-0 bg-gradient-to-br {{ $theme['gradient'] }} opacity-60"></div>
        @else
            <!-- Default Gradient Background -->
            <div class="absolute inset-0 bg-gradient-to-br {{ $theme['gradient'] }}"></div>
        @endif
    </div>

    <!-- Decorative Elements -->
    @if(!empty($theme['decoration']))
        <div class="absolute top-10 left-10 text-6xl opacity-20 animate-pulse">
            {{ Str::substr($theme['decoration'], 0, 2) }}
        </div>
        <div class="absolute bottom-10 right-10 text-6xl opacity-20 animate-pulse" style="animation-delay: 1s;">
            {{ Str::substr($theme['decoration'], 2) }}
        </div>
        <div class="absolute top-1/4 right-1/4 text-4xl opacity-10">
            {{ $theme['decoration'] }}
        </div>
        <div class="absolute bottom-1/4 left-1/4 text-4xl opacity-10" style="animation-delay: 0.5s;">
            {{ $theme['decoration'] }}
        </div>
    @endif

    <div class="container mx-auto px-4 text-center relative z-10">
        @if(!empty($theme['decoration']))
            <div class="text-5xl mb-4 animate-bounce drop-shadow-2xl">
                {{ $theme['decoration'] }}
            </div>
        @endif

        <h1 class="text-5xl md:text-7xl font-bold {{ $theme['text_color'] ?? 'text-gray-800' }} mb-6 animate-fade-in" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.5);">
            {{ $heroTitle }}
            @if($currentTheme !== 'default')
                <br><span class="{{ $theme['accent'] }}" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.5);">{{ ucwords(str_replace('-', ' ', $currentTheme)) }}</span>
            @else
                <br><span class="{{ $theme['accent'] }}" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.5);"></span>
            @endif
        </h1>
        
        <p class="text-xl {{ $theme['text_color'] ?? 'text-gray-600' }} mb-8 max-w-2xl mx-auto" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">
            {{ $heroSubtitle }}
        </p>
        
        <div class="flex gap-4 justify-center">
            <a href="{{ route('products.index') }}" class="bg-amber-700 text-white px-8 py-4 rounded-lg hover:bg-amber-800 transition text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                Lihat Koleksi
            </a>
            <a href="{{ route('contact') }}" class="border-2 {{ isset($theme['text_color']) ? 'border-white text-white hover:bg-white hover:text-gray-900' : 'border-amber-700 text-amber-700 hover:bg-amber-50' }} px-8 py-4 rounded-lg transition text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                Konsultasi Gratis
            </a>
        </div>

        @if($currentTheme !== 'default')
            <div class="mt-8 inline-block bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-6 py-3 {{ $theme['text_color'] ?? 'text-gray-900' }}">
                <span class="text-lg font-semibold">
                    🎉 Promo Spesial {{ ucwords(str_replace('-', ' ', $currentTheme)) }}!
                </span>
            </div>
        @endif
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <i class="fas fa-chevron-down text-3xl {{ $theme['text_color'] ?? 'text-gray-400' }} opacity-50"></i>
    </div>
</section>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        animation: fade-in 1s ease-out;
    }
</style>

<!-- Featured Products -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Produk Unggulan</h2>
            <p class="text-gray-600">Koleksi furniture premium pilihan kami</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($featuredProducts as $product)
                <div class="group">
                    <div class="relative overflow-hidden rounded-lg mb-4 aspect-square">
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @if($product->is_featured)
                            <span class="absolute top-4 right-4 bg-amber-700 text-white px-3 py-1 rounded-full text-sm">
                                Featured
                            </span>
                        @endif
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3">{{ $product->category }}</p>
                    <a href="{{ route('products.show', $product->slug) }}" 
                       class="text-amber-700 hover:text-amber-800 font-medium">
                        Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500">Belum ada produk unggulan</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}" class="inline-block border-2 border-gray-900 text-gray-900 px-8 py-3 rounded-lg hover:bg-gray-900 hover:text-white transition">
                Lihat Semua Produk
            </a>
        </div>
    </div>
</section>

<!-- Testimonials -->
@if($testimonials->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Testimoni Klien</h2>
            <p class="text-gray-600">Apa kata mereka tentang kami</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <div class="bg-white p-8 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6">"{{ $testimonial->content }}"</p>
                    <div class="flex items-center">
                        @if($testimonial->avatar)
                            <img src="{{ asset('storage/' . $testimonial->avatar) }}" 
                                 alt="{{ $testimonial->client_name }}"
                                 class="w-12 h-12 rounded-full mr-4 object-cover">
                        @else
                            <div class="w-12 h-12 rounded-full bg-amber-700 text-white flex items-center justify-center mr-4">
                                {{ substr($testimonial->client_name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <p class="font-semibold">{{ $testimonial->client_name }}</p>
                            @if($testimonial->client_company)
                                <p class="text-sm text-gray-600">{{ $testimonial->client_company }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest Articles -->
@if($latestArticles->count() > 0)
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Artikel Terbaru</h2>
            <p class="text-gray-600">Tips dan inspirasi seputar furniture & interior</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestArticles as $article)
                <article class="group">
                    <div class="relative overflow-hidden rounded-lg mb-4 aspect-video">
                        <img src="{{ asset('storage/' . $article->featured_image) }}" 
                             alt="{{ $article->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <p class="text-sm text-gray-500 mb-2">{{ $article->published_at->format('d M Y') }}</p>
                    <h3 class="text-xl font-semibold mb-2 group-hover:text-amber-700 transition">
                        <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                    </h3>
                    <p class="text-gray-600 mb-3">{{ Str::limit($article->excerpt, 100) }}</p>
                    <a href="{{ route('articles.show', $article->slug) }}" 
                       class="text-amber-700 hover:text-amber-800 font-medium">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-20 bg-amber-700 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-4">Siap Wujudkan Hunian Impian?</h2>
        <p class="text-xl mb-8 opacity-90">Konsultasikan kebutuhan furniture Anda dengan tim kami</p>
        <a href="https://wa.me/6281234567890" target="_blank" 
           class="inline-block bg-white text-amber-700 px-8 py-4 rounded-lg hover:bg-gray-100 transition text-lg font-semibold">
            <i class="fab fa-whatsapp mr-2"></i>Hubungi Kami via WhatsApp
        </a>
    </div>
</section>

@endsection
