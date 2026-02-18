@extends('layouts.admin')

@section('page-title', 'Edit Produk')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Produk: {{ $product->name }}</h5>
    </div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="card-body">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama Produk *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                       class="form-control @error('name') is-invalid @enderror"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Kategori *</label>
                <input type="text" name="category" value="{{ old('category', $product->category) }}" 
                       class="form-control @error('category') is-invalid @enderror"
                       required>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Deskripsi *</label>
                <textarea name="description" rows="4" 
                          class="form-control @error('description') is-invalid @enderror"
                          required>{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Gambar Utama</label>
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}"
                         class="rounded" style="width: 128px; height: 128px; object-fit: cover;">
                </div>
                <input type="file" name="image" accept="image/*" 
                       class="form-control @error('image') is-invalid @enderror">
                <div class="form-text">Kosongkan jika tidak ingin mengubah gambar</div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Harga</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" 
                       class="form-control @error('price') is-invalid @enderror"
                       id="price">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Diskon (%) <span class="text-danger">*</span></label>
                <input type="number" name="discount_percentage" value="{{ old('discount_percentage', $product->discount_percentage) }}" 
                       class="form-control @error('discount_percentage') is-invalid @enderror"
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
                <input type="date" name="promo_start_date" 
                       value="{{ old('promo_start_date', $product->promo_start_date ? $product->promo_start_date->format('Y-m-d') : '') }}" 
                       class="form-control @error('promo_start_date') is-invalid @enderror">
                @error('promo_start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Tanggal Mulai Promo</label>
                <input type="date" name="promo_start_date" 
                       value="{{ old('promo_start_date', $product->promo_start_date ? $product->promo_start_date->format('Y-m-d') : '') }}" 
                       class="form-control @error('promo_start_date') is-invalid @enderror">
                @error('promo_start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Tanggal Selesai Promo</label>
                <input type="date" name="promo_end_date" 
                       value="{{ old('promo_end_date', $product->promo_end_date ? $product->promo_end_date->format('Y-m-d') : '') }}" 
                       class="form-control @error('promo_end_date') is-invalid @enderror">
                @error('promo_end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Material</label>
                <input type="text" name="material" value="{{ old('material', $product->material) }}" 
                       class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Dimensi</label>
                <input type="text" name="dimensions" value="{{ old('dimensions', $product->dimensions) }}" 
                       class="form-control">
            </div>

            <div class="col-12">
                <div class="d-flex gap-4">
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" value="1" 
                               {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                               class="form-check-input" id="is_featured">
                        <label class="form-check-label" for="is_featured">Produk Unggulan</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="is_promo" value="1" 
                               {{ old('is_promo', $product->is_promo) ? 'checked' : '' }}
                               class="form-check-input" id="is_promo">
                        <label class="form-check-label" for="is_promo">Produk Promo</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="is_active" value="1" 
                               {{ old('is_active', $product->is_active) ? 'checked' : '' }}
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
                Update Produk
            </button>
        </div>
    </form>
</div>

@endsection
