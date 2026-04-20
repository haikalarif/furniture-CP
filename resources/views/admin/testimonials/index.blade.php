@extends('layouts.admin')

@section('page-title', 'Kelola Testimoni')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Testimoni</h5>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Klien</th>
                    <th class="d-none d-md-table-cell">Perusahaan</th>
                    <th>Rating</th>
                    <th class="d-none d-lg-table-cell">Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $testimonial)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($testimonial->avatar)
                                    <img src="{{ Storage::url($testimonial->avatar) }}" 
                                         alt="{{ $testimonial->client_name }}"
                                         class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px;">
                                        {{ substr($testimonial->client_name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-medium">{{ $testimonial->client_name }}</div>
                                    @if($testimonial->client_position)
                                        <div class="small text-muted">{{ $testimonial->client_position }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="d-none d-md-table-cell">{{ $testimonial->client_company ?? '-' }}</td>
                        <td>
                            <div class="d-flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <span class="badge {{ $testimonial->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $testimonial->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus testimoni ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            Belum ada testimoni. <a href="{{ route('admin.testimonials.create') }}" class="text-primary">Tambah testimoni pertama</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($testimonials->hasPages())
        <div class="card-footer bg-white">
            {{ $testimonials->links() }}
        </div>
    @endif
</div>

@endsection
