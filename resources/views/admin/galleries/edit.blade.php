@extends('layouts.admin')

@section('page-title', 'Edit Galeri')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Galeri</h5>
    </div>

    <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="card-body">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Judul *</label>
                <input type="text" name="title" value="{{ old('title', $gallery->title) }}" 
                       class="form-control @error('title') is-invalid @enderror"
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Kategori *</label>
                <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                    <option value="interior" {{ old('category', $gallery->category) == 'interior' ? 'selected' : '' }}>Interior</option>
                    <option value="exterior" {{ old('category', $gallery->category) == 'exterior' ? 'selected' : '' }}>Exterior</option>
                    <option value="detail" {{ old('category', $gallery->category) == 'detail' ? 'selected' : '' }}>Detail</option>
                </select>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" rows="3" 
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $gallery->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Gambar Saat Ini</label>
                <div class="mb-3">
                    <img src="{{ Storage::url($gallery->image) }}" 
                         alt="{{ $gallery->title }}"
                         class="rounded" style="max-width: 400px; height: auto;">
                </div>
                <label class="form-label">Ganti Gambar (Opsional)</label>
                <input type="file" name="image" accept="image/*" 
                       class="form-control @error('image') is-invalid @enderror">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
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
                Update Galeri
            </button>
        </div>
    </form>
</div>

@endsection
