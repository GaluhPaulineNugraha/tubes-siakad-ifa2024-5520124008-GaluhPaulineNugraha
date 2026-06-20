@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">Mahasiswa Bimbingan</h4>
            <p class="text-muted small mb-0">Dosen: <strong>{{ $dosen->nama }}</strong></p>
        </div>
        <div class="text-end">
            <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
        </div>
    </div>

    <!-- Statistik Ringkas -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase">Total Bimbingan</small>
                            <h2 class="mb-0 fw-bold mt-1">{{ $mahasiswa->total() }}</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #e8f0fe;">
                            <i class="fas fa-users fa-2x text-primary"></i>
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
                            <small class="text-muted text-uppercase">Total MK Diambil</small>
                            <h2 class="mb-0 fw-bold mt-1">
                                {{ $mahasiswa->sum(function($m) { return App\Models\KRS::where('npm', $m->npm)->count(); }) }}
                            </h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #e6f4ea;">
                            <i class="fas fa-book fa-2x text-success"></i>
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
                            <small class="text-muted text-uppercase">Status</small>
                            <h2 class="mb-0 fw-bold mt-1 text-success">Aktif</h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #fef3e6;">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
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
                            <small class="text-muted text-uppercase">Rata-rata MK</small>
                            <h2 class="mb-0 fw-bold mt-1">
                                {{ $mahasiswa->count() > 0 ? round($mahasiswa->sum(function($m) { return App\Models\KRS::where('npm', $m->npm)->count(); }) / $mahasiswa->count(), 1) : 0 }}
                            </h2>
                        </div>
                        <div class="rounded-3 p-3" style="background: #e6f7ff;">
                            <i class="fas fa-chart-bar fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Mahasiswa -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="text-center py-3">No</th>
                            <th width="15%" class="py-3">NPM</th>
                            <th width="35%" class="py-3">Nama Mahasiswa</th>
                            <th width="25%" class="text-center py-3">Jumlah MK Diambil</th>
                            <th width="20%" class="text-center py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $index => $mhs)
                        @php
                            $jumlahMK = App\Models\KRS::where('npm', $mhs->npm)->count();
                        @endphp
                        <tr>
                            <td class="text-center">{{ ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() + $loop->iteration }}</td>
                            <td>
                                <span class="fw-semibold">{{ $mhs->npm }}</span>
                            </td>
                            <td>
                                <span class="fw-medium">{{ $mhs->nama }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                    {{ $jumlahMK }} Mata Kuliah
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                    <span class="d-inline-block rounded-circle bg-success me-1" style="width: 6px; height: 6px;"></span>
                                    Aktif
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-users-slash fa-3x mb-3 d-block"></i>
                                <h6>Belum ada mahasiswa bimbingan</h6>
                                <small>Mahasiswa akan muncul setelah ditugaskan ke Anda</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($mahasiswa->hasPages())
        <div class="card-footer bg-white border-0 pt-0 pb-3 px-4">
            <div class="d-flex justify-content-center mt-3">
                {{ $mahasiswa->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection