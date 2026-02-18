@extends('layouts.admin')

@section('page-title', 'Tambah Testimoni')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Tambah Testimoni Baru</h5>
    </div>

    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="card-body">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama Klien *</label>
                <input type="text" name="client_name" value="{{ old('client_name') }}" 
                       class="form-control @error('client_name') is-invalid @enderror"
                       required>
                @error('client_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Posisi</label>
                <input type="text" name="client_position" value="{{ old('client_position') }}" 
                       class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Perusahaan</label>
                <input type="text" name="client_company" value="{{ old('client_company') }}" 
                       class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Rating *</label>
                <select name="rating" class="form-select" required>
                    <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5)</option>
                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4)</option>
                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ (3)</option>
                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>⭐⭐ (2)</option>
                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>⭐ (1)</option>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Testimoni *</label>
                <textarea name="content" rows="4" 
                          class="form-control @error('content') is-invalid @enderror"
                          required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Avatar (Opsional)</label>
                <input type="file" name="avatar" accept="image/*" 
                       class="form-control @error('avatar') is-invalid @enderror">
                @error('avatar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 d-flex align-items-end">
                <div class="form-check">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="form-check-input" id="is_active">
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 pt-4 border-top">
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm btn-outline-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-sm btn-primary">
                Simpan Testimoni
            </button>
        </div>
    </form>
</div>

@endsection
