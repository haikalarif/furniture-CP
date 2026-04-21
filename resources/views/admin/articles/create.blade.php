@extends('layouts.admin')

@section('page-title', 'Tambah Artikel')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Tambah Artikel Baru</h5>
    </div>

    <form id="main-form" action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="card-body">
        @csrf

        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Judul *</label>
                <input type="text" name="title" value="{{ old('title') }}" 
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
                          required>{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Konten *</label>
                <textarea name="content" rows="10" 
                          class="form-control @error('content') is-invalid @enderror"
                          required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Gambar Utama *</label>
                <input type="file" name="featured_image" accept="image/*" 
                       class="form-control @error('featured_image') is-invalid @enderror"
                       required>
                @error('featured_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Penulis</label>
                <input type="text" name="author" value="{{ old('author', 'Admin') }}" 
                       class="form-control">
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                           class="form-check-input" id="is_published">
                    <label class="form-check-label" for="is_published">Publish Artikel</label>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 pt-4 border-top">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-outline-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fas fa-save me-1"></i> Simpan
            </button>
        </div>
    </form>
</div>

<!-- Floating Save Button -->
<div class="floating-save-btn">
    <button type="submit" form="main-form" class="btn btn-sm btn-primary shadow" title="Simpan Artikel">
        <i class="fas fa-save me-1"></i> Simpan
    </button>
</div>

@endsection
