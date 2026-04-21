@extends('layouts.admin')

@section('page-title', 'Kelola Keunggulan')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Keunggulan</h5>
        <a href="{{ route('admin.features.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Icon</th>
                    <th>Judul</th>
                    <th class="d-none d-md-table-cell">Deskripsi</th>
                    <th class="d-none d-lg-table-cell">Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($features as $feature)
                    <tr>
                        <td>
                            @if($feature->icon)
                                <i class="{{ $feature->icon }} fa-2x text-primary"></i>
                            @else
                                <i class="fas fa-star fa-2x text-muted"></i>
                            @endif
                        </td>
                        <td>
                            <div class="fw-medium">{{ $feature->title }}</div>
                            <small class="text-muted d-md-none">{{ Str::limit($feature->description, 50) }}</small>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <div class="text-muted small">{{ Str::limit($feature->description, 80) }}</div>
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <span class="badge {{ $feature->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $feature->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.features.edit', $feature) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.features.destroy', $feature) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus keunggulan ini?')">
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
                            Belum ada keunggulan. <a href="{{ route('admin.features.create') }}" class="text-primary">Tambah keunggulan pertama</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($features->hasPages())
        <div class="card-footer bg-white">
            {{ $features->links() }}
        </div>
    @endif
</div>

@endsection
