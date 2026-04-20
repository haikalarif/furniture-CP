@extends('layouts.frontend')

@section('title', $article->title . ' - KalKayu Living')

@section('content')

<article class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="overflow-hidden" style="height: 400px;">
                        <img src="{{ Storage::url($article->featured_image) }}" 
                             alt="{{ $article->title }}"
                             class="card-img-top h-100 w-100" style="object-fit: cover;">
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex align-items-center text-muted small mb-4">
                            <i class="far fa-calendar me-2"></i>
                            {{ $article->published_at->format('d M Y') }}
                            <span class="mx-2">•</span>
                            <i class="far fa-user me-2"></i>
                            {{ $article->author }}
                            <span class="mx-2">•</span>
                            <i class="far fa-eye me-2"></i>
                            {{ $article->views }} views
                        </div>

                        <h1 class="display-5 fw-bold mb-4">{{ $article->title }}</h1>

                        <div class="article-content fs-5 text-muted lh-lg">
                            {!! nl2br(e($article->content)) !!}
                        </div>
                    </div>
                </div>

                @if($relatedArticles->count() > 0)
                    <div class="mt-5">
                        <h2 class="h4 fw-bold mb-4">Artikel Terkait</h2>
                        <div class="row g-4">
                            @foreach($relatedArticles as $related)
                                <div class="col-12 col-md-4">
                                    <article class="card h-100 shadow-sm border-0">
                                        <div class="overflow-hidden" style="height: 150px;">
                                            <img src="{{ Storage::url($related->featured_image) }}" 
                                                 alt="{{ $related->title }}"
                                                 class="card-img-top h-100 w-100" style="object-fit: cover;">
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title mb-2">
                                                <a href="{{ route('articles.show', $related->slug) }}" class="text-decoration-none text-dark">
                                                    {{ Str::limit($related->title, 60) }}
                                                </a>
                                            </h6>
                                            <p class="small text-muted mb-0">
                                                {{ $related->published_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-4 text-center">
                    <a href="{{ route('articles.index') }}" class="btn btn-link text-primary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Artikel
                    </a>
                </div>
            </div>
        </div>
    </div>
</article>

@endsection
