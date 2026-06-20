@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">Dashboard Mahasiswa</h4>
            <p class="text-muted small mb-0">Selamat datang, <strong>{{ $mahasiswa->nama }}</strong></p>
        </div>
        <div class="text-end">
            <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <small class="text-muted text-uppercase">Mata Kuliah Diambil</small>
                            <h2 class="mb-0 fw-bold mt-1">{{ $totalMatakuliah }}</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #e8f0fe;">
                            <i class="fas fa-book fa-2x text-primary"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: {{ min(100, ($totalMatakuliah/10)*100) }}%"></div>
                    </div>
                    <small class="text-muted mt-2 d-block">Maksimal 10 Mata Kuliah</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <small class="text-muted text-uppercase">Total SKS</small>
                            <h2 class="mb-0 fw-bold mt-1">{{ $totalSks }} / 24</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #e6f4ea;">
                            <i class="fas fa-star fa-2x text-success"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: {{ min(100, ($totalSks/24)*100) }}%"></div>
                    </div>
                    <small class="text-muted mt-2 d-block">Sisa kuota: {{ 24 - $totalSks }} SKS</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <small class="text-muted text-uppercase">IPK Semester Ini</small>
                            <h2 class="mb-0 fw-bold mt-1">3.25</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #fef3e6;">
                            <i class="fas fa-chart-line fa-2x text-warning"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-warning" style="width: 65%"></div>
                    </div>
                    <small class="text-muted mt-2 d-block">Predikat: Memuaskan</small>
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
                        <tr>
                            <td width="130" class="text-muted">NPM</td>
                            <td class="fw-bold">: {{ $mahasiswa->npm }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Nama Lengkap</td>
                            <td class="fw-bold">: {{ $mahasiswa->nama }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Program Studi</td>
                            <td>: Teknik Informatika</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td width="130" class="text-muted">Dosen Wali</td>
                            <td>: {{ $mahasiswa->dosen->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status</td>
                            <td>: <span class="badge bg-success">Aktif</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Semester</td>
                            <td>: Genap 2024/2025</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Mata Kuliah yang Diambil -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
            <h6 class="fw-semibold mb-0">
                <i class="fas fa-clipboard-list me-2 text-primary"></i>Mata Kuliah Diambil
            </h6>
            <a href="{{ route('krs.index') }}" class="btn btn-primary btn-sm rounded-pill">
                <i class="fas fa-plus me-1"></i> Ambil MK
            </a>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="20%">Kode MK</th>
                            <th width="45%">Mata Kuliah</th>
                            <th width="10%" class="text-center">SKS</th>
                            <th width="15%" class="text-center">Tanggal Ambil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestKRS as $index => $krs)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td><strong>{{ $krs->matakuliah->kode_matakuliah ?? '-' }}</strong></td>
                            <td>{{ $krs->matakuliah->nama_matakuliah ?? '-' }}</td>
                            <td class="text-center">{{ $krs->matakuliah->sks ?? '-' }} SKS</td>
                            <td class="text-center">{{ $krs->created_at ? $krs->created_at->format('d/m/Y') : '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                Belum ada mata kuliah yang diambil
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Catatan -->
    <div class="alert alert-info mt-4">
        <i class="fas fa-info-circle me-2"></i>
        <strong>Informasi:</strong> Maksimal pengambilan SKS adalah 24 SKS per semester.
        @if($totalSks < 24)
            Anda masih dapat mengambil {{ 24 - $totalSks }} SKS lagi.
        @else
            Kuota SKS Anda sudah penuh.
        @endif
    </div>
</div>
@endsection