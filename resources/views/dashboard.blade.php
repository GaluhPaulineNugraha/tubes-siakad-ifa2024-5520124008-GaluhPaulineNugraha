@extends('layouts.app')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h4 class="mb-1 fw-semibold">Dashboard</h4>
            <p class="text-muted small mb-0">Selamat datang, <strong>Admin</strong></p>
        </div>
        <div class="text-start text-md-end">
            <button onclick="window.print()" class="btn btn-danger btn-sm rounded-pill">
                <i class="fas fa-file-pdf me-1"></i> Export PDF
            </button>
            <small class="text-muted d-block d-md-inline mt-1 mt-md-0 ms-md-2">{{ now()->format('l, d F Y') }}</small>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-2 g-md-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase" style="font-size: 10px;">Total Dosen</small>
                            <h2 class="mb-0 fw-bold mt-1" style="font-size: 1.5rem;">{{ number_format($totalDosen ?? 0) }}</h2>
                        </div>
                        <div class="rounded-3 p-2 p-md-3" style="background: #e8f0fe;">
                            <i class="fas fa-chalkboard-user fa-1x fa-md-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase" style="font-size: 10px;">Total Mahasiswa</small>
                            <h2 class="mb-0 fw-bold mt-1" style="font-size: 1.5rem;">{{ number_format($totalMahasiswa ?? 0) }}</h2>
                        </div>
                        <div class="rounded-3 p-2 p-md-3" style="background: #e6f4ea;">
                            <i class="fas fa-users fa-1x fa-md-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase" style="font-size: 10px;">Mata Kuliah</small>
                            <h2 class="mb-0 fw-bold mt-1" style="font-size: 1.5rem;">{{ number_format($totalMatakuliah ?? 0) }}</h2>
                        </div>
                        <div class="rounded-3 p-2 p-md-3" style="background: #fef3e6;">
                            <i class="fas fa-book fa-1x fa-md-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase" style="font-size: 10px;">Pengambilan KRS</small>
                            <h2 class="mb-0 fw-bold mt-1" style="font-size: 1.5rem;">{{ number_format($totalKRS ?? 0) }}</h2>
                        </div>
                        <div class="rounded-3 p-2 p-md-3" style="background: #e6f7ff;">
                            <i class="fas fa-clipboard-list fa-1x fa-md-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Terbaru -->
    <div class="row g-3 g-md-4">
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-3 pt-md-4 pb-0 px-3 px-md-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h6 class="fw-semibold mb-0">
                        <i class="fas fa-chalkboard-user me-2 text-primary"></i>Dosen Terbaru
                    </h6>
                    <a href="{{ route('dosen.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
                </div>
                <div class="card-body p-3 p-md-4">
                    @forelse($latestDosen ?? [] as $dosen)
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <div>
                            <div class="fw-semibold">{{ $dosen->nama }}</div>
                            <small class="text-muted">{{ $dosen->nidn }}</small>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">Aktif</span>
                    </div>
                    @empty
                    <div class="text-center py-3 text-muted">Belum ada data</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-3 pt-md-4 pb-0 px-3 px-md-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h6 class="fw-semibold mb-0">
                        <i class="fas fa-users me-2 text-success"></i>Mahasiswa Terbaru
                    </h6>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-sm btn-outline-success rounded-pill">Lihat Semua</a>
                </div>
                <div class="card-body p-3 p-md-4">
                    @forelse($latestMahasiswa ?? [] as $mhs)
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <div>
                            <div class="fw-semibold">{{ $mhs->nama }}</div>
                            <small class="text-muted">{{ $mhs->npm }} • {{ $mhs->dosen->nama ?? '-' }}</small>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">Aktif</span>
                    </div>
                    @empty
                    <div class="text-center py-3 text-muted">Belum ada data</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .btn, .btn-sm, .btn-outline-secondary, .btn-danger, .btn-primary, .btn-success, .btn-warning {
        display: none !important;
    }
    .sidebar {
        display: none !important;
    }
    .main-content {
        margin-left: 0 !important;
        padding: 20px !important;
    }
    .card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }
    .navbar-top {
        display: none !important;
    }
    .btn-close {
        display: none !important;
    }
    .card-header {
        background: #f8f9fa !important;
    }
    body {
        background: white !important;
    }
}
</style>
@endsection