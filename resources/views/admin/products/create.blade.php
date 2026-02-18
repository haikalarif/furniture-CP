@extends('layouts.admin')

@section('page-title', 'Tambah Produk')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Tambah Produk Baru</h5>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="card-body">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama Produk *</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                       class="form-control @error('name') is-invalid @enderror"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Kategori *</label>
                <input type="text" name="category" value="{{ old('category') }}" 
                       class="form-control @error('category') is-invalid @enderror"
                       placeholder="Contoh: Meja, Kursi, Lemari"
                       required>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Deskripsi *</label>
                <textarea name="description" rows="4" 
                          class="form-control @error('description') is-invalid @enderror"
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Gambar Utama *</label>
                <input type="file" name="image" accept="image/*" 
                       class="form-control @error('image') is-invalid @enderror"
                       required>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Harga (Opsional)</label>
                <input type="number" name="price" value="{{ old('price') }}" 
                       class="form-control @error('price') is-invalid @enderror"
                       placeholder="0"
                       id="price">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Diskon (%) <span class="text-danger">*</span></label>
                <input type="number" name="discount_percentage" value="{{ old('discount_percentage') }}" 
                       class="form-control @error('discount_percentage') is-invalid @enderror"
                       placeholder="0"
                       min="0"
                       max="100"
                       id="discount_percentage">
                @error('discount_percentage')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Harga promo akan dihitung otomatis: Harga - (Harga × Diskon%)</small>
            </div>

            <div class="col-md-6">
                <label class="form-label">Tanggal Mulai Promo</label>
                <input type="date" name="promo_start_date" value="{{ old('promo_start_date') }}" 
                       class="form-control @error('promo_start_date') is-invalid @enderror">
                @error('promo_start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Tanggal Selesai Promo</label>
                <input type="date" name="promo_end_date" value="{{ old('promo_end_date') }}" 
                       class="form-control @error('promo_end_date') is-invalid @enderror">
                @error('promo_end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Material</label>
                <input type="text" name="material" value="{{ old('material') }}" 
                       class="form-control"
                       placeholder="Contoh: Kayu Jati">
            </div>

            <div class="col-md-6">
                <label class="form-label">Dimensi</label>
                <input type="text" name="dimensions" value="{{ old('dimensions') }}" 
                       class="form-control"
                       placeholder="Contoh: 120 x 60 x 75 cm">
            </div>

            <div class="col-12">
                <div class="d-flex gap-4">
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                               class="form-check-input" id="is_featured">
                        <label class="form-check-label" for="is_featured">Produk Unggulan</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="is_promo" value="1" {{ old('is_promo') ? 'checked' : '' }}
                               class="form-check-input" id="is_promo">
                        <label class="form-check-label" for="is_promo">Produk Promo</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="form-check-input" id="is_active">
                        <label class="form-check-label" for="is_active">Aktif</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 pt-4 border-top">
            <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-sm btn-primary">
                Simpan Produk
            </button>
        </div>
    </form>
</div>

@endsection
