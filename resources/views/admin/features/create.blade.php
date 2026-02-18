@extends('layouts.admin')

@section('page-title', 'Tambah Keunggulan')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Tambah Keunggulan Baru</h5>
    </div>

    <form action="{{ route('admin.features.store') }}" method="POST" class="card-body">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Judul *</label>
                <input type="text" name="title" value="{{ old('title') }}" 
                       class="form-control @error('title') is-invalid @enderror"
                       placeholder="Contoh: Kualitas Premium"
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Icon (Font Awesome Class)</label>
                <input type="text" name="icon" value="{{ old('icon') }}" 
                       class="form-control @error('icon') is-invalid @enderror"
                       placeholder="Contoh: fas fa-star">
                <small class="text-muted">Gunakan class Font Awesome, contoh: fas fa-star, fas fa-check-circle</small>
                @error('icon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Deskripsi *</label>
                <textarea name="description" rows="4" 
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Jelaskan keunggulan ini..."
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="form-check-input" id="is_active">
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 pt-4 border-top">
            <a href="{{ route('admin.features.index') }}" class="btn btn-sm btn-outline-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-sm btn-primary">
                Simpan Keunggulan
            </button>
        </div>
    </form>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-header bg-white">
        <h6 class="mb-0">Referensi Icon Font Awesome</h6>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="text-center p-3 border rounded">
                    <i class="fas fa-star fa-2x text-primary mb-2"></i>
                    <div class="small"><code>fas fa-star</code></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-3 border rounded">
                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                    <div class="small"><code>fas fa-check-circle</code></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-3 border rounded">
                    <i class="fas fa-shield-alt fa-2x text-info mb-2"></i>
                    <div class="small"><code>fas fa-shield-alt</code></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-3 border rounded">
                    <i class="fas fa-heart fa-2x text-danger mb-2"></i>
                    <div class="small"><code>fas fa-heart</code></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-3 border rounded">
                    <i class="fas fa-award fa-2x text-warning mb-2"></i>
                    <div class="small"><code>fas fa-award</code></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-3 border rounded">
                    <i class="fas fa-thumbs-up fa-2x text-primary mb-2"></i>
                    <div class="small"><code>fas fa-thumbs-up</code></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-3 border rounded">
                    <i class="fas fa-gem fa-2x text-success mb-2"></i>
                    <div class="small"><code>fas fa-gem</code></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-3 border rounded">
                    <i class="fas fa-bolt fa-2x text-warning mb-2"></i>
                    <div class="small"><code>fas fa-bolt</code></div>
                </div>
            </div>
        </div>
        <div class="mt-3 text-center">
            <a href="https://fontawesome.com/icons" target="_blank" class="btn btn-sm btn-outline-primary">
                Lihat Semua Icon Font Awesome
            </a>
        </div>
    </div>
</div>

@endsection
