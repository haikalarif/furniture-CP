@extends('layouts.frontend')

@section('title', 'Artikel - KalKayu Living')

@section('content')

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold mb-3">Artikel & Tips</h1>
            <p class="lead text-muted">Inspirasi dan panduan seputar furniture & interior</p>
        </div>

        <div class="row g-4">
            @forelse($articles as $article)
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="card h-100 shadow-sm border-0">
                        <div class="overflow-hidden" style="height: 200px;">
                            <img src="{{ Storage::url($article->featured_image) }}" 
                                 alt="{{ $article->title }}"
                                 class="card-img-top h-100 w-100" style="object-fit: cover; transition: transform 0.3s;">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center text-muted small mb-3">
                                <i class="far fa-calendar me-2"></i>
                                {{ $article->published_at->format('d M Y') }}
                                <span class="mx-2">•</span>
                                <i class="far fa-eye me-2"></i>
                                {{ $article->views }} views
                            </div>
                            <h5 class="card-title mb-3">
                                <a href="{{ route('articles.show', $article->slug) }}" class="text-decoration-none text-dark">
                                    {{ $article->title }}
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-3 flex-grow-1">{{ Str::limit($article->excerpt, 120) }}</p>
                            <a href="{{ route('articles.show', $article->slug) }}" 
                               class="btn btn-link text-primary p-0">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-newspaper text-muted" style="font-size: 4rem;"></i>
                    <p class="text-muted fs-5 mt-3">Belum ada artikel tersedia</p>
                </div>
            @endforelse
        </div>

        @if($articles->hasPages())
            <div class="mt-5">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
