@extends('layouts.admin')

@section('page-title', 'Edit Halaman')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Edit Halaman: {{ $page->title }}</h5>
        <p class="mb-0 small text-muted">Key: <code>{{ $page->key }}</code></p>
    </div>

    <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data" class="card-body">
        @csrf
        @method('PUT')

        <div class="row g-3">
            @if($page->key === 'home')
            <!-- Hero Section Settings -->
            <div class="col-12">
                <div class="card border-warning bg-warning bg-opacity-10">
                    <div class="card-header bg-warning bg-opacity-25">
                        <h6 class="mb-0">
                            <i class="fas fa-image me-2"></i>Hero Section Settings
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Hero Title (Judul Utama) *</label>
                                <input type="text" name="hero_title" value="{{ old('hero_title', $page->hero_title) }}" 
                                       class="form-control @error('hero_title') is-invalid @enderror"
                                       placeholder="Contoh: Furniture Premium untuk Hunian Impian"
                                       required>
                                @error('hero_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Hero Subtitle (Deskripsi) *</label>
                                <textarea name="hero_subtitle" rows="2" 
                                          class="form-control @error('hero_subtitle') is-invalid @enderror"
                                          placeholder="Contoh: Desain custom minimalis dengan material berkualitas tinggi"
                                          required>{{ old('hero_subtitle', $page->hero_subtitle) }}</textarea>
                                @error('hero_subtitle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Tema Hero (Seasonal Theme)</label>
                                <select name="hero_theme" class="form-select">
                                    <option value="default" {{ old('hero_theme', $page->hero_theme) == 'default' ? 'selected' : '' }}>
                                        🏠 Default (Standar)
                                    </option>
                                    <option value="ramadan" {{ old('hero_theme', $page->hero_theme) == 'ramadan' ? 'selected' : '' }}>
                                        🌙 Ramadan
                                    </option>
                                    <option value="idul-fitri" {{ old('hero_theme', $page->hero_theme) == 'idul-fitri' ? 'selected' : '' }}>
                                        ✨ Idul Fitri
                                    </option>
                                    <option value="idul-adha" {{ old('hero_theme', $page->hero_theme) == 'idul-adha' ? 'selected' : '' }}>
                                        🐑 Idul Adha
                                    </option>
                                    <option value="natal" {{ old('hero_theme', $page->hero_theme) == 'natal' ? 'selected' : '' }}>
                                        🎄 Natal
                                    </option>
                                    <option value="tahun-baru" {{ old('hero_theme', $page->hero_theme) == 'tahun-baru' ? 'selected' : '' }}>
                                        🎆 Tahun Baru
                                    </option>
                                    <option value="imlek" {{ old('hero_theme', $page->hero_theme) == 'imlek' ? 'selected' : '' }}>
                                        🧧 Imlek
                                    </option>
                                    <option value="kemerdekaan" {{ old('hero_theme', $page->hero_theme) == 'kemerdekaan' ? 'selected' : '' }}>
                                        🇮🇩 Kemerdekaan RI
                                    </option>
                                </select>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Tema akan mengubah warna dan dekorasi hero section
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Background Image (Opsional)</label>
                                @if($page->hero_background)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $page->hero_background) }}" 
                                             alt="Hero Background"
                                             class="rounded w-100" style="height: 128px; object-fit: cover;">
                                    </div>
                                @endif
                                <input type="file" name="hero_background" accept="image/*" 
                                       class="form-control">
                                <div class="form-text">Upload gambar background untuk hero (1920x1080px recommended)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="col-12">
                <label class="form-label">Judul Halaman *</label>
                <input type="text" name="title" value="{{ old('title', $page->title) }}" 
                       class="form-control @error('title') is-invalid @enderror"
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Konten *</label>
                <textarea name="content" rows="15" 
                          class="form-control font-monospace small @error('content') is-invalid @enderror"
                          required>{{ old('content', $page->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">
                    <i class="fas fa-info-circle me-1"></i>
                    Tips: Gunakan enter untuk baris baru. Konten akan ditampilkan sesuai format yang Anda tulis.
                </div>
            </div>

            <div class="col-12">
                <div class="card bg-primary bg-opacity-10 border-primary">
                    <div class="card-body">
                        <h6 class="mb-2">
                            <i class="fas fa-lightbulb me-2"></i>Panduan Konten
                        </h6>
                        <div class="small">
                            @if($page->key === 'home')
                                <p class="mb-1">• Halaman Home: Tulis tagline atau deskripsi singkat untuk hero section</p>
                                <p class="mb-0">• Konten ini akan muncul di bagian atas halaman utama</p>
                            @elseif($page->key === 'about')
                                <p class="mb-1">• Halaman Tentang Kami: Ceritakan tentang perusahaan, visi, misi</p>
                                <p class="mb-0">• Jelaskan keunggulan dan nilai yang ditawarkan</p>
                            @elseif($page->key === 'process')
                                <p class="mb-1">• Halaman Proses: Jelaskan tahapan pengerjaan produk</p>
                                <p class="mb-0">• Gunakan numbering untuk langkah-langkah (1., 2., 3., dst)</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="row g-3 small">
                            <div class="col-md-6">
                                <span class="text-muted">Key:</span>
                                <code class="ms-2">{{ $page->key }}</code>
                            </div>
                            <div class="col-md-6">
                                <span class="text-muted">Terakhir Diupdate:</span>
                                <span class="ms-2">{{ $page->updated_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 pt-4 border-top">
            <a href="{{ route('admin.pages.index') }}" class="btn btn-sm btn-outline-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fas fa-save me-2"></i>Update
            </button>
        </div>
    </form>
</div>

<div class="card shadow-sm mt-4">
    <div class="card-header bg-white">
        <h6 class="mb-0">Preview Konten</h6>
    </div>
    <div class="card-body bg-light">
        <div class="p-3">
            {!! nl2br(e($page->content)) !!}
        </div>
    </div>
</div>

@endsection
