@extends('layouts.frontend')

@section('title', 'Product - KalKayu Living')

@section('content')

<section class="bg-light" style="padding: 8rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Koleksi Produk</h2>
            <p class="text-muted">Furniture premium dengan desain custom untuk hunian impian Anda</p>
        </div>

        @if($categories->count() > 0)
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
            <a href="{{ route('products.index') }}" class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill py-1" style="font-size: 14px;">
                Semua
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('products.index', ['category' => $cat]) }}" class="btn {{ request('category') == $cat ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill py-1" style="font-size: 14px;">
                    {{ $cat }}
                </a>
            @endforeach
        </div>
        @endif

        @if(request('category'))
            <div class="alert alert-info d-flex justify-content-between align-items-center mb-4">
                <span>
                    <i class="fas fa-filter me-2"></i>
                    Menampilkan produk kategori: <strong>{{ request('category') }}</strong>
                    ({{ $products->total() }} produk)
                </span>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-times me-1"></i>Reset Filter
                </a>
            </div>
        @else
            <div class="text-center mb-4 text-muted">
                <small>Menampilkan {{ $products->total() }} produk</small>
            </div>
        @endif

        <div class="row g-4 justify-content-center">
            @forelse($products as $product)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}"
                                 class="card-img-top h-100 w-100" style="object-fit: cover; transition: transform 0.3s;">
                            
                            @if($product->is_featured)
                                <span class="position-absolute top-0 start-0 m-3 badge bg-warning text-dark">
                                    Featured
                                </span>
                            @endif
                            
                            @if($product->isPromoActive())
                                @if($product->discount_percentage)
                                    <span class="position-absolute top-0 end-0 m-3 badge bg-danger fs-6 rounded-circle" style="padding: 15px 4px;">
                                        {{ $product->discount_percentage }}%
                                    </span>
                                @else
                                    <span class="position-absolute top-0 end-0 m-3 badge bg-danger">
                                        PROMO
                                    </span>
                                @endif
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <p class="small text-muted mb-2">{{ $product->category }}</p>
                            <h5 class="card-title mb-2">{{ $product->name }}</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">{{ Str::limit($product->description, 80) }}</p>
                            
                            @if($product->isPromoActive() && $product->price && $product->promo_price)
                                <div class="mb-3">
                                    <div class="text-decoration-line-through text-muted small">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </div>
                                    <div class="text-danger fw-bold fs-5">
                                        Rp {{ number_format($product->promo_price, 0, ',', '.') }}
                                    </div>
                                    <div class="text-success" style="font-size: 12px;">
                                        Hemat Rp {{ number_format($product->getDiscountAmount(), 0, ',', '.') }}
                                    </div>
                                </div>
                            @elseif($product->price)
                                <p class="text-primary fw-bold fs-5 mb-3">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            @endif
                            
                            @if($product->isPromoActive() && $product->promo_end_date)
                                <div class="alert alert-warning py-1 px-2 mb-2 small">
                                    <i class="fas fa-clock me-1"></i>
                                    Berakhir: {{ $product->promo_end_date->format('d M Y') }}
                                </div>
                            @endif
                            
                            <div class="d-grid gap-2 d-flex">
                                <a href="https://wa.me/6281234567890?text=Halo, saya tertarik dengan {{ $product->name }}" target="_blank" class="btn btn-success btn-md flex-fill">
                                    <i class="fab fa-whatsapp me-2"></i>Pesan
                                </a>
                                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-dark flex-fill">
                                    <i class="fas fa-search me-2"></i>Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Belum ada produk tersedia</p>
                </div>
            @endforelse
        </div>

        @if($products->hasPages())
            <div class="mt-5">
                {{ $products->appends(['category' => request('category')])->links() }}
            </div>
        @endif
    </div>
</section>

<style>
.product-card:hover img {
    transform: scale(1.1);
}
</style>

@endsection
