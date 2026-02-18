@extends('layouts.frontend')

@section('title', 'Contact - KalKayu Living')

@section('content')

<section class="bg-light" style="padding: 8rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Hubungi Kami</h2>
            <p class="text-muted">Konsultasikan kebutuhan furniture Anda dengan tim kami</p>
        </div>

        <div class="row g-5">
            <div class="col-lg-6">
                <h2 class="h4 fw-bold mb-4">Informasi Kontak</h2>
                
                <div class="d-flex flex-column gap-4">
                    <div class="d-flex align-items-start">
                        <div class="bg-primary text-white rounded p-3 me-3">
                            <i class="fas fa-map-marker-alt fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Alamat</h6>
                            <p class="text-muted mb-0">Jl. Furniture Premium No. 123<br>Bandung, Jawa Barat</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div class="bg-primary text-white rounded p-3 me-3">
                            <i class="fas fa-phone fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Telepon</h6>
                            <p class="text-muted mb-0">+62 812-3456-7890</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div class="bg-primary text-white rounded p-3 me-3">
                            <i class="fas fa-envelope fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Email</h6>
                            <p class="text-muted mb-0">info@kalkayuliving.com</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div class="bg-primary text-white rounded p-3 me-3">
                            <i class="fas fa-clock fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Jam Operasional</h6>
                            <p class="text-muted mb-0">Senin - Jumat: 09.00 - 17.00 WIB<br>Sabtu: 09.00 - 15.00 WIB</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h6 class="fw-semibold mb-3">Ikuti Kami</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-dark rounded-circle" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-dark rounded-circle" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="btn btn-dark rounded-circle" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow border-0 p-4">
                    <h2 class="h4 fw-bold mb-4">Kirim Pesan</h2>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="form-control form-control-md @error('name') is-invalid @enderror"
                                   placeholder="Masukkan nama lengkap Anda">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="form-control form-control-md @error('email') is-invalid @enderror"
                                   placeholder="contoh@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. WhatsApp</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                   class="form-control form-control-md @error('phone') is-invalid @enderror"
                                   placeholder="08123456789">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Opsional, untuk memudahkan kami menghubungi Anda</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subjek *</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required
                                   class="form-control form-control-md @error('subject') is-invalid @enderror"
                                   placeholder="Contoh: Konsultasi Furniture Ruang Tamu">
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pesan *</label>
                            <textarea name="message" rows="4" required
                                      class="form-control form-control-md @error('message') is-invalid @enderror"
                                      placeholder="Tuliskan pesan Anda di sini...">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimal 10 karakter</small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-md w-100">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                        </button>
                    </form>

                    <div class="mt-4 pt-4 border-top text-center">
                        <p class="text-muted mb-3">Atau hubungi langsung via WhatsApp</p>
                        <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success btn-md">
                            <i class="fab fa-whatsapp me-2"></i>Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
