@extends('layouts.public')

@section('content')

<section class="hero-section position-relative overflow-hidden" style="min-height: 100vh; display: flex; align-items: center; background: #0A2540;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(ellipse at 20% 50%, #1a4a6e 0%, #0A2540 70%); z-index: 0;"></div>
    
    <div class="position-absolute top-0 end-0 w-50 h-100" style="background: radial-gradient(circle at 80% 30%, rgba(79, 195, 247, 0.15) 0%, transparent 60%); z-index: 0; animation: pulse 6s ease-in-out infinite;"></div>
    <div class="position-absolute bottom-0 start-0 w-25 h-50" style="background: radial-gradient(circle at 20% 80%, rgba(79, 195, 247, 0.08) 0%, transparent 60%); z-index: 0; animation: pulse 8s ease-in-out infinite reverse;"></div>
    
    <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden" style="z-index: 0; pointer-events: none;">
        <div class="position-absolute rounded-circle bg-white opacity-10" style="width: 8px; height: 8px; top: 10%; left: 5%; animation: float 8s ease-in-out infinite;"></div>
        <div class="position-absolute rounded-circle bg-white opacity-10" style="width: 12px; height: 12px; top: 20%; right: 10%; animation: float 10s ease-in-out infinite 2s;"></div>
        <div class="position-absolute rounded-circle bg-white opacity-10" style="width: 6px; height: 6px; top: 60%; left: 15%; animation: float 7s ease-in-out infinite 1s;"></div>
        <div class="position-absolute rounded-circle bg-white opacity-10" style="width: 10px; height: 10px; top: 70%; right: 5%; animation: float 9s ease-in-out infinite 3s;"></div>
        <div class="position-absolute rounded-circle bg-white opacity-10" style="width: 4px; height: 4px; top: 40%; left: 30%; animation: float 6s ease-in-out infinite 4s;"></div>
        <div class="position-absolute rounded-circle bg-white opacity-10" style="width: 14px; height: 14px; top: 80%; right: 20%; animation: float 11s ease-in-out infinite 1.5s;"></div>
        <div class="position-absolute rounded-circle bg-white opacity-10" style="width: 5px; height: 5px; top: 15%; left: 60%; animation: float 7s ease-in-out infinite 2.5s;"></div>
    </div>

    <div class="container position-relative z-1 px-4 py-5">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-7" style="animation: fadeInUp 1s ease-out;">
                <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                    <span class="badge bg-white bg-opacity-10 text-white px-4 py-2 rounded-pill" style="backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); font-weight: 500; letter-spacing: 0.5px;">
                        <i class="fas fa-graduation-cap me-2"></i> Fakultas Teknik
                    </span>
                    <span class="badge bg-white bg-opacity-10 text-white px-4 py-2 rounded-pill" style="backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); font-weight: 500; letter-spacing: 0.5px;">
                        <i class="fas fa-star me-2"></i> Akreditasi Unggul
                    </span>
                    <span class="badge bg-white bg-opacity-10 text-white px-4 py-2 rounded-pill" style="backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); font-weight: 500; letter-spacing: 0.5px;">
                        <i class="fas fa-globe-asia me-2"></i> Kampus Merdeka
                    </span>
                </div>

                <h1 class="display-1 fw-bold text-white mb-3" style="letter-spacing: -3px; line-height: 1.05;">
                    Teknik <br>
                    <span style="background: linear-gradient(135deg, #4fc3f7, #81d4fa, #b3e5fc, #4fc3f7); background-size: 300% 300%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; animation: gradientMove 6s ease-in-out infinite;">
                        Informatika
                    </span>
                </h1>
                
                <p class="lead text-white-50 mb-4" style="font-size: 1.25rem; max-width: 550px; line-height: 1.9; letter-spacing: 0.3px;">
                    Menciptakan lulusan yang <strong class="text-white">unggul</strong>, 
                    <strong class="text-white">inovatif</strong>, dan berdaya saing global 
                    di bidang Teknologi Informasi.
                </p>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('beranda.visi-misi') }}" class="btn btn-light rounded-pill px-5 py-3 fw-bold shadow-lg" style="color: #0A2540; transition: all 0.3s;">
                        <i class="fas fa-rocket me-2"></i> Visi & Misi
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill px-5 py-3 fw-bold" style="border-width: 2px; transition: all 0.3s;">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </a>
                </div>

                <div class="d-flex flex-wrap gap-5 mt-5 pt-4 border-top border-white border-opacity-10">
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-user-graduate text-primary"></i>
                            <span class="text-white fw-bold" style="font-size: 2rem; font-weight: 800;">120</span>
                            <span class="text-white-50">+</span>
                        </div>
                        <small class="text-white-50" style="letter-spacing: 0.5px;">MAHASISWA</small>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-chalkboard-user text-success"></i>
                            <span class="text-white fw-bold" style="font-size: 2rem; font-weight: 800;">15</span>
                            <span class="text-white-50">+</span>
                        </div>
                        <small class="text-white-50" style="letter-spacing: 0.5px;">DOSEN</small>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-building text-warning"></i>
                            <span class="text-white fw-bold" style="font-size: 2rem; font-weight: 800;">25</span>
                            <span class="text-white-50">+</span>
                        </div>
                        <small class="text-white-50" style="letter-spacing: 0.5px;">MITRA</small>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-trophy text-info"></i>
                            <span class="text-white fw-bold" style="font-size: 2rem; font-weight: 800;">10</span>
                            <span class="text-white-50">+</span>
                        </div>
                        <small class="text-white-50" style="letter-spacing: 0.5px;">PRESTASI</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 d-none d-lg-block" style="animation: fadeInRight 1s ease-out;">
                <div class="position-relative">
                    <div class="bg-white bg-opacity-10 rounded-5 p-5 text-center" style="backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.08); box-shadow: 0 30px 80px rgba(0,0,0,0.3);">
                        <div class="mb-4 position-relative">
                            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at center, rgba(79,195,247,0.2), transparent 70%);"></div>
                            <i class="fas fa-laptop-code text-white" style="font-size: 120px; opacity: 0.9; position: relative; z-index: 1;"></i>
                        </div>
                        <h5 class="text-white fw-light" style="letter-spacing: 1px;">"Membangun Generasi Digital"</h5>
                        <div class="d-flex flex-wrap justify-content-center gap-2 mt-4">
                            <span class="badge bg-white bg-opacity-10 text-white rounded-pill px-3 py-2" style="border: 1px solid rgba(255,255,255,0.05);">#AI</span>
                            <span class="badge bg-white bg-opacity-10 text-white rounded-pill px-3 py-2" style="border: 1px solid rgba(255,255,255,0.05);">#DataScience</span>
                            <span class="badge bg-white bg-opacity-10 text-white rounded-pill px-3 py-2" style="border: 1px solid rgba(255,255,255,0.05);">#CyberSecurity</span>
                            <span class="badge bg-white bg-opacity-10 text-white rounded-pill px-3 py-2" style="border: 1px solid rgba(255,255,255,0.05);">#Cloud</span>
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
            <span class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill mb-3">STATISTIK</span>
            <h2 class="fw-bold" style="color: #0A2540;">Capaian <span class="text-primary">Kami</span></h2>
            <p class="text-muted">Data yang menunjukkan komitmen kami terhadap pendidikan berkualitas</p>
        </div>
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 text-center h-100 hover-card" style="transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                    <div class="card-body p-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; transition: all 0.3s;">
                            <i class="fas fa-users text-primary fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-primary mb-0" style="font-size: 2.8rem; font-weight: 800;">120+</h2>
                        <small class="text-muted fw-semibold">Mahasiswa Aktif</small>
                        <div class="mt-3">
                            <div class="progress" style="height: 4px; border-radius: 4px;">
                                <div class="progress-bar bg-primary" style="width: 85%; border-radius: 4px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 text-center h-100 hover-card" style="transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                    <div class="card-body p-4">
                        <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; transition: all 0.3s;">
                            <i class="fas fa-chalkboard-user text-success fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-success mb-0" style="font-size: 2.8rem; font-weight: 800;">15+</h2>
                        <small class="text-muted fw-semibold">Dosen Profesional</small>
                        <div class="mt-3">
                            <div class="progress" style="height: 4px; border-radius: 4px;">
                                <div class="progress-bar bg-success" style="width: 70%; border-radius: 4px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 text-center h-100 hover-card" style="transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                    <div class="card-body p-4">
                        <div class="rounded-circle bg-warning bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; transition: all 0.3s;">
                            <i class="fas fa-building text-warning fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-warning mb-0" style="font-size: 2.8rem; font-weight: 800;">25+</h2>
                        <small class="text-muted fw-semibold">Mitra Industri</small>
                        <div class="mt-3">
                            <div class="progress" style="height: 4px; border-radius: 4px;">
                                <div class="progress-bar bg-warning" style="width: 60%; border-radius: 4px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 text-center h-100 hover-card" style="transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                    <div class="card-body p-4">
                        <div class="rounded-circle bg-info bg-opacity-10 d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; transition: all 0.3s;">
                            <i class="fas fa-trophy text-info fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-info mb-0" style="font-size: 2.8rem; font-weight: 800;">10+</h2>
                        <small class="text-muted fw-semibold">Prestasi Nasional</small>
                        <div class="mt-3">
                            <div class="progress" style="height: 4px; border-radius: 4px;">
                                <div class="progress-bar bg-info" style="width: 50%; border-radius: 4px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container px-4">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <div class="badge bg-primary bg-opacity-10 text-primary p-2 rounded">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <h5 class="fw-bold mb-0" style="color: #0A2540;">Tentang Prodi</h5>
                            <span class="ms-auto badge bg-primary rounded-pill">2026</span>
                        </div>
                        <p class="text-muted" style="line-height: 2;">
                            Program Studi <strong>Teknik Informatika</strong> Universitas Nugraha 
                            didirikan untuk memenuhi kebutuhan tenaga profesional di bidang 
                            <strong>teknologi informasi</strong> yang semakin pesat perkembangannya.
                        </p>
                        <p class="text-muted" style="line-height: 2;">
                            Kurikulum dirancang mengacu pada kebutuhan <strong>Industri 4.0</strong> 
                            dan <strong>Society 5.0</strong>, dengan fokus pada pengembangan 
                            kemampuan analisis, perancangan, dan implementasi sistem informasi modern.
                        </p>
                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">#AI</span>
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">#DataScience</span>
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">#CyberSecurity</span>
                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">#MobileDev</span>
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">#CloudComputing</span>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">#IoT</span>
                        </div>
                    </div>
                    <div class="card-footer border-0 px-5 py-3" style="background: #0A2540;">
                        <small class="text-white"><i class="fas fa-check-circle text-white me-1"></i> Terakreditasi BAN-PT</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <div class="badge bg-success bg-opacity-10 text-success p-2 rounded">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <h5 class="fw-bold mb-0" style="color: #0A2540;">Berita Terbaru</h5>
                            <span class="ms-auto badge bg-success rounded-pill">Update</span>
                        </div>
                        <div class="berita-list">
                            <div class="d-flex gap-3 mb-4 pb-3 border-bottom">
                                <div class="flex-shrink-0">
                                    <div class="text-center bg-primary bg-opacity-10 rounded-3 px-3 py-2">
                                        <div class="fw-bold text-primary" style="font-size: 1.2rem;">15</div>
                                        <small class="text-muted" style="font-size: 0.6rem; text-transform: uppercase;">JUN</small>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Wisuda Sarjana Periode 2025</h6>
                                    <p class="text-muted small mb-0">Selamat kepada para wisudawan yang telah menyelesaikan studinya.</p>
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill mt-1">Acara</span>
                                </div>
                            </div>
                            <div class="d-flex gap-3 mb-4 pb-3 border-bottom">
                                <div class="flex-shrink-0">
                                    <div class="text-center bg-success bg-opacity-10 rounded-3 px-3 py-2">
                                        <div class="fw-bold text-success" style="font-size: 1.2rem;">10</div>
                                        <small class="text-muted" style="font-size: 0.6rem; text-transform: uppercase;">JUN</small>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Webinar Kecerdasan Buatan</h6>
                                    <p class="text-muted small mb-0">Daftar segera! Kuota terbatas untuk 100 peserta.</p>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill mt-1">Webinar</span>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <div class="flex-shrink-0">
                                    <div class="text-center bg-warning bg-opacity-10 rounded-3 px-3 py-2">
                                        <div class="fw-bold text-warning" style="font-size: 1.2rem;">05</div>
                                        <small class="text-muted" style="font-size: 0.6rem; text-transform: uppercase;">JUN</small>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">Magang di PT Digital Inovasi</h6>
                                    <p class="text-muted small mb-0">Buka pendaftaran magang untuk mahasiswa semester 6.</p>
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill mt-1">Magang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: linear-gradient(135deg, #f7f9fc 0%, #edf2f7 100%);">
    <div class="container px-4">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="row g-0">
                <div class="col-lg-6 p-5" style="background: #ffffff;">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="badge bg-primary bg-opacity-10 text-primary p-2 rounded">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h5 class="fw-bold mb-0" style="color: #0A2540;">Hubungi Kami</h5>
                    </div>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        Kami siap membantu Anda. Hubungi kami melalui kontak di bawah ini.
                    </p>
                    <div class="d-flex gap-3 mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-0">Alamat</h6>
                            <small class="text-muted">Jl. Pasir Gede Raya, Cianjur - Jawa Barat</small>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="fas fa-phone-alt text-success"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-0">Telepon</h6>
                            <small class="text-muted">(0263) 283578</small>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="fas fa-envelope text-warning"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-0">Email</h6>
                            <small class="text-muted">informatika@nugraha.ac.id</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-5 text-white" style="background: linear-gradient(135deg, #0A2540 0%, #1a4a6e 100%);">
                    <div class="h-100 d-flex flex-column justify-content-center align-items-center text-center">
                        <i class="fas fa-university" style="font-size: 80px; opacity: 0.3;"></i>
                        <h4 class="fw-light mt-3">Universitas Nugraha</h4>
                        <p class="text-white-50 small" style="letter-spacing: 1px;">Membangun Generasi Unggul</p>
                        <div class="d-flex flex-wrap justify-content-center gap-3 mt-3">
                            <span class="badge bg-white bg-opacity-10 text-white rounded-pill px-4 py-2">#KampusMerdeka</span>
                            <span class="badge bg-white bg-opacity-10 text-white rounded-pill px-4 py-2">#Informatika</span>
                            <span class="badge bg-white bg-opacity-10 text-white rounded-pill px-4 py-2">#Digital</span>
                        </div>
                        <div class="d-flex gap-3 mt-4">
                            <i class="fab fa-instagram text-white-50" style="font-size: 20px; cursor: pointer;"></i>
                            <i class="fab fa-youtube text-white-50" style="font-size: 20px; cursor: pointer;"></i>
                            <i class="fab fa-linkedin text-white-50" style="font-size: 20px; cursor: pointer;"></i>
                            <i class="fab fa-twitter text-white-50" style="font-size: 20px; cursor: pointer;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div style="height: 30px;"></div>

<style>
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInRight {
    from { opacity: 0; transform: translateX(40px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.1); opacity: 0.6; }
}
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}
@keyframes gradientMove {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}
.hover-card {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.hover-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 60px rgba(0,0,0,0.1) !important;
}
.hover-card:hover .rounded-circle {
    transform: scale(1.1);
}
.btn-light:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(255,255,255,0.2) !important;
}
.btn-outline-light:hover {
    transform: translateY(-2px);
    background: rgba(255,255,255,0.1);
}
.berita-list .border-bottom {
    border-color: rgba(0,0,0,0.05) !important;
}
</style>

@endsection