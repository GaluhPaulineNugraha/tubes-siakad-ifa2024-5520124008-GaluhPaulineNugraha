@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">Dashboard</h4>
            <p class="text-muted small mb-0">Selamat datang, <strong>Admin Universitas Nugraha</strong></p>
        </div>
        <div class="text-end">
            <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
        </div>
    </div>

    @role('admin')
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

    <!-- Data Terbaru Section -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-semibold mb-0">
                <i class="fas fa-clock me-2 text-primary"></i>Data Terbaru
            </h6>
            <span class="text-muted small">Data terbaru yang ditambahkan</span>
        </div>
        
        <div class="row g-3">
            <!-- Dosen Terbaru Card -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">
                                <i class="fas fa-chalkboard-user me-2 text-primary"></i>Dosen Terbaru
                            </span>
                            <span class="badge bg-light text-dark rounded-pill">{{ $latestDosen->count() }} data</span>
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
                    <div class="card-footer bg-white border-0 pb-3 pt-0 px-4">
                        <a href="{{ route('dosen.index') }}" class="text-decoration-none small">
                            Lihat semua <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mahasiswa Terbaru Card -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">
                                <i class="fas fa-users me-2 text-success"></i>Mahasiswa Terbaru
                            </span>
                            <span class="badge bg-light text-dark rounded-pill">{{ $latestMahasiswa->count() }} data</span>
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
                    <div class="card-footer bg-white border-0 pb-3 pt-0 px-4">
                        <a href="{{ route('mahasiswa.index') }}" class="text-decoration-none small">
                            Lihat semua <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Akademik -->
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-semibold mb-0">
                <i class="fas fa-chart-simple me-2 text-primary"></i>Ringkasan Akademik
            </h6>
        </div>
        
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <small class="text-muted">Total SKS Terambil</small>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <h3 class="mb-0 fw-bold">{{ number_format($totalSKS ?? 0) }}</h3>
                        <small class="text-muted">SKS</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <small class="text-muted">Rata-rata SKS per Mahasiswa</small>
                            <i class="fas fa-chart-line text-success"></i>
                        </div>
                        <h3 class="mb-0 fw-bold">{{ number_format($avgSksPerMhs ?? 0, 1) }}</h3>
                        <small class="text-muted">SKS / Mahasiswa</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <small class="text-muted">Mahasiswa Aktif KRS</small>
                            <i class="fas fa-user-graduate text-info"></i>
                        </div>
                        <h3 class="mb-0 fw-bold">{{ number_format($activeKRS ?? 0) }}</h3>
                        <small class="text-muted">dari {{ number_format($totalMahasiswa ?? 0) }} Mahasiswa</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    @role('mahasiswa')
    <!-- Dashboard Mahasiswa -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase">Mata Kuliah Diambil</small>
                            <h2 class="mb-0 fw-bold mt-1">{{ number_format($totalMatakuliah ?? 0) }}</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #e8f0fe;">
                            <i class="fas fa-book fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase">Total SKS</small>
                            <h2 class="mb-0 fw-bold mt-1">{{ number_format($totalSks ?? 0) }} / 24</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #e6f4ea;">
                            <i class="fas fa-star fa-2x text-success"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: {{ min(100, (($totalSks ?? 0)/24)*100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Mahasiswa -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h6 class="fw-semibold mb-3">
                <i class="fas fa-user-graduate me-2 text-primary"></i>Informasi Mahasiswa
            </h6>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr><td width="130" class="text-muted">NPM</td<td: <strong>{{ $mahasiswa->npm ?? '-' }}</strong></td></tr>
                        <tr><td class="text-muted">Nama Lengkap</td<td: <strong>{{ $mahasiswa->nama ?? '-' }}</strong></td></tr>
                        <tr><td class="text-muted">Program Studi</td<td: Teknik Informatika</td</tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr><td width="130" class="text-muted">Dosen Wali</td<td: {{ $mahasiswa->dosen->nama ?? '-' }}</td</tr>
                        <tr><td class="text-muted">Status</td<td: <span class="badge bg-success">Aktif</span></td</td>
                        <tr><td class="text-muted">Semester</td<td: Genap 2024/2025</td</tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Mata Kuliah yang Diambil -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="fw-semibold mb-0">
                    <i class="fas fa-clipboard-list me-2 text-primary"></i>Mata Kuliah Diambil
                </h6>
                <a href="{{ route('krs.index') }}" class="btn btn-primary btn-sm rounded-pill">
                    <i class="fas fa-plus me-1"></i> Ambil MK
                </a>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr><th width="50">No</th><th>Kode MK</th><th>Mata Kuliah</th><th class="text-center">SKS</th><th class="text-center">Tanggal</th></tr>
                    </thead>
                    <tbody>
                        @forelse($latestKRS ?? [] as $index => $krs)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td
                            <td><span class="fw-bold">{{ $krs->matakuliah->kode_matakuliah ?? '-' }}</span></td
                            <td>{{ $krs->matakuliah->nama_matakuliah ?? '-' }}</td
                            <td class="text-center"><span class="badge bg-primary bg-opacity-10 text-primary">{{ $krs->matakuliah->sks ?? '-' }} SKS</span></td
                            <td class="text-center">{{ $krs->created_at ? $krs->created_at->format('d/m/Y') : '-' }}</td
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada mata kuliah yang diambil</td</tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endrole
</div>
@endsection