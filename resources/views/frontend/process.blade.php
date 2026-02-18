@extends('layouts.frontend')

@section('title', 'Process - KalKayu Living')

@section('content')

<section class="bg-light" style="padding: 8rem 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <h2 class="fw-bold mb-3">Proses Pengerjaan</h2>
                    <p class="text-muted">Dari konsultasi hingga instalasi, kami pastikan semuanya sempurna</p>
                </div>

                <!-- @if($processPage)
                    <div class="card shadow-sm border-0 mb-4 p-4 p-md-5">
                        <div class="fs-5 text-muted lh-lg">
                            {!! nl2br(e($processPage->content)) !!}
                        </div>
                    </div>
                @endif -->

                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <div class="card shadow-sm border-0 p-4">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-4" 
                                     style="width: 60px; height: 60px;">
                                    <span class="fs-4 fw-bold">1</span>
                                </div>
                                <div>
                                    <h3 class="h4 fw-bold mb-2">Konsultasi & Desain</h3>
                                    <p class="text-muted mb-0 lh-lg" style="text-align: justify;">
                                        Kami mulai dengan memahami kebutuhan dan preferensi Anda. Tim desainer kami akan membuat sketsa dan visualisasi 3D untuk memastikan desain sesuai dengan keinginan Anda.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card shadow-sm border-0 p-4">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-4" 
                                     style="width: 60px; height: 60px;">
                                    <span class="fs-4 fw-bold">2</span>
                                </div>
                                <div>
                                    <h3 class="h4 fw-bold mb-2">Pemilihan Material</h3>
                                    <p class="text-muted mb-0 lh-lg" style="text-align: justify;">
                                        Kami membantu Anda memilih material terbaik sesuai budget dan kebutuhan. Semua material kami pilih dengan teliti untuk memastikan kualitas dan ketahanan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <div class="card shadow-sm border-0 p-4">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-4" 
                                     style="width: 60px; height: 60px;">
                                    <span class="fs-4 fw-bold">3</span>
                                </div>
                                <div>
                                    <h3 class="h4 fw-bold mb-2">Produksi</h3>
                                    <p class="text-muted mb-0 lh-lg" style="text-align: justify;">
                                        Proses produksi dilakukan oleh craftsman berpengalaman dengan perhatian detail yang tinggi. Kami update progress secara berkala agar Anda selalu tahu perkembangan pesanan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card shadow-sm border-0 p-4">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-4" 
                                     style="width: 60px; height: 60px;">
                                    <span class="fs-4 fw-bold">4</span>
                                </div>
                                <div>
                                    <h3 class="h4 fw-bold mb-2">Quality Control</h3>
                                    <p class="text-muted mb-0 lh-lg" style="text-align: justify;">
                                        Setiap produk melalui quality control ketat sebelum dikirim. Kami pastikan tidak ada cacat dan semua detail sesuai dengan desain yang disetujui.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <div class="card shadow-sm border-0 p-4">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-4" 
                                     style="width: 60px; height: 60px;">
                                    <span class="fs-4 fw-bold">5</span>
                                </div>
                                <div>
                                    <h3 class="h4 fw-bold mb-3">Pengiriman & Instalasi</h3>
                                    <p class="text-muted mb-0 lh-lg" style="text-align: justify;">
                                        Kami handle pengiriman dengan hati-hati dan melakukan instalasi profesional di lokasi Anda. Tim kami memastikan furniture terpasang dengan sempurna dan siap digunakan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-primary text-white shadow-sm border-0 text-center p-5 mt-5">
                    <h3 class="h4 fw-bold mb-3">Siap Memulai Project Anda?</h3>
                    <p class="fs-6 mb-4 opacity-75">Konsultasikan kebutuhan furniture Anda dengan tim kami</p>
                    <div>
                        <a href="{{ route('contact') }}" class="btn btn-light btn-md px-3 px-md-5">
                            Hubungi Kami Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
