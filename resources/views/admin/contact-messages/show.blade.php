@extends('layouts.admin')

@section('page-title', 'Detail Pesan Kontak')

@section('content')

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Detail Pesan</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Subjek</h6>
                    <h4 class="fw-bold">{{ $contactMessage->subject }}</h4>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted mb-2">Pesan</h6>
                    <div class="p-3 bg-light rounded">
                        <p class="mb-0" style="white-space: pre-wrap;">{{ $contactMessage->message }}</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Nama Pengirim</h6>
                        <p class="fw-medium mb-0">{{ $contactMessage->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Email</h6>
                        <p class="mb-0">
                            <a href="mailto:{{ $contactMessage->email }}" class="text-decoration-none">
                                {{ $contactMessage->email }}
                            </a>
                        </p>
                    </div>
                    @if($contactMessage->phone)
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">No. WhatsApp</h6>
                            <p class="mb-0">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactMessage->phone) }}" 
                                   target="_blank"
                                   class="text-decoration-none">
                                    <i class="fab fa-whatsapp text-success"></i> {{ $contactMessage->phone }}
                                </a>
                            </p>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Tanggal Diterima</h6>
                        <p class="mb-0">{{ $contactMessage->created_at->format('d F Y, H:i') }} WIB</p>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top">
                    <h6 class="text-muted mb-3">Aksi Cepat</h6>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="mailto:{{ $contactMessage->email }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i>Balas via Email
                        </a>
                        @if($contactMessage->phone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactMessage->phone) }}"  target="_blank" class="btn btn-sm btn-outline-success">
                                <i class="fab fa-whatsapp me-2"></i>Chat WhatsApp
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h6 class="mb-0">Update Status</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contact-messages.update', $contactMessage) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="new" {{ $contactMessage->status == 'new' ? 'selected' : '' }}>Baru</option>
                            <option value="read" {{ $contactMessage->status == 'read' ? 'selected' : '' }}>Dibaca</option>
                            <option value="replied" {{ $contactMessage->status == 'replied' ? 'selected' : '' }}>Dibalas</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan Admin</label>
                        <textarea name="admin_notes" rows="4" class="form-control" 
                                  placeholder="Tambahkan catatan internal...">{{ $contactMessage->admin_notes }}</textarea>
                        <small class="text-muted">Catatan ini hanya untuk internal admin</small>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary w-100">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm mt-3">
            <div class="card-header bg-white">
                <h6 class="mb-0">Hapus Pesan</h6>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Hapus pesan ini jika sudah tidak diperlukan. Tindakan ini tidak dapat dibatalkan.</p>
                <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" 
                      method="POST" 
                      onsubmit="return confirm('Yakin ingin menghapus pesan ini? Tindakan ini tidak dapat dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger w-100">
                        <i class="fas fa-trash me-2"></i>Hapus Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
