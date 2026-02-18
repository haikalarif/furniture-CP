@extends('layouts.frontend')

@section('title', 'Gallery - KalKayu Living')

@section('content')

<section class="bg-light" style="padding: 8rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Gallery</h2>
            <p class="text-muted">Inspirasi desain interior & exterior dengan furniture mewah dan modern</p>
        </div>

        <!-- Category Filter -->
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
            <a href="{{ route('gallery.index') }}" class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill" style="font-size: 14px; padding: 2px 10px;">
                Semua
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('gallery.index', ['category' => $cat]) }}" class="btn {{ request('category') == $cat ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill" style="font-size: 14px; padding: 2px 10px; text-transform: capitalize;">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        @if(request('category'))
            <div class="alert alert-info d-flex justify-content-between align-items-center mb-4">
                <span>
                    <i class="fas fa-filter me-2"></i>
                    Menampilkan kategori: <strong>{{ ucfirst(request('category')) }}</strong>
                    ({{ $galleries->total() }} foto)
                </span>
                <a href="{{ route('gallery.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-times me-1"></i>Reset Filter
                </a>
            </div>
        @else
            <div class="text-center mb-4 text-muted">
                <small>Menampilkan {{ $galleries->total() }} foto</small>
            </div>
        @endif

        <!-- Gallery Grid -->
        <div class="row g-3">
            @forelse($galleries as $index => $gallery)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="gallery-item position-relative overflow-hidden rounded shadow-sm" 
                         style="height: 280px; cursor: pointer;"
                         onclick="openGalleryModal({{ $index }})">
                        <img src="{{ asset('storage/' . $gallery->image) }}" 
                             alt="{{ $gallery->title }}"
                             class="w-100 h-100 object-fit-cover gallery-image">
                        
                        <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-between p-3"
                             style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); opacity: 0; transition: opacity 0.3s;">
                            <div class="text-end">
                                @if($gallery->category == 'interior')
                                    <span class="badge bg-primary">Interior</span>
                                @elseif($gallery->category == 'exterior')
                                    <span class="badge bg-success">Exterior</span>
                                @else
                                    <span class="badge bg-info">Detail</span>
                                @endif
                            </div>
                            <div class="text-white">
                                <div class="fw-bold">{{ $gallery->title }}</div>
                                @if($gallery->description)
                                    <small class="text-white-50">{{ Str::limit($gallery->description, 50) }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-images fa-4x text-muted mb-3"></i>
                        <p class="text-muted fs-5">Belum ada foto galeri</p>
                        @if(request('category'))
                            <a href="{{ route('gallery.index') }}" class="btn btn-primary">
                                Lihat Semua
                            </a>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Single Modal for All Images -->
        <div class="modal fade" id="galleryModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content bg-dark">
                    <div class="modal-header border-0">
                        <div>
                            <h5 class="modal-title text-white" id="galleryModalTitle"></h5>
                            <span class="badge" id="galleryModalBadge"></span>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center p-0 position-relative">
                        <!-- Previous Button -->
                        <button class="btn btn-light position-absolute start-0 ms-3 rounded-circle" 
                                style="width: 50px; height: 50px; z-index: 10; opacity: 0.8;"
                                onclick="navigateGallery(-1)">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        
                        <img src="" 
                             alt=""
                             id="galleryModalImage"
                             class="img-fluid"
                             style="max-height: 90vh; max-width: 100%; object-fit: contain;">
                        
                        <!-- Next Button -->
                        <button class="btn btn-light position-absolute end-0 me-3 rounded-circle" 
                                style="width: 50px; height: 50px; z-index: 10; opacity: 0.8;"
                                onclick="navigateGallery(1)">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        
                        <!-- Counter -->
                        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-3 bg-dark bg-opacity-75 text-white px-3 py-1 rounded">
                            <small><span id="currentIndex">1</span> / <span id="totalImages">1</span></small>
                        </div>
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        <p class="mb-0 text-white" id="galleryModalDescription"></p>
                    </div>
                </div>
            </div>
        </div>

        @if($galleries->hasPages())
            <div class="mt-5">
                {{ $galleries->appends(['category' => request('category')])->links() }}
            </div>
        @endif
    </div>
</section>

<style>
.gallery-item:hover .gallery-overlay {
    opacity: 1 !important;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.1);
    transition: transform 0.3s;
}

.gallery-item {
    transition: all 0.3s;
}

.gallery-item:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

#galleryModal .modal-body {
    background: #000;
}

#galleryModal .btn:hover {
    opacity: 1 !important;
}
</style>

<script>
// Gallery data
const galleryData = [
    @foreach($galleries as $gallery)
    {
        image: '{{ asset('storage/' . $gallery->image) }}',
        title: '{{ addslashes($gallery->title) }}',
        description: '{{ addslashes($gallery->description ?? '') }}',
        category: '{{ $gallery->category }}'
    },
    @endforeach
];

let currentGalleryIndex = 0;

function openGalleryModal(index) {
    currentGalleryIndex = index;
    updateGalleryModal();
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
    modal.show();
}

function navigateGallery(direction) {
    currentGalleryIndex += direction;
    
    // Loop around
    if (currentGalleryIndex < 0) {
        currentGalleryIndex = galleryData.length - 1;
    } else if (currentGalleryIndex >= galleryData.length) {
        currentGalleryIndex = 0;
    }
    
    updateGalleryModal();
}

function updateGalleryModal() {
    const data = galleryData[currentGalleryIndex];
    
    // Set image
    document.getElementById('galleryModalImage').src = data.image;
    document.getElementById('galleryModalImage').alt = data.title;
    
    // Set title
    document.getElementById('galleryModalTitle').textContent = data.title;
    
    // Set badge
    const badge = document.getElementById('galleryModalBadge');
    if (data.category === 'interior') {
        badge.className = 'badge bg-primary';
        badge.textContent = 'Interior';
    } else if (data.category === 'exterior') {
        badge.className = 'badge bg-success';
        badge.textContent = 'Exterior';
    } else {
        badge.className = 'badge bg-info';
        badge.textContent = 'Detail';
    }
    
    // Set description
    const descElement = document.getElementById('galleryModalDescription');
    if (data.description) {
        descElement.textContent = data.description;
        descElement.style.display = 'block';
    } else {
        descElement.style.display = 'none';
    }
    
    // Update counter
    document.getElementById('currentIndex').textContent = currentGalleryIndex + 1;
    document.getElementById('totalImages').textContent = galleryData.length;
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('galleryModal');
    if (modal.classList.contains('show')) {
        if (e.key === 'ArrowLeft') {
            navigateGallery(-1);
        } else if (e.key === 'ArrowRight') {
            navigateGallery(1);
        } else if (e.key === 'Escape') {
            bootstrap.Modal.getInstance(modal).hide();
        }
    }
});

// Touch/Swipe support for mobile
let touchStartX = 0;
let touchEndX = 0;

document.getElementById('galleryModal')?.addEventListener('touchstart', function(e) {
    touchStartX = e.changedTouches[0].screenX;
});

document.getElementById('galleryModal')?.addEventListener('touchend', function(e) {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
});

function handleSwipe() {
    if (touchEndX < touchStartX - 50) {
        // Swipe left - next
        navigateGallery(1);
    }
    if (touchEndX > touchStartX + 50) {
        // Swipe right - prev
        navigateGallery(-1);
    }
}
</script>

@endsection
