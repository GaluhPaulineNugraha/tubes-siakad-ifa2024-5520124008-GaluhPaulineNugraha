@extends('layouts.public')

@section('content')
<div class="container">
    <!-- Tombol Kembali di Atas -->
    <div class="mb-4">
        <a href="{{ route('beranda') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
        </a>
    </div>

    <!-- Header -->
    <div class="text-center mb-5">
        <h2 class="fw-light" style="color: #1a2a3a; letter-spacing: 2px;">Visi & Misi</h2>
        <div class="mx-auto" style="width: 50px; height: 3px; background: #1a2a3a; margin: 12px auto;"></div>
        <p class="text-muted small" style="letter-spacing: 1px;">Program Studi Teknik Informatika</p>
    </div>

    <!-- Visi -->
    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-body p-5 text-center">
            <h6 class="text-uppercase text-muted small fw-semibold mb-3" style="letter-spacing: 2px;">Visi</h6>
            <p class="lead fw-light" style="font-size: 1.2rem; color: #2d3748; max-width: 850px; margin: 0 auto; line-height: 1.9;">
                Menjadi Program Studi Teknik Informatika yang unggul dan inovatif dalam pengembangan teknologi digital berkelanjutan untuk mendukung transformasi digital nasional pada tahun 2030.
            </p>
        </div>
    </div>

    <!-- Misi -->
    <div class="mb-5">
        <h6 class="text-uppercase text-muted small fw-semibold text-center mb-4" style="letter-spacing: 2px;">Misi</h6>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 d-flex gap-3 align-items-start">
                        <span style="color: #1a2a3a; font-weight: 300; font-size: 1.1rem; min-width: 28px;">01</span>
                        <div>
                            <h6 class="fw-semibold mb-1" style="color: #1a2a3a;">Pendidikan Berkualitas</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.7;">Menyelenggarakan pendidikan yang adaptif terhadap perkembangan teknologi informasi untuk menghasilkan lulusan kompeten.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 d-flex gap-3 align-items-start">
                        <span style="color: #1a2a3a; font-weight: 300; font-size: 1.1rem; min-width: 28px;">02</span>
                        <div>
                            <h6 class="fw-semibold mb-1" style="color: #1a2a3a;">Penelitian Inovatif</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.7;">Melakukan penelitian yang relevan dengan kebutuhan industri dan memberikan kontribusi nyata bagi masyarakat.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 d-flex gap-3 align-items-start">
                        <span style="color: #1a2a3a; font-weight: 300; font-size: 1.1rem; min-width: 28px;">03</span>
                        <div>
                            <h6 class="fw-semibold mb-1" style="color: #1a2a3a;">Pengabdian Masyarakat</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.7;">Mengimplementasikan hasil penelitian dan pengembangan teknologi untuk memecahkan masalah sosial dan ekonomi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 d-flex gap-3 align-items-start">
                        <span style="color: #1a2a3a; font-weight: 300; font-size: 1.1rem; min-width: 28px;">04</span>
                        <div>
                            <h6 class="fw-semibold mb-1" style="color: #1a2a3a;">Kemitraan Strategis</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.7;">Membangun jaringan kerjasama dengan industri, pemerintah, dan institusi lain untuk pengembangan program studi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 d-flex gap-3 align-items-start">
                        <span style="color: #1a2a3a; font-weight: 300; font-size: 1.1rem; min-width: 28px;">05</span>
                        <div>
                            <h6 class="fw-semibold mb-1" style="color: #1a2a3a;">Sumber Daya Unggul</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.7;">Mengembangkan sumber daya manusia dan sarana prasarana yang mendukung proses pembelajaran modern.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 d-flex gap-3 align-items-start">
                        <span style="color: #1a2a3a; font-weight: 300; font-size: 1.1rem; min-width: 28px;">06</span>
                        <div>
                            <h6 class="fw-semibold mb-1" style="color: #1a2a3a;">Tata Kelola Profesional</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.7;">Menerapkan sistem manajemen yang transparan, akuntabel, dan berorientasi pada peningkatan mutu berkelanjutan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tujuan -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 text-center">
            <h6 class="text-uppercase text-muted small fw-semibold mb-3" style="letter-spacing: 2px;">Tujuan</h6>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <span class="text-muted small" style="letter-spacing: 0.5px;">Lulusan Kompeten</span>
                        <span class="text-muted" style="color: #d1d5db;">|</span>
                        <span class="text-muted small" style="letter-spacing: 0.5px;">Publikasi Ilmiah</span>
                        <span class="text-muted" style="color: #d1d5db;">|</span>
                        <span class="text-muted small" style="letter-spacing: 0.5px;">Akreditasi Unggul</span>
                        <span class="text-muted" style="color: #d1d5db;">|</span>
                        <span class="text-muted small" style="letter-spacing: 0.5px;">Kurikulum Industri 4.0</span>
                        <span class="text-muted" style="color: #d1d5db;">|</span>
                        <span class="text-muted small" style="letter-spacing: 0.5px;">Kerjasama Industri</span>
                        <span class="text-muted" style="color: #d1d5db;">|</span>
                        <span class="text-muted small" style="letter-spacing: 0.5px;">Kepuasan Stakeholder</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection