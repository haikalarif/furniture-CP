@extends('layouts.admin')

@section('page-title', 'Kelola Artikel')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Artikel</h5>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th class="d-none d-md-table-cell">Penulis</th>
                    <th class="d-none d-lg-table-cell">Status</th>
                    <th class="d-none d-lg-table-cell">Views</th>
                    <th class="d-none d-md-table-cell">Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr>
                        <td>
                            <img src="{{ Storage::url($article->featured_image) }}" 
                                 alt="{{ $article->title }}"
                                 class="rounded" style="width: 64px; height: 64px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-medium">{{ Str::limit($article->title, 50) }}</div>
                            <div class="d-md-none">
                                <small class="text-muted">{{ $article->author }}</small>
                                <span class="badge {{ $article->is_published ? 'bg-success' : 'bg-secondary' }} ms-1">
                                    {{ $article->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                        </td>
                        <td class="d-none d-md-table-cell">{{ $article->author }}</td>
                        <td class="d-none d-lg-table-cell">
                            <span class="badge {{ $article->is_published ? 'bg-success' : 'bg-secondary' }}">
                                {{ $article->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="d-none d-lg-table-cell">{{ $article->views }}</td>
                        <td class="d-none d-md-table-cell">{{ $article->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.articles.edit', $article) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.articles.destroy', $article) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
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
                        <td colspan="7" class="text-center py-4 text-muted">
                            Belum ada artikel. <a href="{{ route('admin.articles.create') }}" class="text-primary">Tambah artikel pertama</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($articles->hasPages())
        <div class="card-footer bg-white">
            {{ $articles->links() }}
        </div>
    @endif
</div>

@endsection
