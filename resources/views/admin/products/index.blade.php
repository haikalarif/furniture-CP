@extends('layouts.admin')

@section('page-title', 'Kelola Produk')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Produk</h5>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-2"></i>Tambah
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="text-center">Gambar</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center d-none d-md-table-cell">Kategori</th>
                    <th class="text-center d-none d-md-table-cell">Harga</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="text-center">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded" style="width: 64px; height: 64px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-medium">{{ $product->name }}</div>
                            <div class="d-flex gap-1 mt-1">
                                @if($product->is_featured)
                                    <span class="badge bg-warning text-dark">Featured</span>
                                @endif
                                @if($product->is_promo)
                                    <span class="badge bg-danger">Promo</span>
                                @endif
                            </div>
                            <small class="text-muted d-md-none">{{ $product->category }}</small>
                        </td>
                        <td class="d-none d-md-table-cell">{{ $product->category }}</td>
                        <td class="text-end d-none d-md-table-cell">
                            @if($product->promo_price && $product->isPromoActive())
                                <div>
                                    <span class="text-decoration-line-through text-muted small">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="text-danger fw-bold">
                                    Rp {{ number_format($product->promo_price, 0, ',', '.') }}
                                </div>
                            @elseif($product->price)
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
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
                        <td colspan="6" class="text-center py-4 text-muted">
                            Belum ada produk. <a href="{{ route('admin.products.create') }}" class="text-primary">Tambah produk pertama</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($products->hasPages())
        <div class="card-footer bg-white">
            {{ $products->links() }}
        </div>
    @endif
</div>

@endsection
