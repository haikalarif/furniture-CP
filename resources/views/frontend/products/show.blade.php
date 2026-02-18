@extends('layouts.frontend')

@section('title', $product->name . ' - KalKayu Living')

@section('content')

<section class="bg-light" style="padding: 8rem 0;">
    <div class="container">
        <div class="mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-dark btn-sm rounded-circle mb-2">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <div class="row g-5">
            <div class="col-lg-6">
                <div class="position-relative overflow-hidden rounded shadow" style="height: 500px;">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}"
                         class="w-100 h-100" style="object-fit: cover;">
                    
                    @if($product->is_featured)
                        <span class="position-absolute top-0 start-0 m-3 badge bg-warning text-dark fs-6">
                            Featured
                        </span>
                    @endif
                    
                    @if($product->isPromoActive())
                        @if($product->discount_percentage)
                            <span class="position-absolute top-0 end-0 m-3 badge bg-danger fs-5 rounded-circle" style="padding: 18px 5px;">
                                {{ $product->discount_percentage }}%
                            </span>
                        @else
                            <span class="position-absolute top-0 end-0 m-3 badge bg-danger fs-6">
                                PROMO
                            </span>
                        @endif
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mb-3">
                    <span class="badge bg-primary">{{ $product->category }}</span>
                    @if($product->isPromoActive())
                        <span class="badge bg-danger">PROMO AKTIF</span>
                    @endif
                </div>
                
                <h1 class="display-6 fw-bold mb-4">{{ $product->name }}</h1>

                <div class="mb-4">
                    <p class="text-muted">{{ $product->description }}</p>
                </div>

                @if($product->isPromoActive() && $product->price && $product->promo_price)
                    <div class="mb-3">
                        <div class="text-decoration-line-through text-muted h6 mb-2">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                        <div class="h2 fw-bold text-danger mb-2">
                            Rp {{ number_format($product->promo_price, 0, ',', '.') }}
                        </div>
                        <div class="alert alert-success d-inline-block py-1 px-3" style="font-size: 14px;">
                            <i class="fas fa-tag me-2"></i>
                            <strong>Hemat Rp {{ number_format($product->getDiscountAmount(), 0, ',', '.') }}</strong>
                        </div>
                    </div>
                @elseif($product->price)
                    <div class="mb-4">
                        <span class="display-6 fw-bold text-primary">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    </div>
                @endif

                <div class="mb-4">
                    @if($product->material)
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-cube text-primary me-3 mt-1"></i>
                            <div>
                                <small class="text-muted d-block">Material</small>
                                <p class="mb-0 fw-semibold">{{ $product->material }}</p>
                            </div>
                        </div>
                    @endif

                    @if($product->dimensions)
                        <div class="d-flex align-items-start">
                            <i class="fas fa-ruler-combined text-primary me-3 mt-1"></i>
                            <div>
                                <small class="text-muted d-block">Dimensi</small>
                                <p class="mb-0 fw-semibold">{{ $product->dimensions }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                @if($product->promo_end_date)
                    <div class="my-3 text-muted">
                        <i class="fas fa-clock me-2"></i>
                        <strong>Promo berakhir:</strong> {{ $product->promo_end_date->format('d F Y') }}
                    </div>
                @endif

                <div class="d-grid gap-2 d-md-flex">
                    <a href="https://wa.me/6281234567890?text=Halo, saya tertarik dengan {{ $product->name }}" 
                       target="_blank"
                       class="btn btn-success btn-md flex-fill">
                        <i class="fab fa-whatsapp me-2"></i>Pesan via WhatsApp
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="btn btn-outline-dark btn-md flex-fill">
                        Konsultasi
                    </a>
                </div>
            </div>
        </div>

        @if($relatedProducts->count() > 0)
            <div class="mt-5 pt-5">
                <h2 class="h3 fw-bold mb-4">Produk Terkait</h2>
                <div class="row g-4">
                    @foreach($relatedProducts as $related)
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="position-relative overflow-hidden" style="height: 200px;">
                                    <img src="{{ asset('storage/' . $related->image) }}" 
                                         alt="{{ $related->name }}"
                                         class="card-img-top h-100 w-100" style="object-fit: cover;">
                                    
                                    @if($related->isPromoActive() && $related->discount_percentage)
                                        <span class="position-absolute top-0 end-0 m-2 badge bg-danger">
                                            -{{ $related->discount_percentage }}%
                                        </span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <p class="small text-muted mb-1">{{ $related->category }}</p>
                                    <h6 class="card-title mb-2">
                                        <a href="{{ route('products.show', $related->slug) }}" class="text-decoration-none text-dark">
                                            {{ $related->name }}
                                        </a>
                                    </h6>
                                    @if($related->isPromoActive() && $related->price && $related->promo_price)
                                        <div class="text-decoration-line-through text-muted small">
                                            Rp {{ number_format($related->price, 0, ',', '.') }}
                                        </div>
                                        <p class="text-danger fw-bold mb-0">
                                            Rp {{ number_format($related->promo_price, 0, ',', '.') }}
                                        </p>
                                    @elseif($related->price)
                                        <p class="text-primary fw-bold mb-0">
                                            Rp {{ number_format($related->price, 0, ',', '.') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
