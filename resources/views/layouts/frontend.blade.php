<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KalKayu Living - Premium Furniture & Interior')</title>
    <meta name="description" content="@yield('description', 'Furniture custom premium dan interior minimalis berkualitas tinggi')">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            padding-top: 0 !important; /* Remove padding - navbar is overlay */
        }
        
        :root {
            --primary-color: #92400e;
            --primary-hover: #78350f;
            --cream-color: #d8d0a8;
        }

        .uppercase {
            text-transform: uppercase;
        }
        
        /* Transparent Navbar Effect - Menyatu dengan Hero */
        .navbar {
            background-color: transparent !important;
            transition: all 0.4s ease-in-out;
            padding: 1.2rem 0;
            box-shadow: none;
        }
        
        .navbar.scrolled {
            background-color: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 0;
            backdrop-filter: blur(10px);
        }
        
        /* Navbar Brand - Putih saat transparan */
        .navbar-brand {
            /* color: white !important; */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
            /* font-size: 1.5rem !important; */
        }
        
        .navbar.scrolled .navbar-brand {
            color: #1f2937 !important;
            text-shadow: none;
        }
        
        /* Text "Living" tetap putih saat transparan */
        .navbar-brand .text-primary {
            /* color: white !important; */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .navbar.scrolled .navbar-brand .text-primary {
            color: var(--primary-color) !important;
            text-shadow: none;
        }
        
        /* Nav Links - Putih saat transparan */
        .nav-link {
            position: relative;
            /* color: white !important; */
            font-weight: 700;
            padding: 0.5rem 1rem !important;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled .nav-link {
            color: #1f2937 !important;
            text-shadow: none;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s;
        }
        
        .navbar.scrolled .nav-link::after {
            background: var(--primary-color);
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .navbar.scrolled .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        /* Navbar Toggler - Putih saat transparan */
        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        .navbar.scrolled .navbar-toggler {
            border-color: rgba(0, 0, 0, 0.1);
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        /* WhatsApp Button - Tetap terlihat dengan shadow */
        .navbar .btn-success {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        
        .navbar .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }
        
        /* Other Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .btn-outline-primary {
            background-color: transparent;
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }
        
        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        .bg-cream {
            background-color: var(--cream-color) !important;
        }
        
        /* Untuk halaman non-home, tambahkan padding */
        body:not(.home-page) {
            padding-top: 76px;
        }
    </style>
    
    @stack('styles')
</head>
<body class="@yield('body-class')">
    
    <!-- Navigation with Transparent Effect -->
    <nav class="navbar navbar-expand-lg fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                KalKayu <span class="text-primary">Living</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse text-center" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery.*') ? 'active' : '' }}" href="{{ route('gallery.index') }}">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('process') ? 'active' : '' }}" href="{{ route('process') }}">Process</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}" href="{{ route('articles.index') }}">Artikel</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
                
                <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success mt-3">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light pt-5 pb-4">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white fw-bold mb-3">KalKayu Living</h5>
                    <p class="small">Furniture custom premium dan interior minimalis berkualitas tinggi untuk hunian impian Anda.</p>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-semibold mb-3">Menu</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-light text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}" class="text-light text-decoration-none">About</a></li>
                        <li class="mb-2"><a href="{{ route('products.index') }}" class="text-light text-decoration-none">Product</a></li>
                        <li class="mb-2"><a href="{{ route('gallery.index') }}" class="text-light text-decoration-none">Gallery</a></li>
                        {{-- <li class="mb-2"><a href="{{ route('articles.index') }}" class="text-light text-decoration-none">Artikel</a></li> --}}
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-semibold mb-3">Contact</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><i class="fas fa-phone me-2"></i>+62 812-3456-7890</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i>info@kalkayuliving.com</li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Bandung, Indonesia</li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-semibold mb-3">Ikuti Kami</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-light fs-4"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light fs-4"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-light fs-4"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="border-top border-secondary pt-3 text-center small">
                <p class="mb-0">&copy; {{ date('Y') }} KalKayu Living. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Navbar Scroll Effect -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Check scroll position on page load
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
