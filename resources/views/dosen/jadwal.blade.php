@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">Jadwal Mengajar Saya</h4>
            <p class="text-muted small mb-0">Dosen: <strong>{{ Auth::user()->name }}</strong></p>
        </div>
        <div class="text-end">
            <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
        </div>
    </div>

    <!-- Alert Info -->
    <div class="alert alert-info mb-4 border-0 rounded-4 shadow-sm">
        <i class="fas fa-info-circle me-2"></i>
        Jadwal mengajar ini dikelola oleh Admin. Jika ada perubahan, silakan hubungi Admin.
    </div>

    <!-- Tabel Jadwal -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="text-center py-3">No</th>
                            <th width="30%" class="py-3">Mata Kuliah</th>
                            <th width="20%" class="py-3">Hari</th>
                            <th width="25%" class="py-3">Jam</th>
                            <th width="20%" class="text-center py-3">Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwal as $index => $j)
                        <tr>
                            <td class="text-center">{{ ($jadwal->currentPage() - 1) * $jadwal->perPage() + $loop->iteration }}</td>
                            <td>
                                <span class="fw-semibold">{{ $j->matakuliah->nama_matakuliah }}</span>
                                <br>
                                <small class="text-muted">{{ $j->matakuliah->kode_matakuliah ?? '' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                    {{ $j->hari }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-medium">{{ date('H:i', strtotime($j->jam)) }}</span>
                                <span class="text-muted ms-1" style="font-size: 11px;">WIB</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                    {{ $j->kelas }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-calendar-times fa-3x mb-3 d-block"></i>
                                <h6>Belum ada jadwal mengajar</h6>
                                <small>Silakan hubungi Admin untuk penjadwalan</small>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($jadwal->hasPages())
        <div class="card-footer bg-white border-0 pt-0 pb-3 px-4">
            <div class="d-flex justify-content-center mt-3">
                {{ $jadwal->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection