<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - KalKayu Living</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --sidebar-width: 250px;
        }
        
        body {
            overflow-x: hidden;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: var(--sidebar-width);
            background: #1f2937;
            color: white;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1.5rem;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100%;
            background: #f3f4f6;
            transition: margin-left 0.3s ease;
        }
        
        .top-bar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .sidebar-toggle {
            display: none;
            background: #1f2937;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            font-size: 1.25rem;
        }
        
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .sidebar-overlay.show {
                display: block;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar-toggle {
                display: inline-block;
            }
            
            .top-bar h2 {
                font-size: 1.1rem !important;
            }
            
            .top-bar .d-flex.gap-3 a,
            .top-bar .d-flex.gap-3 button {
                font-size: 0.875rem;
            }
            
            .top-bar .d-flex.gap-3 a span,
            .top-bar .d-flex.gap-3 button span {
                display: none;
            }
        }
        
        /* Tablet */
        @media (max-width: 992px) and (min-width: 769px) {
            :root {
                --sidebar-width: 200px;
            }
            
            .sidebar .nav-link {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }
        }
        
        /* Table Responsive */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        @media (max-width: 768px) {
            .table {
                font-size: 0.875rem;
            }
            
            .table th,
            .table td {
                padding: 0.5rem;
                white-space: nowrap;
            }
            
            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
            
            .card {
                margin-bottom: 1rem;
            }
            
            .card-header h5 {
                font-size: 1rem;
            }
            
            main.p-4 {
                padding: 1rem !important;
            }
            
            /* Hide less important columns on mobile */
            .d-none-mobile {
                display: none !important;
            }
            
            /* Make action buttons stack vertically */
            .d-flex.gap-2 {
                flex-direction: column !important;
                gap: 0.25rem !important;
            }
            
            .d-flex.gap-2 .btn {
                width: 100%;
            }
            
            /* Smaller images in table */
            .table img {
                max-width: 50px !important;
                max-height: 50px !important;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
    
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="p-4 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0">KalKayu Admin</h4>
                <button class="btn btn-link text-white d-md-none p-0" onclick="toggleSidebar()">
                    <i class="fas fa-times fa-lg"></i>
                </button>
            </div>
            
            <nav class="mt-3">
                <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home me-3"></i> Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-box me-3"></i> Produk
                </a>
                <a href="{{ route('admin.features.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.features.*') ? 'active' : '' }}">
                    <i class="fas fa-award me-3"></i> Keunggulan
                </a>
                <a href="{{ route('admin.galleries.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                    <i class="fas fa-images me-3"></i> Galeri
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                    <i class="fas fa-star me-3"></i> Testimoni
                </a>
                <a href="{{ route('admin.contact-messages.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope me-3"></i> Pesan Kontak
                    @if($newMessagesCount > 0)
                        <span class="badge bg-danger ms-auto">{{ $newMessagesCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.articles.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper me-3"></i> Artikel
                </a>
                <a href="{{ route('admin.pages.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                    <i class="fas fa-file me-3"></i> Halaman
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <!-- Top Bar -->
            <header class="top-bar">
                <div class="d-flex justify-content-between align-items-center p-3">
                    <div class="d-flex align-items-center gap-2">
                        <button class="sidebar-toggle" onclick="toggleSidebar()">
                            <i class="fas fa-bars"></i>
                        </button>
                        <!-- <h2 class="h4 mb-0 fw-semibold">@yield('page-title', 'Dashboard')</h2> -->
                    </div>
                    
                    <div class="d-flex align-items-center gap-3">
                        <a href="{{ route('home') }}" target="_blank" class="text-decoration-none text-secondary">
                            <i class="fas fa-external-link-alt me-2"></i><span class="d-none d-md-inline">Lihat Website</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="mb-0">
                            @csrf
                            <button type="submit" class="btn btn-link text-danger text-decoration-none">
                                <i class="fas fa-sign-out-alt me-2"></i><span class="d-none d-md-inline">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }
        
        // Close sidebar when clicking on a link (mobile)
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    toggleSidebar();
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
