@extends('layouts.admin')

@section('page-title', 'Edit Artikel')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Artikel: {{ $article->title }}</h5>
    </div>

    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="card-body">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Judul *</label>
                <input type="text" name="title" value="{{ old('title', $article->title) }}" 
                       class="form-control @error('title') is-invalid @enderror"
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Ringkasan *</label>
                <textarea name="excerpt" rows="2" 
                          class="form-control @error('excerpt') is-invalid @enderror"
                          required>{{ old('excerpt', $article->excerpt) }}</textarea>
                @error('excerpt')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Konten *</label>
                <textarea name="content" rows="10" 
                          class="form-control @error('content') is-invalid @enderror"
                          required>{{ old('content', $article->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Gambar Utama</label>
                @if($article->featured_image)
                    <div class="mb-2">
                        <img src="{{ Storage::url(article->featured_image) }}" 
                             alt="{{ $article->title }}"
                             class="rounded w-100" style="height: 192px; object-fit: cover;">
                    </div>
                @endif
                <input type="file" name="featured_image" accept="image/*" 
                       class="form-control @error('featured_image') is-invalid @enderror">
                <div class="form-text">Kosongkan jika tidak ingin mengubah gambar</div>
                @error('featured_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Penulis</label>
                <input type="text" name="author" value="{{ old('author', $article->author) }}" 
                       class="form-control @error('author') is-invalid @enderror">
                @error('author')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $article->is_published) ? 'checked' : '' }}
                           class="form-check-input" id="is_published">
                    <label class="form-check-label" for="is_published">Publish Artikel</label>
                </div>
            </div>

            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="row g-3 small">
                            <div class="col-md-6">
                                <span class="text-muted">Slug:</span>
                                <code class="ms-2">{{ $article->slug }}</code>
                            </div>
                            <div class="col-md-6">
                                <span class="text-muted">Views:</span>
                                <span class="ms-2 fw-semibold">{{ $article->views }}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="text-muted">Dibuat:</span>
                                <span class="ms-2">{{ $article->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="text-muted">Diupdate:</span>
                                <span class="ms-2">{{ $article->updated_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 pt-4 border-top">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-outline-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-sm btn-primary">
                Update Artikel
            </button>
        </div>
    </form>
</div>

@endsection
