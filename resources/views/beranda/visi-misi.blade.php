@extends('layouts.public')

@section('content')

<section class="hero-section position-relative overflow-hidden" style="min-height: 40vh; display: flex; align-items: center; background: linear-gradient(135deg, #0A2540 0%, #1a4a6e 100%);">
    <div class="container position-relative z-1 px-4 py-5">
        <div class="row justify-content-center text-center">
            <div class="col-12 col-lg-8">
                <h1 class="display-3 fw-bold text-white mb-2" style="letter-spacing: -1px;">
                    Visi & <span style="color: #4fc3f7;">Misi</span>
                </h1>
                <p class="text-white-50" style="font-size: 1.1rem; letter-spacing: 1px;">Program Studi Teknik Informatika</p>
                <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                    <a href="{{ route('beranda') }}" class="btn btn-outline-light rounded-pill px-4 py-2" style="font-size: 0.85rem; border-width: 1.5px; transition: all 0.3s;">
                        <i class="fas fa-arrow-left me-2"></i> Kembali Ke Beranda
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-light rounded-pill px-4 py-2" style="font-size: 0.85rem; color: #0A2540; font-weight: 600; transition: all 0.3s;">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </a>
                </div>
                <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                    <span class="badge bg-white bg-opacity-10 text-white px-3 py-1 rounded-pill" style="font-size: 0.7rem;">#Informatika</span>
                    <span class="badge bg-white bg-opacity-10 text-white px-3 py-1 rounded-pill" style="font-size: 0.7rem;">#Digital</span>
                    <span class="badge bg-white bg-opacity-10 text-white px-3 py-1 rounded-pill" style="font-size: 0.7rem;">#Inovasi</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: #f7f9fc;">
    <div class="container px-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold" style="color: #0A2540;">Visi</h2>
                            <div class="mx-auto" style="width: 50px; height: 3px; background: #0A2540; border-radius: 3px;"></div>
                        </div>
                        <div class="p-3 p-md-4 text-center" style="background: #ffffff; border-radius: 12px; border: 1px solid #edf2f7;">
                            <p class="lead fw-light" style="font-size: 1.05rem; color: #2d3748; max-width: 900px; margin: 0 auto; line-height: 2;">
                                Menjadi Program Studi Teknik Informatika yang <strong style="color: #0A2540;">unggul</strong> dan <strong style="color: #0A2540;">inovatif</strong> dalam pengembangan teknologi digital berkelanjutan untuk mendukung transformasi digital nasional pada tahun <strong style="color: #0A2540;">2030</strong>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: #f7f9fc;">
    <div class="container px-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #0A2540;">Misi</h2>
            <div class="mx-auto" style="width: 50px; height: 3px; background: #0A2540; border-radius: 3px;"></div>
            <p class="text-muted mt-2" style="font-size: 0.9rem;">Enam pilar utama program studi</p>
        </div>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 d-flex gap-3 align-items-start">
                        <span class="fw-bold text-primary" style="font-size: 1.5rem; min-width: 36px;">01</span>
                        <div>
                            <h6 class="fw-bold mb-1" style="color: #0A2540;">Pendidikan Berkualitas</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.7;">Menyelenggarakan pendidikan adaptif terhadap perkembangan teknologi informasi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 d-flex gap-3 align-items-start">
                        <span class="fw-bold text-success" style="font-size: 1.5rem; min-width: 36px;">02</span>
                        <div>
                            <h6 class="fw-bold mb-1" style="color: #0A2540;">Penelitian Inovatif</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.7;">Penelitian relevan dengan kebutuhan industri dan kontribusi bagi masyarakat.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 d-flex gap-3 align-items-start">
                        <span class="fw-bold text-warning" style="font-size: 1.5rem; min-width: 36px;">03</span>
                        <div>
                            <h6 class="fw-bold mb-1" style="color: #0A2540;">Pengabdian Masyarakat</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.7;">Implementasi hasil penelitian untuk memecahkan masalah sosial dan ekonomi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 d-flex gap-3 align-items-start">
                        <span class="fw-bold text-info" style="font-size: 1.5rem; min-width: 36px;">04</span>
                        <div>
                            <h6 class="fw-bold mb-1" style="color: #0A2540;">Kemitraan Strategis</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.7;">Jaringan kerjasama dengan industri, pemerintah, dan institusi lain.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 d-flex gap-3 align-items-start">
                        <span class="fw-bold text-danger" style="font-size: 1.5rem; min-width: 36px;">05</span>
                        <div>
                            <h6 class="fw-bold mb-1" style="color: #0A2540;">Sumber Daya Unggul</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.7;">Pengembangan SDM dan sarana prasarana pembelajaran modern.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 d-flex gap-3 align-items-start">
                        <span class="fw-bold text-secondary" style="font-size: 1.5rem; min-width: 36px;">06</span>
                        <div>
                            <h6 class="fw-bold mb-1" style="color: #0A2540;">Tata Kelola Profesional</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.7;">Sistem manajemen transparan, akuntabel, dan berorientasi mutu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-4" style="background: #f7f9fc;">
    <div class="container px-4">
        <div class="card border-0 shadow-sm rounded-4" style="background: #0A2540;">
            <div class="card-body p-4 text-center text-white">
                <h6 class="fw-bold mb-2">Tujuan</h6>
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <span class="badge bg-white bg-opacity-10 text-white px-3 py-2 rounded-pill" style="font-weight: 400; font-size: 0.75rem;">Lulusan Kompeten</span>
                    <span class="badge bg-white bg-opacity-10 text-white px-3 py-2 rounded-pill" style="font-weight: 400; font-size: 0.75rem;">Publikasi Ilmiah</span>
                    <span class="badge bg-white bg-opacity-10 text-white px-3 py-2 rounded-pill" style="font-weight: 400; font-size: 0.75rem;">Akreditasi Unggul</span>
                    <span class="badge bg-white bg-opacity-10 text-white px-3 py-2 rounded-pill" style="font-weight: 400; font-size: 0.75rem;">Kurikulum Industri 4.0</span>
                    <span class="badge bg-white bg-opacity-10 text-white px-3 py-2 rounded-pill" style="font-weight: 400; font-size: 0.75rem;">Kerjasama Industri</span>
                    <span class="badge bg-white bg-opacity-10 text-white px-3 py-2 rounded-pill" style="font-weight: 400; font-size: 0.75rem;">Kepuasan Stakeholder</span>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.btn-outline-light:hover {
    background: rgba(255,255,255,0.15);
    transform: translateY(-2px);
}
.btn-light:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255,255,255,0.2);
}
@media (max-width: 768px) {
    .display-3 { font-size: 2rem; }
    .lead { font-size: 1rem; }
}
</style>

@endsection