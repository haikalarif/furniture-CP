@extends('layouts.admin')

@section('page-title', 'Kelola Galeri')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Galeri</h5>
        <a href="{{ route('admin.galleries.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th class="d-none d-md-table-cell">Kategori</th>
                    <th class="d-none d-lg-table-cell">Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galleries as $gallery)
                    <tr>
                        <td>
                            <img src="{{ Storage::url($gallery->image) }}" 
                                 alt="{{ $gallery->title }}"
                                 class="rounded" style="width: 100px; height: 70px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-medium">{{ $gallery->title }}</div>
                            @if($gallery->description)
                                <div class="small text-muted d-none d-md-block">{{ Str::limit($gallery->description, 50) }}</div>
                            @endif
                            <div class="d-md-none mt-1">
                                @if($gallery->category == 'interior')
                                    <span class="badge bg-primary">Interior</span>
                                @elseif($gallery->category == 'exterior')
                                    <span class="badge bg-success">Exterior</span>
                                @else
                                    <span class="badge bg-info">Detail</span>
                                @endif
                            </div>
                        </td>
                        <td class="d-none d-md-table-cell">
                            @if($gallery->category == 'interior')
                                <span class="badge bg-primary">Interior</span>
                            @elseif($gallery->category == 'exterior')
                                <span class="badge bg-success">Exterior</span>
                            @else
                                <span class="badge bg-info">Detail</span>
                            @endif
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <span class="badge {{ $gallery->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.galleries.edit', $gallery) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.galleries.destroy', $gallery) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
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
                            Belum ada galeri. <a href="{{ route('admin.galleries.create') }}" class="text-primary">Tambah galeri pertama</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($galleries->hasPages())
        <div class="card-footer bg-white">
            {{ $galleries->links() }}
        </div>
    @endif
</div>

@endsection
