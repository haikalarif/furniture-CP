<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .auth-background {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 0;
            }
            .auth-background img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .auth-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(139, 69, 19, 0.7), rgba(101, 67, 33, 0.7));
                opacity: 0.8;
            }
            .auth-container {
                position: relative;
                z-index: 10;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2rem 1rem;
            }
            .auth-card {
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(15px);
                -webkit-backdrop-filter: blur(15px);
                border-radius: 1rem;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
                border: 1px solid rgba(255, 255, 255, 0.2);
                padding: 2.5rem;
                width: 100%;
                max-width: 450px;
            }
            .auth-card label {
                color: #ffffff;
                font-weight: 500;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            }
            .auth-card input[type="email"],
            .auth-card input[type="password"],
            .auth-card input[type="text"] {
                background: rgba(255, 255, 255, 0.9);
                border: 1px solid rgba(255, 255, 255, 0.3);
                color: #1f2937;
            }
            .auth-card input[type="email"]:focus,
            .auth-card input[type="password"]:focus,
            .auth-card input[type="text"]:focus {
                background: rgba(255, 255, 255, 0.95);
                border-color: #8B4513;
                box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
            }
            .auth-card a {
                color: #ffffff;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            }
            .auth-card a:hover {
                color: #f4a460;
            }
            .auth-card .text-sm {
                color: rgba(255, 255, 255, 0.9);
            }
            .auth-card button[type="submit"] {
                background: #8B4513;
                border: none;
                color: white;
                font-weight: 600;
                transition: all 0.3s;
            }
            .auth-card button[type="submit"]:hover {
                background: #654321;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(139, 69, 19, 0.4);
            }
            .auth-logo {
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(15px);
                -webkit-backdrop-filter: blur(15px);
                padding: 1.5rem 2rem;
                border-radius: 1rem;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
                border: 1px solid rgba(255, 255, 255, 0.2);
                margin-bottom: 2rem;
            }
            .auth-logo h2 {
                margin: 0;
                font-size: 2rem;
                font-weight: bold;
                color: #ffffff;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }
            .auth-logo .text-primary {
                color: #f4a460 !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        @php
            // Safe fallback - tidak bergantung pada database
            $heroTheme = 'elegant';
            $heroBackground = null;
            
            // Coba ambil dari database jika tersedia
            try {
                if (isset($homePage) && $homePage) {
                    $heroTheme = $homePage->hero_theme ?? 'elegant';
                    $heroBackground = $homePage->hero_background;
                }
            } catch (\Exception $e) {
                // Ignore error, use default
            }
            
            $themes = [
                'elegant' => [
                    'bg_style' => 'background: linear-gradient(135deg, rgba(139, 69, 19, 0.7), rgba(101, 67, 33, 0.7));',
                ],
                'modern' => [
                    'bg_style' => 'background: linear-gradient(135deg, rgba(44, 62, 80, 0.7), rgba(52, 73, 94, 0.7));',
                ],
                'luxury' => [
                    'bg_style' => 'background: linear-gradient(135deg, rgba(26, 26, 26, 0.7), rgba(74, 74, 74, 0.7));',
                ],
            ];
            
            $theme = $themes[$heroTheme] ?? $themes['elegant'];
        @endphp
        
        <!-- Background Layer -->
        <div class="auth-background">
            @if($heroBackground && file_exists(public_path('storage/' . $heroBackground)))
                <!-- Custom Background Image -->
                <img src="{{ asset('storage/' . $heroBackground) }}" 
                     alt="Background"
                     style="width: 100%; height: 100%; object-fit: cover;">
            @endif
            <!-- Overlay (always show) -->
            <div class="auth-overlay" style="{{ $theme['bg_style'] }}"></div>
        </div>

        <!-- Content -->
        <div class="auth-container">
            <div class="text-center auth-logo">
                <a href="/" style="text-decoration: none;">
                    <h2>KalKayu <span class="text-primary">Living</span></h2>
                </a>
            </div>

            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
