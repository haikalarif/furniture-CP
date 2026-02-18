@extends('layouts.frontend')

@section('title', 'KalKayu Living - Premium Furniture & Interior')
@section('body-class', 'home-page')

@section('content')

{{-- Debug Info --}}
@if(config('app.debug'))
<div class="position-fixed bottom-0 end-0 m-3 p-3 bg-dark bg-opacity-75 text-white rounded shadow-lg" style="z-index: 9999; max-width: 400px; font-size: 0.75rem;">
    <div class="fw-bold mb-2 text-warning">🔍 Hero Debug Info:</div>
    <div class="small">
        <div><span class="text-secondary">Theme:</span> <span class="text-success">{{ $homePage->hero_theme ?? 'NULL' }}</span></div>
        <div><span class="text-secondary">Title:</span> {{ Str::limit($homePage->hero_title ?? 'NULL', 30) }}</div>
        <div><span class="text-secondary">Background:</span> <span class="text-info">{{ $homePage->hero_background ?? 'NULL' }}</span></div>
        @if($homePage && $homePage->hero_background)
            <div><span class="text-secondary">Full URL:</span> <span class="text-primary small">{{ asset('storage/' . $homePage->hero_background) }}</span></div>
            <div><span class="text-secondary">File Exists:</span> 
                <span class="{{ file_exists(public_path('storage/' . $homePage->hero_background)) ? 'text-success' : 'text-danger' }}">
                    {{ file_exists(public_path('storage/' . $homePage->hero_background)) ? '✓ YES' : '✗ NO' }}
                </span>
            </div>
        @endif
    </div>
</div>
@endif

@php
    // Get hero theme colors and decorations
    $themeConfig = [
        'default' => [
            'bg_class' => 'bg-gradient',
            'bg_style' => 'background: linear-gradient(135deg, #fef3c7 0%, #e7e5e4 100%);',
            'text_class' => 'text-dark',
            'accent_class' => 'text-primary',
            'decoration' => '',
        ],
        'ramadan' => [
            'bg_class' => 'bg-gradient',
            'bg_style' => 'background: linear-gradient(135deg, #581c87 0%, #1e3a8a 100%);',
            'text_class' => 'text-white',
            'accent_class' => 'text-warning',
            'decoration' => '🌙✨',
        ],
        'idul-fitri' => [
            'bg_class' => 'bg-gradient',
            'bg_style' => 'background: linear-gradient(135deg, #059669 0%, #14b8a6 100%);',
            'text_class' => 'text-white',
            'accent_class' => 'text-warning',
            'decoration' => '✨🎉',
        ],
        'idul-adha' => [
            'bg_class' => 'bg-gradient',
            'bg_style' => 'background: linear-gradient(135deg, #15803d 0%, #059669 100%);',
            'text_class' => 'text-white',
            'accent_class' => 'text-warning',
            'decoration' => '🐑🕌',
        ],
        'natal' => [
            'bg_class' => 'bg-gradient',
            'bg_style' => 'background: linear-gradient(135deg, #b91c1c 0%, #15803d 50%, #b91c1c 100%);',
            'text_class' => 'text-white',
            'accent_class' => 'text-warning',
            'decoration' => '🎄⛄',
        ],
        'tahun-baru' => [
            'bg_class' => 'bg-gradient',
            'bg_style' => 'background: linear-gradient(135deg, #1e3a8a 0%, #7e22ce 50%, #be185d 100%);',
            'text_class' => 'text-white',
            'accent_class' => 'text-warning',
            'decoration' => '🎆🎊',
        ],
        'imlek' => [
            'bg_class' => 'bg-gradient',
            'bg_style' => 'background: linear-gradient(135deg, #dc2626 0%, #eab308 100%);',
            'text_class' => 'text-white',
            'accent_class' => 'text-warning',
            'decoration' => '🧧🐉',
        ],
        'kemerdekaan' => [
            'bg_class' => 'bg-gradient',
            'bg_style' => 'background: linear-gradient(135deg, #dc2626 0%, #ffffff 50%, #dc2626 100%);',
            'text_class' => 'text-dark',
            'accent_class' => 'text-danger',
            'decoration' => '🇮🇩🎌',
        ],
    ];

    $currentTheme = $homePage->hero_theme ?? 'default';
    $theme = $themeConfig[$currentTheme] ?? $themeConfig['default'];
    
    $heroTitle = $homePage->hero_title ?? 'Furniture Premium untuk Hunian Impian';
    $heroSubtitle = $homePage->hero_subtitle ?? 'Desain custom minimalis dengan material berkualitas tinggi, dibuat khusus untuk Anda';
@endphp

<!-- Hero Section -->
<section class="position-relative overflow-hidden" style="min-height: 100vh; display: flex; align-items: center;">
    <!-- Background Layer -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="z-index: 0;">
        @if($homePage && $homePage->hero_background)
            <!-- Custom Background Image -->
            <img src="{{ asset('storage/' . $homePage->hero_background) }}" 
                 alt="Hero Background"
                 class="w-100 h-100 object-fit-cover">
            <!-- Overlay Gradient -->
            <div class="position-absolute top-0 start-0 w-100 h-100" style="{{ $theme['bg_style'] }} opacity: 0.6;"></div>
        @else
            <!-- Default Gradient Background -->
            <div class="position-absolute top-0 start-0 w-100 h-100" style="{{ $theme['bg_style'] }}"></div>
        @endif
    </div>

    <!-- Decorative Elements -->
    @if(!empty($theme['decoration']))
        <div class="position-absolute top-0 start-0 m-4 opacity-25 animate__animated animate__pulse animate__infinite" style="font-size: 4rem; z-index: 1;">
            {{ Str::substr($theme['decoration'], 0, 2) }}
        </div>
        <div class="position-absolute bottom-0 end-0 m-4 opacity-25 animate__animated animate__pulse animate__infinite" style="font-size: 4rem; z-index: 1; animation-delay: 1s;">
            {{ Str::substr($theme['decoration'], 2) }}
        </div>
    @endif

    <div class="container text-center position-relative" style="z-index: 10;">
        @if(!empty($theme['decoration']))
            <div class="display-3 mb-4 animate__animated animate__bounce animate__infinite">
                {{ $theme['decoration'] }}
            </div>
        @endif

        <h1 class="display-3 fw-bold {{ $theme['text_class'] }} mb-4" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.5); animation: fadeIn 1s;">
            {{ $heroTitle }}
            @if($currentTheme !== 'default')
                <br><span class="{{ $theme['accent_class'] }}">{{ ucwords(str_replace('-', ' ', $currentTheme)) }}</span>
            @else
                <br><span class="{{ $theme['accent_class'] }}"></span>
            @endif
        </h1>
        
        <p class="fs-5 {{ $theme['accent_class'] }} mb-5 mx-auto" style="max-width: 700px; text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">
            {{ $heroSubtitle }}
        </p>
        
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('products.index') }}" class="btn btn-dark btn-md shadow-lg">
                Lihat Koleksi
            </a>
            <a href="{{ route('contact') }}" class="btn {{ isset($theme['text_class']) && $theme['text_class'] == 'text-white' ? 'btn-outline-light' : 'btn-outline-dark' }} btn-md shadow-lg">
                Konsultasi Gratis
            </a>
        </div>

        @if($currentTheme !== 'default')
            <div class="mt-4">
                <span class="badge bg-white bg-opacity-25 text-white fs-6 py-2 px-4 rounded-pill">
                    🎉 Promo Spesial {{ ucwords(str_replace('-', ' ', $currentTheme)) }}!
                </span>
            </div>
        @endif
    </div>

    <!-- Scroll Indicator -->
    <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4 animate__animated animate__bounce animate__infinite">
        <i class="fas fa-chevron-down fs-2 {{ $theme['text_class'] }} opacity-50"></i>
    </div>
</section>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- Featured Products -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3 uppercase">Produk Unggulan</h2>
            <p class="text-secondary">Koleksi furniture premium pilihan kami</p>
        </div>
        
        <div class="row g-4">
            @forelse($featuredProducts as $product)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="position-relative overflow-hidden rounded-3" style="padding-top: 70%;">
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}"
                                 class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
                                 style="transition: transform 0.5s;">
                            @if($product->is_featured)
                                <span class="position-absolute top-0 end-0 m-3 badge bg-primary">
                                    Featured
                                </span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-semibold">{{ $product->name }}</h5>
                            <p class="card-text text-secondary small">{{ $product->category }}</p>
                            <a href="{{ route('products.show', $product->slug) }}" class=" btn btn-dark btn-sm">
                                Detail<i class="fas fa-search ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-secondary">Belum ada produk unggulan</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-outline-dark btn-md">
                Lihat Semua
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us / Keunggulan Kami -->
@if($features->count() > 0)
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3 uppercase">Mengapa Memilih Kami?</h2>
            <p class="text-secondary">Keunggulan yang membuat kami berbeda</p>
        </div>
        
        <div class="row g-4">
            @foreach($features as $feature)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <div class="mb-4">
                                @if($feature->icon)
                                    <i class="{{ $feature->icon }} fa-3x text-primary"></i>
                                @else
                                    <i class="fas fa-star fa-3x text-primary"></i>
                                @endif
                            </div>
                            <h5 class="card-title fw-bold mb-3">{{ $feature->title }}</h5>
                            <p class="card-text text-secondary">{{ $feature->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Promo Products -->
@if($promoProducts->count() > 0)
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3 uppercase">Produk Promo</h2>
            <p class="text-secondary">Penawaran spesial dengan harga terbaik</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            @foreach($promoProducts as $product)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="position-relative overflow-hidden rounded-3" style="padding-top: 70%;">
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}"
                                 class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
                                 style="transition: transform 0.5s;">
                            
                            @if($product->discount_percentage)
                                <span class="position-absolute top-0 start-0 m-3 badge bg-danger fs-6 rounded-circle" style="padding: 15px 4px;">
                                    {{ $product->discount_percentage }}%
                                </span>
                            @endif
                            
                            <span class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark">
                                PROMO
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-semibold">{{ $product->name }}</h5>
                            <p class="card-text text-secondary small mb-2">{{ $product->category }}</p>
                            
                            @if($product->price && $product->promo_price)
                                <div class="mb-3">
                                    <span class="text-decoration-line-through text-muted me-2">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-danger fw-bold fs-5">
                                        Rp {{ number_format($product->promo_price, 0, ',', '.') }}
                                    </span>
                                    <div class="small text-success">
                                        Hemat Rp {{ number_format($product->getDiscountAmount(), 0, ',', '.') }}
                                    </div>
                                </div>
                            @endif
                            
                            @if($product->promo_end_date)
                                <div class="alert alert-warning py-2 px-3 mb-3 small">
                                    <i class="fas fa-clock me-1"></i>
                                    Berakhir: {{ $product->promo_end_date->format('d M Y') }}
                                </div>
                            @endif
                            
                            <div class="d-grid gap-2 d-flex">
                                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary btn-md flex-fill">
                                    <i class="fas fa-search me-2"></i>Lihat Detail
                                </a>
                                <a href="https://wa.me/6281234567890?text=Halo, saya tertarik dengan {{ $product->name }}" target="_blank" class="btn btn-success btn-md flex-fill">
                                    <i class="fab fa-whatsapp me-2"></i>Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('products.index') }}" class="btn btn-outline-dark btn-md">
                Lihat Semua
            </a>
        </div>
    </div>
</section>
@endif

<!-- Testimonials -->
@if($testimonials->count() > 0)
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3 uppercase">Testimoni</h2>
            <p class="text-secondary">Apa kata mereka tentang kami</p>
        </div>
        
        <div class="row g-4">
            @foreach($testimonials as $testimonial)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                @endfor
                            </div>
                            <p class="card-text mb-4">"{{ $testimonial->content }}"</p>
                            <div class="d-flex align-items-center">
                                @if($testimonial->avatar)
                                    <img src="{{ asset('storage/' . $testimonial->avatar) }}" 
                                         alt="{{ $testimonial->client_name }}"
                                         class="rounded-circle me-3"
                                         style="width: 48px; height: 48px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
                                         style="width: 48px; height: 48px;">
                                        {{ substr($testimonial->client_name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-semibold">{{ $testimonial->client_name }}</div>
                                    @if($testimonial->client_company)
                                        <small class="text-secondary">{{ $testimonial->client_company }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Latest Articles - Hidden for now --}}
{{-- @if($latestArticles->count() > 0)
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h1 class="fw-bold mb-3">Artikel Terbaru</h1>
            <p class="text-secondary">Tips dan inspirasi seputar furniture & interior</p>
        </div>
        
        <div class="row g-4">
            @foreach($latestArticles as $article)
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="card h-100 border-0 shadow-sm">
                        <div class="position-relative overflow-hidden" style="padding-top: 56.25%;">
                            <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                 alt="{{ $article->title }}"
                                 class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover">
                        </div>
                        <div class="card-body">
                            <p class="small text-secondary mb-2">{{ $article->published_at->format('d M Y') }}</p>
                            <h5 class="card-title fw-semibold">
                                <a href="{{ route('articles.show', $article->slug) }}" class="text-dark text-decoration-none">
                                    {{ $article->title }}
                                </a>
                            </h5>
                            <p class="card-text text-secondary">{{ Str::limit($article->excerpt, 100) }}</p>
                            <a href="{{ route('articles.show', $article->slug) }}" class="text-primary text-decoration-none fw-medium">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif --}}

<!-- Gallery -->
@if($galleries->count() > 0)
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3 uppercase">Galeri</h2>
            <p class="text-secondary">Inspirasi desain interior & exterior dengan furniture mewah dan modern</p>
        </div>
        
        <div class="row g-3 justify-content-center">
            @foreach($galleries as $gallery)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="gallery-item position-relative overflow-hidden rounded shadow-sm" style="height: 250px; cursor: pointer;">
                        <img src="{{ asset('storage/' . $gallery->image) }}" 
                             alt="{{ $gallery->title }}"
                             class="w-100 h-100 object-fit-cover gallery-image"
                             data-bs-toggle="modal" 
                             data-bs-target="#galleryModal{{ $gallery->id }}">
                        
                        <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end p-3"
                             style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); opacity: 0; transition: opacity 0.3s;">
                            <div class="text-white">
                                <div class="fw-bold">{{ $gallery->title }}</div>
                                @if($gallery->category)
                                    <small class="badge bg-primary">{{ ucfirst($gallery->category) }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="galleryModal{{ $gallery->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $gallery->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body p-0">
                                <img src="{{ asset('storage/' . $gallery->image) }}" 
                                     alt="{{ $gallery->title }}"
                                     class="w-100">
                            </div>
                            @if($gallery->description)
                                <div class="modal-footer">
                                    <p class="mb-0 text-muted">{{ $gallery->description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('gallery.index') }}" class="btn btn-outline-dark btn-md">
                Lihat Semua
            </a>
        </div>
    </div>
</section>

<style>
.gallery-item:hover .gallery-overlay {
    opacity: 1 !important;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.1);
    transition: transform 0.3s;
}
</style>
@endif

<!-- CTA Section -->
<section class="py-5 bg-cream text-dark">
    <div class="container py-4 text-center">
        <h2 class="fw-bold mb-3">Siap Wujudkan Hunian Impian?</h2>
        <p class="fs-6 mb-4 opacity-75">Konsultasikan kebutuhan furniture Anda dengan tim kami</p>
        <a href="https://wa.me/6281234567890" target="_blank" 
           class="btn btn-dark btn-md fw-semibold">
            <i class="fab fa-whatsapp me-2"></i>Hubungi Kami
        </a>
    </div>
</section>

@endsection