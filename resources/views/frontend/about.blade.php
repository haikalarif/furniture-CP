@extends('layouts.frontend')

@section('title', 'About - KalKayu Living')

@section('content')

<section class="bg-light" style="padding: 8rem 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <h2 class="fw-bold mb-3">About</h2>
                    <div class="mx-auto" style="width: 100px; height: 4px; background-color: var(--bs-primary);"></div>
                </div>

                @if($aboutPage)
                    <div class="card shadow-sm border-0 mb-4 p-4 p-md-5">
                        <h4 class="fw-bold mb-4">{{ $aboutPage->title }}</h4>
                        <div class="fs-6 text-muted lh-lg">
                            {!! nl2br(e($aboutPage->content)) !!}
                        </div>
                    </div>
                @else
                    <div class="card shadow-sm border-0 mb-4 p-4 p-md-5">
                        <h4 class="h3 fw-bold mb-4">KalKayu Living</h4>
                        <div class="fs-6 text-muted lh-lg">
                            <p>
                                KalKayu Living adalah perusahaan furniture custom premium yang berfokus pada desain minimalis modern dengan material berkualitas tinggi. Kami berkomitmen menghadirkan furniture yang tidak hanya indah, tetapi juga fungsional dan tahan lama.
                            </p>
                            <p>
                                Dengan pengalaman bertahun-tahun di industri furniture, kami memahami kebutuhan setiap klien untuk menciptakan ruang yang nyaman dan estetis. Setiap produk kami dibuat dengan perhatian detail dan craftsmanship yang tinggi.
                            </p>
                            <p>
                                Kami menggunakan material pilihan seperti kayu jati, mahoni, dan material premium lainnya untuk memastikan kualitas dan ketahanan produk kami.
                            </p>
                        </div>
                    </div>
                @endif

                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" 
                                 style="width: 65px; height: 65px;">
                                <i class="fas fa-award text-light fs-3"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Kualitas Premium</h5>
                            <p class="text-muted mb-0">Material berkualitas tinggi dan craftsmanship terbaik</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" 
                                 style="width: 65px; height: 65px;">
                                <i class="fas fa-pencil-ruler text-light fs-3"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Desain Custom</h5>
                            <p class="text-muted mb-0">Sesuaikan dengan kebutuhan dan selera Anda</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" 
                                 style="width: 65px; height: 65px;">
                                <i class="fas fa-handshake text-light fs-3"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Pelayanan Terbaik</h5>
                            <p class="text-muted mb-0">Konsultasi gratis dan after-sales support</p>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('contact') }}" 
                       class="btn btn-primary btn-md px-5">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
