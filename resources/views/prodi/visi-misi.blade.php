@extends('layouts.public')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">Visi & Misi</h4>
            <p class="text-muted small mb-0">Program Studi Teknik Informatika</p>
        </div>
        <div class="text-end">
            <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
        </div>
    </div>

    <!-- Visi -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-5 text-center">
            <i class="fas fa-eye fa-3x text-primary mb-3"></i>
            <h2 class="fw-bold mb-3">Visi</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p class="lead" style="font-size: 1.25rem;">
                        "Menjadi Program Studi Teknik Informatika yang unggul dan inovatif dalam pengembangan teknologi digital berkelanjutan untuk mendukung transformasi digital nasional pada tahun 2030."
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Misi -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h2 class="fw-bold mb-4 text-center">
                <i class="fas fa-bullseye me-2 text-success"></i>Misi
            </h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="d-flex gap-3 p-3 border rounded-3 h-100">
                        <div>
                            <span class="badge bg-primary rounded-circle p-3">1</span>
                        </div>
                        <div>
                            <h6 class="fw-semibold">Pendidikan Berkualitas</h6>
                            <p class="text-muted small mb-0">Menyelenggarakan pendidikan yang adaptif terhadap perkembangan teknologi informasi untuk menghasilkan lulusan kompeten.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-3 p-3 border rounded-3 h-100">
                        <div>
                            <span class="badge bg-primary rounded-circle p-3">2</span>
                        </div>
                        <div>
                            <h6 class="fw-semibold">Penelitian Inovatif</h6>
                            <p class="text-muted small mb-0">Melakukan penelitian yang relevan dengan kebutuhan industri dan memberikan kontribusi nyata bagi masyarakat.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-3 p-3 border rounded-3 h-100">
                        <div>
                            <span class="badge bg-primary rounded-circle p-3">3</span>
                        </div>
                        <div>
                            <h6 class="fw-semibold">Pengabdian Masyarakat</h6>
                            <p class="text-muted small mb-0">Mengimplementasikan hasil penelitian dan pengembangan teknologi untuk memecahkan masalah sosial dan ekonomi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-3 p-3 border rounded-3 h-100">
                        <div>
                            <span class="badge bg-primary rounded-circle p-3">4</span>
                        </div>
                        <div>
                            <h6 class="fw-semibold">Kemitraan Strategis</h6>
                            <p class="text-muted small mb-0">Membangun jaringan kerjasama dengan industri, pemerintah, dan institusi lain untuk pengembangan program studi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-3 p-3 border rounded-3 h-100">
                        <div>
                            <span class="badge bg-primary rounded-circle p-3">5</span>
                        </div>
                        <div>
                            <h6 class="fw-semibold">Sumber Daya Unggul</h6>
                            <p class="text-muted small mb-0">Mengembangkan sumber daya manusia dan sarana prasarana yang mendukung proses pembelajaran modern.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-3 p-3 border rounded-3 h-100">
                        <div>
                            <span class="badge bg-primary rounded-circle p-3">6</span>
                        </div>
                        <div>
                            <h6 class="fw-semibold">Tata Kelola Profesional</h6>
                            <p class="text-muted small mb-0">Menerapkan sistem manajemen yang transparan, akuntabel, dan berorientasi pada peningkatan mutu berkelanjutan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tujuan -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h2 class="fw-bold mb-4 text-center">
                <i class="fas fa-flag-checkered me-2 text-warning"></i>Tujuan
            </h2>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Menghasilkan lulusan yang siap bersaing di pasar kerja global.
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Meningkatkan jumlah publikasi ilmiah di jurnal internasional.
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Mewujudkan program studi berakreditasi unggul.
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Mengembangkan kurikulum berbasis industri 4.0.
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Memperluas kerjasama dengan perusahaan teknologi.
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Meningkatkan kepuasan pengguna lulusan (stakeholder).
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection