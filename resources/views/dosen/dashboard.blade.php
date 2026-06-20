@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">Dashboard Dosen</h4>
            <p class="text-muted small mb-0">Selamat datang, <strong>{{ $dosen->nama }}</strong></p>
        </div>
        <div class="text-end">
            <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase">Mahasiswa Bimbingan</small>
                            <h2 class="mb-0 fw-bold mt-1">{{ $totalMahasiswaBimbingan }}</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #e8f0fe;">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase">Jadwal Mengajar</small>
                            <h2 class="mb-0 fw-bold mt-1">{{ $totalJadwalMengajar }}</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #e6f4ea;">
                            <i class="fas fa-calendar-alt fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase">Total Pengambilan KRS</small>
                            <h2 class="mb-0 fw-bold mt-1">{{ $totalKRS }}</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #fef3e6;">
                            <i class="fas fa-clipboard-list fa-2x text-warning"></i>
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
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>Jadwal Mengajar Terbaru
                        </h6>
                        <a href="{{ route('dosen.jadwal') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                </div>
                <div class="card-body p-4">
                    @forelse($jadwalTerbaru as $j)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <div>
                            <div class="fw-semibold">{{ $j->matakuliah->nama_matakuliah }}</div>
                            <small class="text-muted">{{ $j->hari }}, {{ date('H:i', strtotime($j->jam)) }} | Kelas {{ $j->kelas }}</small>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary">{{ $j->kelas }}</span>
                    </div>
                    @empty
                    <div class="text-center py-3 text-muted">Belum ada jadwal mengajar</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="fw-semibold mb-0">
                            <i class="fas fa-user-graduate me-2 text-success"></i>Mahasiswa Bimbingan Terbaru
                        </h6>
                        <a href="{{ route('dosen.mahasiswa') }}" class="btn btn-sm btn-outline-success">Lihat Semua</a>
                    </div>
                </div>
                <div class="card-body p-4">
                    @forelse($mahasiswaBimbingan as $mhs)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <div>
                            <div class="fw-semibold">{{ $mhs->nama }}</div>
                            <small class="text-muted">{{ $mhs->npm }}</small>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success">{{ App\Models\KRS::where('npm', $mhs->npm)->count() }} MK</span>
                    </div>
                    @empty
                    <div class="text-center py-3 text-muted">Belum ada mahasiswa bimbingan</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection