@extends('layouts.admin')

@section('page-title', 'Tambah Galeri')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Tambah Galeri Baru</h5>
    </div>

    <form id="main-form" action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="card-body">
        @csrf

        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Judul *</label>
                <input type="text" name="title" value="{{ old('title') }}" 
                       class="form-control @error('title') is-invalid @enderror"
                       placeholder="Contoh: Ruang Tamu Modern Minimalis"
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Kategori *</label>
                <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                    <option value="">Pilih Kategori</option>
                    <option value="interior" {{ old('category') == 'interior' ? 'selected' : '' }}>Interior</option>
                    <option value="exterior" {{ old('category') == 'exterior' ? 'selected' : '' }}>Exterior</option>
                    <option value="detail" {{ old('category') == 'detail' ? 'selected' : '' }}>Detail</option>
                </select>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" rows="3" 
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Deskripsi singkat tentang gambar ini (opsional)">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Gambar *</label>
                <input type="file" name="image" accept="image/*" 
                       class="form-control @error('image') is-invalid @enderror"
                       required>
                <small class="text-muted">Format: JPG, PNG, WEBP. Maksimal 5MB. Rekomendasi ukuran: 1200x800px</small>
                @error('image')
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
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-sm btn-outline-secondary">
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
    <button type="submit" form="main-form" class="btn btn-sm btn-primary shadow" title="Simpan Galeri">
        <i class="fas fa-save me-1"></i> Simpan
    </button>
</div>

<div class="card-header bg-white">
    <h6 class="mb-0">Tips Foto Galeri</h6>
</div>
<div class="card-body">
    <div class="row g-3">
        <div class="col-md-4">
            <div class="border rounded p-3">
                <h6 class="text-primary">📸 Interior</h6>
                <ul class="small mb-0">
                    <li>Ruang tamu dengan furniture</li>
                    <li>Ruang makan</li>
                    <li>Kamar tidur</li>
                    <li>Ruang kerja</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="border rounded p-3">
                <h6 class="text-success">🏡 Exterior</h6>
                <ul class="small mb-0">
                    <li>Teras dengan furniture outdoor</li>
                    <li>Taman dengan gazebo</li>
                    <li>Balkon</li>
                    <li>Area outdoor lainnya</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="border rounded p-3">
                <h6 class="text-info">🔍 Detail</h6>
                <ul class="small mb-0">
                    <li>Close-up furniture</li>
                    <li>Detail ukiran</li>
                    <li>Tekstur material</li>
                    <li>Finishing produk</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
