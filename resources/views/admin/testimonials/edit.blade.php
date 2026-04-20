@extends('layouts.admin')

@section('page-title', 'Edit Testimoni')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Testimoni: {{ $testimonial->client_name }}</h5>
    </div>

    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="card-body">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama Klien *</label>
                <input type="text" name="client_name" value="{{ old('client_name', $testimonial->client_name) }}" 
                       class="form-control @error('client_name') is-invalid @enderror"
                       required>
                @error('client_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Posisi</label>
                <input type="text" name="client_position" value="{{ old('client_position', $testimonial->client_position) }}" 
                       class="form-control @error('client_position') is-invalid @enderror">
                @error('client_position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Perusahaan</label>
                <input type="text" name="client_company" value="{{ old('client_company', $testimonial->client_company) }}" 
                       class="form-control @error('client_company') is-invalid @enderror">
                @error('client_company')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Rating *</label>
                <select name="rating" class="form-select" required>
                    <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5)</option>
                    <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4)</option>
                    <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>⭐⭐⭐ (3)</option>
                    <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>⭐⭐ (2)</option>
                    <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>⭐ (1)</option>
                </select>
                @error('rating')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Testimoni *</label>
                <textarea name="content" rows="4" 
                          class="form-control @error('content') is-invalid @enderror"
                          required>{{ old('content', $testimonial->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Avatar</label>
                @if($testimonial->avatar)
                    <div class="mb-2">
                        <img src="{{ Storage::url($testimonial->avatar) }}" 
                             alt="{{ $testimonial->client_name }}"
                             class="rounded-circle" style="width: 96px; height: 96px; object-fit: cover;">
                    </div>
                @endif
                <input type="file" name="avatar" accept="image/*" 
                       class="form-control @error('avatar') is-invalid @enderror">
                <div class="form-text">Kosongkan jika tidak ingin mengubah avatar</div>
                @error('avatar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 d-flex align-items-end">
                <div class="form-check">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}
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
                Update Testimoni
            </button>
        </div>
    </form>
</div>

@endsection
