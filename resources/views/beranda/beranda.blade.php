@extends('layouts.public')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">Beranda</h4>
            <p class="text-muted small mb-0">Fakultas Teknik - Universitas Nugraha</p>
        </div>
        <div class="text-end">
            <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
        <div class="row g-0">
            <div class="col-md-8">
                <div class="card-body p-5">
                    <h1 class="display-5 fw-bold text-primary mb-3">Teknik Informatika</h1>
                    <p class="lead mb-4">Menciptakan lulusan yang unggul, inovatif, dan berdaya saing global di bidang Teknologi Informasi.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('beranda.visi-misi') }}" class="btn btn-primary rounded-pill px-4">Visi & Misi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 bg-primary bg-opacity-10 d-flex align-items-center justify-content-center p-4">
                <i class="fas fa-laptop-code fa-5x text-primary opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 text-center">
                <div class="card-body p-4">
                    <i class="fas fa-users fa-2x text-primary mb-2"></i>
                    <h2 class="fw-bold mb-0">120+</h2>
                    <small class="text-muted">Mahasiswa Aktif</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 text-center">
                <div class="card-body p-4">
                    <i class="fas fa-chalkboard-user fa-2x text-success mb-2"></i>
                    <h2 class="fw-bold mb-0">15+</h2>
                    <small class="text-muted">Dosen Profesional</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 text-center">
                <div class="card-body p-4">
                    <i class="fas fa-building fa-2x text-warning mb-2"></i>
                    <h2 class="fw-bold mb-0">25+</h2>
                    <small class="text-muted">Mitra Industri</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 text-center">
                <div class="card-body p-4">
                    <i class="fas fa-trophy fa-2x text-info mb-2"></i>
                    <h2 class="fw-bold mb-0">10+</h2>
                    <small class="text-muted">Prestasi Nasional</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Info & Galeri -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                    <h6 class="fw-semibold mb-0">
                        <i class="fas fa-info-circle me-2 text-primary"></i>Sekilas Tentang Prodi
                    </h6>
                </div>
                <div class="card-body p-4">
                    <p>Program Studi Teknik Informatika Universitas Nugraha didirikan untuk memenuhi kebutuhan tenaga profesional di bidang teknologi informasi yang semakin pesat perkembangannya.</p>
                    <p>Kurikulum yang dirancang mengacu pada kebutuhan industri 4.0 dan society 5.0, dengan fokus pada pengembangan kemampuan analisis, perancangan, dan implementasi sistem informasi modern.</p>
                    <div class="mt-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 me-2">#AI</span>
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 me-2">#DataScience</span>
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 me-2">#CyberSecurity</span>
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">#MobileDev</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                    <h6 class="fw-semibold mb-0">
                        <i class="fas fa-newspaper me-2 text-primary"></i>Berita Terbaru
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex gap-3 mb-3 pb-2 border-bottom">
                        <i class="fas fa-calendar-alt text-muted"></i>
                        <div>
                            <div class="fw-semibold">Wisuda Sarjana Periode 2025</div>
                            <small class="text-muted">15 Juni 2025</small>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-3 pb-2 border-bottom">
                        <i class="fas fa-calendar-alt text-muted"></i>
                        <div>
                            <div class="fw-semibold">Webinar Kecerdasan Buatan</div>
                            <small class="text-muted">10 Juni 2025</small>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-3 pb-2 border-bottom">
                        <i class="fas fa-calendar-alt text-muted"></i>
                        <div>
                            <div class="fw-semibold">Magang di PT Digital Inovasi</div>
                            <small class="text-muted">5 Juni 2025</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kontak -->
    <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-body p-4">
            <div class="row text-center">
                <div class="col-md-4">
                    <i class="fas fa-map-marker-alt fa-2x text-primary mb-2"></i>
                    <h6 class="fw-semibold">Alamat</h6>
                    <small class="text-muted">Jl. Pasir Gede Raya, Cianjur - Jawa Barat</small>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-phone-alt fa-2x text-primary mb-2"></i>
                    <h6 class="fw-semibold">Telepon</h6>
                    <small class="text-muted">(0263) 283578</small>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-envelope fa-2x text-primary mb-2"></i>
                    <h6 class="fw-semibold">Email</h6>
                    <small class="text-muted">informatika@nugraha.ac.id</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection