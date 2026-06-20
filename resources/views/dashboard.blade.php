@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">Dashboard</h4>
            <p class="text-muted small mb-0">Selamat datang, <strong>Admin</strong></p>
        </div>
        <div class="text-end">
            <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase">Total Dosen</small>
                            <h2 class="mb-0 fw-bold mt-1">{{ number_format($totalDosen ?? 0) }}</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #e8f0fe;">
                            <i class="fas fa-chalkboard-user fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase">Total Mahasiswa</small>
                            <h2 class="mb-0 fw-bold mt-1">{{ number_format($totalMahasiswa ?? 0) }}</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #e6f4ea;">
                            <i class="fas fa-users fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase">Mata Kuliah</small>
                            <h2 class="mb-0 fw-bold mt-1">{{ number_format($totalMatakuliah ?? 0) }}</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #fef3e6;">
                            <i class="fas fa-book fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase">Pengambilan KRS</small>
                            <h2 class="mb-0 fw-bold mt-1">{{ number_format($totalKRS ?? 0) }}</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #e6f7ff;">
                            <i class="fas fa-clipboard-list fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Terbaru -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="fw-semibold mb-0">
                            <i class="fas fa-chalkboard-user me-2 text-primary"></i>Dosen Terbaru
                        </h6>
                        <a href="{{ route('dosen.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                </div>
                <div class="card-body p-4">
                    @forelse($latestDosen ?? [] as $dosen)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
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

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="fw-semibold mb-0">
                            <i class="fas fa-users me-2 text-success"></i>Mahasiswa Terbaru
                        </h6>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-sm btn-outline-success">Lihat Semua</a>
                    </div>
                </div>
                <div class="card-body p-4">
                    @forelse($latestMahasiswa ?? [] as $mhs)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
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
@endsection