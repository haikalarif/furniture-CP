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
            <div><span class="text-secondary">Full URL:</span> <span class="text-primary small">{{ Storage::url($homePage->hero_background) }}</span></div>
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
    /*
    |--------------------------------------------------------------------------
    | Hero Theme Config — Aturan 60-30-10
    | 60% = warna netral (bg utama)
    | 30% = warna tema (elemen sekunder, overlay, dekorasi)
    | 10% = warna aksen/kontras (tombol CTA, highlight)
    |--------------------------------------------------------------------------
    */
    $themeConfig = [

        // ── DEFAULT (Modern Minimalist) ──────────────────────────────────────
        'default' => [
            'bg_style'        => 'background: linear-gradient(135deg, #fdfbf9 0%, #f3ece4 100%);',
            'text_color'      => '#2d2416',
            'subtitle_color'  => '#5d503d',
            'badge_bg'        => 'rgba(45, 36, 22, 0.08)',
            'badge_color'     => '#2d2416',
            'btn_primary'     => 'background:#2d2416; color:#ffffff; border:none;',
            'btn_secondary'   => 'background:transparent; color:#2d2416; border:2px solid #2d2416;',
            'scroll_color'    => '#2d2416',
            'deco_shapes'     => [],
            'decoration'      => '',
            'promo_label'     => '',
        ],

        // ── RAMADAN ──────────────────────────────────────────────────────────
        // 60% Ivory (#fcfaf5) · 30% Sage Green (#5d7a5f) · 10% Warm Gold (#d4af37)
        'ramadan' => [
            'bg_style'        => 'background: linear-gradient(160deg, #fcfaf5 0%, #f0f5f0 100%);',
            'text_color'      => '#1e2b1f',
            'subtitle_color'  => '#3e523f',
            'badge_bg'        => 'rgba(93, 122, 95, 0.12)',
            'badge_color'     => '#5d7a5f',
            'btn_primary'     => 'background:#d4af37; color:#ffffff; border:none; box-shadow: 0 4px 14px rgba(212,175,55,0.4);',
            'btn_secondary'   => 'background:transparent; color:#5d7a5f; border:2px solid #5d7a5f;',
            'scroll_color'    => '#5d7a5f',
            'deco_shapes'     => [
                ['type'=>'crescent', 'pos'=>'top:5%; right:6%;',   'color'=>'#d4af37', 'opacity'=>'0.15', 'size'=>'180px'],
                ['type'=>'lantern',  'pos'=>'top:8%; left:5%;',    'color'=>'#d4af37', 'opacity'=>'0.12', 'size'=>'90px'],
                ['type'=>'star4',    'pos'=>'top:18%; right:14%;', 'color'=>'#d4af37', 'opacity'=>'0.2', 'size'=>'28px'],
                ['type'=>'pattern-islamic', 'pos'=>'top:0; left:0; width:100%; height:100%;', 'color'=>'#d4af37', 'opacity'=>'0.03', 'size'=>'100%'],
            ],
            'decoration'      => '🌙',
            'promo_label'     => 'Berkah Ramadan: Furniture Impian',
        ],

        // ── IDUL FITRI ───────────────────────────────────────────────────────
        'idul-fitri' => [
            'bg_style'        => 'background: linear-gradient(160deg, #ffffff 0%, #f4f9f4 100%);',
            'text_color'      => '#1a2e1c',
            'subtitle_color'  => '#4a6741',
            'badge_bg'        => 'rgba(74, 103, 65, 0.1)',
            'badge_color'     => '#4a6741',
            'btn_primary'     => 'background:#5d7a5f; color:#ffffff; border:none;',
            'btn_secondary'   => 'background:transparent; color:#5d7a5f; border:2px solid #5d7a5f;',
            'scroll_color'    => '#5d7a5f',
            'deco_shapes'     => [
                ['type'=>'ketupat', 'pos'=>'top:8%; right:8%;',    'color'=>'#5d7a5f', 'opacity'=>'0.15', 'size'=>'140px'],
                ['type'=>'ketupat', 'pos'=>'bottom:10%; left:5%;', 'color'=>'#d4af37', 'opacity'=>'0.12', 'size'=>'100px'],
            ],
            'decoration'      => '🕌',
            'promo_label'     => 'Kemenangan Fitri: Diskon Hingga 50%',
        ],

        // ── IDUL ADHA ────────────────────────────────────────────────────────
        'idul-adha' => [
            'bg_style'        => 'background: linear-gradient(160deg, #f9f6f1 0%, #f0ede4 100%);',
            'text_color'      => '#3c2f1d',
            'subtitle_color'  => '#5d4d37',
            'badge_bg'        => 'rgba(107, 124, 63, 0.1)',
            'badge_color'     => '#6b7c3f',
            'btn_primary'     => 'background:#6b7c3f; color:#ffffff; border:none;',
            'btn_secondary'   => 'background:transparent; color:#6b7c3f; border:2px solid #6b7c3f;',
            'scroll_color'    => '#6b7c3f',
            'deco_shapes'     => [
                ['type'=>'arch',  'pos'=>'top:0; right:0;', 'color'=>'#6b7c3f', 'opacity'=>'0.05', 'size'=>'320px'],
            ],
            'decoration'      => '🐏',
            'promo_label'     => 'Qurban Sale: Berbagi Kebahagiaan',
        ],

        // ── NATAL ────────────────────────────────────────────────────────────
        'natal' => [
            'bg_style'        => 'background: linear-gradient(160deg, #ffffff 0%, #f8faf8 100%);',
            'text_color'      => '#132a17',
            'subtitle_color'  => '#1e4d2b',
            'badge_bg'        => 'rgba(184, 28, 47, 0.1)',
            'badge_color'     => '#b81c2f',
            'btn_primary'     => 'background:#b81c2f; color:#ffffff; border:none;',
            'btn_secondary'   => 'background:transparent; color:#b81c2f; border:2px solid #b81c2f;',
            'scroll_color'    => '#1e4d2b',
            'deco_shapes'     => [
                ['type'=>'tree',      'pos'=>'top:0; right:5%;', 'color'=>'#1e4d2b', 'opacity'=>'0.08', 'size'=>'200px'],
                ['type'=>'snowflake', 'pos'=>'top:15%; left:10%;', 'color'=>'#b81c2f', 'opacity'=>'0.1', 'size'=>'30px'],
                ['type'=>'pine-branch', 'pos'=>'top:-20px; left:-20px;', 'color'=>'#1e4d2b', 'opacity'=>'0.15', 'size'=>'250px'],
            ],
            'decoration'      => '🎄',
            'promo_label'     => 'Kado Natal Untuk Rumah Anda',
        ],

        // ── TAHUN BARU ───────────────────────────────────────────────────────
        'tahun-baru' => [
            'bg_style'        => 'background: radial-gradient(circle at top right, #1a1a2e 0%, #0d0d14 100%);',
            'text_color'      => '#ffffff',
            'subtitle_color'  => '#aeb9cc',
            'badge_bg'        => 'rgba(255, 255, 255, 0.1)',
            'badge_color'     => '#c0c8d8',
            'btn_primary'     => 'background:#c0c8d8; color:#0d0d14; border:none; font-weight:bold;',
            'btn_secondary'   => 'background:transparent; color:#ffffff; border:1px solid rgba(255,255,255,0.4);',
            'scroll_color'    => '#ffffff',
            'deco_shapes'     => [
                ['type'=>'sparkle', 'pos'=>'top:10%; right:10%;', 'color'=>'#ffffff', 'opacity'=>'0.3', 'size'=>'60px'],
                ['type'=>'sparkle', 'pos'=>'bottom:20%; left:10%;', 'color'=>'#c0c8d8', 'opacity'=>'0.2', 'size'=>'40px'],
            ],
            'decoration'      => '🎆',
            'promo_label'     => 'Tahun Baru, Suasana Baru!',
        ],

        // ── IMLEK ────────────────────────────────────────────────────────────
        'imlek' => [
            'bg_style'        => 'background: linear-gradient(160deg, #2a1a0e 0%, #1a0f08 100%);',
            'text_color'      => '#fdf3e3',
            'subtitle_color'  => '#d4a017',
            'badge_bg'        => 'rgba(196, 30, 30, 0.2)',
            'badge_color'     => '#fdf3e3',
            'btn_primary'     => 'background:#c41e1e; color:#ffffff; border:none;',
            'btn_secondary'   => 'background:transparent; color:#fdf3e3; border:2px solid #c41e1e;',
            'scroll_color'    => '#d4a017',
            'deco_shapes'     => [
                ['type'=>'lantern', 'pos'=>'top:0; right:10%;', 'color'=>'#c41e1e', 'opacity'=>'0.4', 'size'=>'120px'],
                ['type'=>'cloud',   'pos'=>'bottom:0; left:0;', 'color'=>'#c41e1e', 'opacity'=>'0.1', 'size'=>'300px'],
                ['type'=>'corner-oriental', 'pos'=>'top:20px; left:20px;', 'color'=>'#d4a017', 'opacity'=>'0.4', 'size'=>'80px'],
            ],
            'decoration'      => '🧧',
            'promo_label'     => 'Hoki Melimpah: Angpao Furniture',
        ],

        // ── KEMERDEKAAN ───────────────────────────────────────────────────────
        'kemerdekaan' => [
            'bg_style'        => 'background: linear-gradient(160deg, #ffffff 0%, #fcfcfc 100%);',
            'text_color'      => '#000000',
            'subtitle_color'  => '#444444',
            'badge_bg'        => 'rgba(204, 0, 1, 0.08)',
            'badge_color'     => '#cc0001',
            'btn_primary'     => 'background:#cc0001; color:#ffffff; border:none;',
            'btn_secondary'   => 'background:transparent; color:#cc0001; border:2px solid #cc0001;',
            'scroll_color'    => '#cc0001',
            'deco_shapes'     => [
                ['type'=>'ribbon', 'pos'=>'top:0; width:100%;', 'color'=>'#cc0001', 'opacity'=>'0.1', 'size'=>'40px'],
                ['type'=>'star5',  'pos'=>'bottom:15%; right:10%;', 'color'=>'#cc0001', 'opacity'=>'0.15', 'size'=>'60px'],
            ],
            'decoration'      => '🇮🇩',
            'promo_label'     => 'Merdeka Sale: Bangga Buatan Indonesia',
        ],
    ];

    $currentTheme = $homePage->hero_theme ?? 'default';
    $theme = $themeConfig[$currentTheme] ?? $themeConfig['default'];

    $heroTitle    = $homePage->hero_title    ?? 'Furniture Premium untuk Hunian Impian';
    $heroSubtitle = $homePage->hero_subtitle ?? 'Desain custom minimalis dengan material berkualitas tinggi, dibuat khusus untuk Anda';
@endphp

<!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden" style="min-height: 100vh; display: flex; align-items: center; {{ $theme['bg_style'] }}">

    {{-- Background image (jika ada) --}}
    @if($homePage && $homePage->hero_background)
        <div class="position-absolute top-0 start-0 w-100 h-100" style="z-index:0;">
            <img src="{{ Storage::url($homePage->hero_background) }}"
                 alt="Hero Background"
                 class="w-100 h-100 object-fit-cover">
            <div class="position-absolute top-0 start-0 w-100 h-100"
                 style="{{ $theme['bg_style'] }} opacity:0.75;"></div>
        </div>
    @endif

    {{-- SVG / CSS Decorative Shapes --}}
    @if(!empty($theme['deco_shapes']))
        @foreach($theme['deco_shapes'] as $shape)
            <div class="hero-deco position-absolute" style="z-index:1; {{ $shape['pos'] }}; width:{{ $shape['size'] }}; height:{{ $shape['size'] }}; opacity:{{ $shape['opacity'] }}; pointer-events:none;">
                @if($shape['type'] === 'crescent')
                    {{-- Bulan sabit --}}
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <path d="M70,50 A30,30 0 1,1 70,50.01 A20,20 0 1,0 70,50Z" fill="{{ $shape['color'] }}"/>
                    </svg>
                @elseif($shape['type'] === 'star4')
                    {{-- Bintang 4 sudut --}}
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <polygon points="50,5 61,39 95,50 61,61 50,95 39,61 5,50 39,39" fill="{{ $shape['color'] }}"/>
                    </svg>
                @elseif($shape['type'] === 'star5')
                    {{-- Bintang 5 sudut --}}
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <polygon points="50,5 61,35 95,35 68,57 79,91 50,70 21,91 32,57 5,35 39,35" fill="{{ $shape['color'] }}"/>
                    </svg>
                @elseif($shape['type'] === 'ketupat')
                    {{-- Ketupat / diamond --}}
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <polygon points="50,5 95,50 50,95 5,50" fill="none" stroke="{{ $shape['color'] }}" stroke-width="4"/>
                        <polygon points="50,18 82,50 50,82 18,50" fill="none" stroke="{{ $shape['color'] }}" stroke-width="2.5"/>
                    </svg>
                @elseif($shape['type'] === 'lantern')
                    {{-- Lampion --}}
                    <svg viewBox="0 0 60 100" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <rect x="25" y="0" width="10" height="12" rx="2" fill="{{ $shape['color'] }}"/>
                        <ellipse cx="30" cy="55" rx="22" ry="38" fill="{{ $shape['color'] }}"/>
                        <line x1="30" y1="93" x2="30" y2="100" stroke="{{ $shape['color'] }}" stroke-width="2"/>
                        <line x1="8" y1="40" x2="52" y2="40" stroke="rgba(255,255,255,0.3)" stroke-width="1.5"/>
                        <line x1="8" y1="55" x2="52" y2="55" stroke="rgba(255,255,255,0.3)" stroke-width="1.5"/>
                        <line x1="8" y1="70" x2="52" y2="70" stroke="rgba(255,255,255,0.3)" stroke-width="1.5"/>
                    </svg>
                @elseif($shape['type'] === 'tree')
                    {{-- Pohon natal --}}
                    <svg viewBox="0 0 100 140" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <polygon points="50,5 90,60 70,60 85,95 60,95 60,135 40,135 40,95 15,95 30,60 10,60" fill="{{ $shape['color'] }}"/>
                    </svg>
                @elseif($shape['type'] === 'snowflake')
                    {{-- Kepingan salju --}}
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <line x1="50" y1="5"  x2="50" y2="95" stroke="{{ $shape['color'] }}" stroke-width="6" stroke-linecap="round"/>
                        <line x1="5"  y1="50" x2="95" y2="50" stroke="{{ $shape['color'] }}" stroke-width="6" stroke-linecap="round"/>
                        <line x1="18" y1="18" x2="82" y2="82" stroke="{{ $shape['color'] }}" stroke-width="6" stroke-linecap="round"/>
                        <line x1="82" y1="18" x2="18" y2="82" stroke="{{ $shape['color'] }}" stroke-width="6" stroke-linecap="round"/>
                        <circle cx="50" cy="5"  r="5" fill="{{ $shape['color'] }}"/>
                        <circle cx="50" cy="95" r="5" fill="{{ $shape['color'] }}"/>
                        <circle cx="5"  cy="50" r="5" fill="{{ $shape['color'] }}"/>
                        <circle cx="95" cy="50" r="5" fill="{{ $shape['color'] }}"/>
                    </svg>
                @elseif($shape['type'] === 'sparkle')
                    {{-- Bintang kilau tahun baru --}}
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <polygon points="50,2 56,44 98,50 56,56 50,98 44,56 2,50 44,44" fill="{{ $shape['color'] }}"/>
                        <polygon points="50,20 53,47 80,50 53,53 50,80 47,53 20,50 47,47" fill="{{ $shape['color'] }}" opacity="0.5"/>
                    </svg>
                @elseif($shape['type'] === 'cloud')
                    {{-- Awan dekoratif imlek --}}
                    <svg viewBox="0 0 200 120" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <path d="M20,80 Q0,80 0,60 Q0,40 20,40 Q25,20 50,20 Q70,5 90,20 Q110,5 130,20 Q155,15 165,35 Q185,35 190,55 Q200,75 180,80 Z" fill="{{ $shape['color'] }}"/>
                    </svg>
                @elseif($shape['type'] === 'arch')
                    {{-- Lengkungan dekoratif --}}
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <path d="M0,200 Q0,0 200,0 L200,30 Q30,30 30,200 Z" fill="{{ $shape['color'] }}"/>
                    </svg>
                @elseif($shape['type'] === 'ribbon')
                    {{-- Pita merah putih kemerdekaan --}}
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <path d="M0,0 L200,0 L200,40 L0,40 Z" fill="{{ $shape['color'] }}"/>
                        <path d="M0,40 L200,40 L200,80 L0,80 Z" fill="rgba(255,255,255,0.6)"/>
                    </svg>
                @elseif($shape['type'] === 'pattern-islamic')
                    {{-- Pattern Geometris Islami untuk Background --}}
                    <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="islamicPattern" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse">
                                <path d="M50 0 L100 50 L50 100 L0 50 Z" fill="none" stroke="{{ $shape['color'] }}" stroke-width="0.5"/>
                                <circle cx="50" cy="50" r="10" fill="none" stroke="{{ $shape['color'] }}" stroke-width="0.5"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#islamicPattern)" />
                    </svg>
                @elseif($shape['type'] === 'corner-oriental')
                    {{-- Sudut Khas Imlek --}}
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10,40 L10,10 L40,10 M20,10 L20,20 L10,20" fill="none" stroke="{{ $shape['color'] }}" stroke-width="4"/>
                    </svg>
                @elseif($shape['type'] === 'pine-branch')
                    {{-- Ornamen Ranting Pinus Natal --}}
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10,10 Q50,20 90,10 M30,15 L25,30 M50,18 L50,35 M70,15 L75,30" stroke="{{ $shape['color'] }}" stroke-width="2" fill="none" stroke-linecap="round"/>
                    </svg>
                @endif
            </div>
        @endforeach
    @endif

    {{-- Content --}}
    <div class="container text-center position-relative" style="z-index:10;">

        @if(!empty($theme['decoration']))
            <div class="mb-3" style="font-size:2.5rem; line-height:1;">{{ $theme['decoration'] }}</div>
        @endif

        <h1 class="display-3 fw-bold mb-4"
            style="color:{{ $theme['text_color'] }}; text-shadow:0 2px 12px rgba(0,0,0,0.12); animation:heroFadeUp 0.8s ease both;">
            {{ $heroTitle }}
        </h1>

        <p class="fs-5 mb-5 mx-auto"
           style="max-width:680px; color:{{ $theme['subtitle_color'] }}; animation:heroFadeUp 0.8s 0.15s ease both; opacity:0;">
            {{ $heroSubtitle }}
        </p>

        <div class="d-flex gap-3 justify-content-center flex-wrap"
             style="animation:heroFadeUp 0.8s 0.3s ease both; opacity:0;">
            <a href="{{ route('products.index') }}"
               class="btn btn-md px-4 py-2 rounded-pill shadow"
               style="{{ $theme['btn_primary'] }}">
                Lihat Koleksi
            </a>
            <a href="{{ route('contact') }}"
               class="btn btn-md px-4 py-2 rounded-pill"
               style="{{ $theme['btn_secondary'] }}">
                Konsultasi Gratis
            </a>
        </div>

        @if($currentTheme !== 'default' && !empty($theme['promo_label']))
            <div class="mt-4" style="animation:heroFadeUp 0.8s 0.45s ease both; opacity:0;">
                <span class="badge fs-6 py-2 px-4 rounded-pill"
                      style="background:{{ $theme['badge_bg'] }}; color:{{ $theme['badge_color'] }}; border:1px solid {{ $theme['badge_color'] }}40;">
                    🎉 {{ $theme['promo_label'] }}
                </span>
            </div>
        @endif
    </div>

    {{-- Scroll indicator --}}
    <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4" style="z-index:10;">
        <div class="hero-scroll-dot" style="color:{{ $theme['scroll_color'] }};">
            <i class="fas fa-chevron-down fs-4 opacity-50"></i>
        </div>
    </div>
</section>

<style>
@keyframes heroFadeUp {
    from { opacity:0; transform:translateY(24px); }
    to   { opacity:1; transform:translateY(0); }
}
.hero-scroll-dot {
    animation: heroBounce 1.6s ease-in-out infinite;
}
@keyframes heroBounce {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(8px); }
}
.hero-deco {
    animation: heroPulse 4s ease-in-out infinite;
}
.hero-deco:nth-child(even) {
    animation-delay: 2s;
}
@keyframes heroPulse {
    0%, 100% { transform: scale(1) rotate(0deg); }
    50%       { transform: scale(1.06) rotate(3deg); }
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
                            <img src="{{ Storage::url($product->image) }}" 
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
                            <img src="{{ Storage::url($product->image) }}" 
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
                                    <img src="{{ Storage::url($testimonial->avatar) }}" 
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
                            <img src="{{ Storage::url($article->featured_image) }}" 
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
                        <img src="{{ Storage::url($gallery->image) }}" 
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
                                <img src="{{ Storage::url($gallery->image) }}" 
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