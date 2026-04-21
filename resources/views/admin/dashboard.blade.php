@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')

<div class="row g-4 mb-4">
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Produk</p>
                        <h3 class="mb-0">{{ $stats['products'] }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-box text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Produk Promo</p>
                        <h3 class="mb-0">{{ $stats['promo_products'] }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-tags text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Pesan Masuk</p>
                        <h3 class="mb-0">{{ $stats['new_messages'] }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-envelope text-danger fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Testimoni</p>
                        <h3 class="mb-0">{{ $stats['testimonials'] }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-star text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Produk Terbaru</h5>
            </div>
            <div class="card-body">
                @forelse($recentProducts as $product)
                    <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <img src="{{ Storage::url($product->image) }}" 
                                 alt="{{ $product->name }}"
                                 class="rounded me-3" style="width: 48px; height: 48px; object-fit: cover;">
                            <div>
                                <p class="mb-0 fw-medium">{{ Str::limit($product->name, 20) }}</p>
                                <p class="mb-0 small text-muted">{{ $product->category }}</p>
                            </div>
                        </div>
                        <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                @empty
                    <p class="text-muted text-center py-4 mb-0">Belum ada produk</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Pesan Terbaru</h5>
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-sm btn-outline-primary">
                            Lihat Semua
                        </a>
                    </div>
                    <div class="card-body">
                        @forelse($recentMessages as $message)
                            <div class="d-flex align-items-start justify-content-between py-3 {{ $recentMessages->count() > 1 ? 'border-bottom' : '' }}">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <p class="mb-0 fw-medium me-2">{{ Str::limit($message->name, 20) }}</p>
                                        @if($message->isNew())
                                            <span class="badge bg-danger">Baru</span>
                                        @endif
                                    </div>
                                    <p class="mb-0 small text-muted">{{ Str::limit($message->subject, 30) }}</p>
                                    <p class="mb-0 small text-muted">{{ $message->created_at->diffForHumans() }}</p>
                                </div>
                                <a href="{{ route('admin.contact-messages.show', $message) }}" 
                                class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        @empty
                            <p class="text-muted text-center py-4 mb-0">Belum ada pesan</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Produk Promo</h5>
                        <span class="badge bg-success">{{ $stats['promo_products'] }}</span>
                    </div>
                    <div class="card-body">
                        @forelse($promoProducts as $product)
                            <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->name }}"
                                         class="rounded me-3" style="width: 48px; height: 48px; object-fit: cover;">
                                    <div>
                                        <p class="mb-0 fw-medium">{{ Str::limit($product->name, 20) }}</p>
                                        <p class="mb-0 small text-success">
                                            <i class="fas fa-tag"></i> {{ $product->discount_percentage }}% OFF
                                        </p>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <p class="mb-0 small text-decoration-line-through text-muted">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                    <p class="mb-0 small fw-bold text-success">
                                        Rp {{ number_format($product->promo_price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center py-4 mb-0">Belum ada produk promo</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
