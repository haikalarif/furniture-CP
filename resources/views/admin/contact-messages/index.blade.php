@extends('layouts.admin')

@section('page-title', 'Pesan Kontak')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0">Daftar Pesan Kontak</h5>
            @if($newCount > 0)
                <small class="text-muted">{{ $newCount }} pesan baru</small>
            @endif
        </div>
        <div class="d-flex gap-2">
            <span class="badge bg-danger">{{ $newCount }} Baru</span>
            <span class="badge bg-info">{{ $readCount }} Dibaca</span>
            <span class="badge bg-success">{{ $repliedCount }} Dibalas</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Status</th>
                    <th>Nama</th>
                    <th class="d-none d-md-table-cell">Email</th>
                    <th class="d-none d-lg-table-cell">Subjek</th>
                    <th class="d-none d-md-table-cell">Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr class="{{ $message->isNew() ? 'table-warning' : '' }}">
                        <td>
                            @if($message->status == 'new')
                                <span class="badge bg-danger">Baru</span>
                            @elseif($message->status == 'read')
                                <span class="badge bg-info">Dibaca</span>
                            @else
                                <span class="badge bg-success">Dibalas</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-medium">{{ $message->name }}</div>
                            @if($message->phone)
                                <small class="text-muted">
                                    <i class="fab fa-whatsapp"></i> {{ $message->phone }}
                                </small>
                            @endif
                            <div class="d-md-none">
                                <small class="text-muted">{{ $message->email }}</small>
                            </div>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <small>{{ $message->email }}</small>
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <div class="fw-medium">{{ $message->subject }}</div>
                            <small class="text-muted">{{ Str::limit($message->message, 50) }}</small>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <small>{{ $message->created_at->format('d M Y') }}</small>
                            <br>
                            <small class="text-muted">{{ $message->created_at->format('H:i') }}</small>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.contact-messages.show', $message) }}" 
                                   class="btn btn-sm btn-outline-primary"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($message->phone)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}" 
                                       target="_blank"
                                       class="btn btn-sm btn-outline-success d-none d-md-inline-block"
                                       title="WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                @endif
                                <form action="{{ route('admin.contact-messages.destroy', $message) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            Belum ada pesan kontak
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($messages->hasPages())
        <div class="card-footer bg-white">
            {{ $messages->links() }}
        </div>
    @endif
</div>

@endsection
