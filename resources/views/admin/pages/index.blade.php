@extends('layouts.admin')

@section('page-title', 'Kelola Halaman')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Daftar Halaman</h5>
        <p class="mb-0 small text-muted">Edit konten halaman statis website</p>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Halaman</th>
                    <th>Key</th>
                    <th>Terakhir Diupdate</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                    <tr>
                        <td>
                            <div class="fw-medium">{{ $page->title }}</div>
                        </td>
                        <td>
                            <code class="small">{{ $page->key }}</code>
                        </td>
                        <td class="small text-muted">
                            {{ $page->updated_at->format('d M Y H:i') }}
                        </td>
                        <td>
                            <a href="{{ route('admin.pages.edit', $page) }}" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            Belum ada halaman
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
