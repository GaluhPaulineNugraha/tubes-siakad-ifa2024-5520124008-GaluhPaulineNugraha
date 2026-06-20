@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">Nilai Mahasiswa Bimbingan</h4>
            <p class="text-muted small mb-0">Dosen: <strong>{{ $dosen->nama ?? '' }}</strong></p>
        </div>
        <div class="text-end">
            <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
        </div>
    </div>

    <!-- Info -->
    <div class="alert alert-info mb-4 border-0 rounded-4 shadow-sm">
        <i class="fas fa-info-circle me-2"></i>
        Halaman ini menampilkan nilai mahasiswa bimbingan Anda. (READ ONLY)
    </div>

    <!-- Search -->
    <div class="row mb-3">
        <div class="col-md-4">
            <form action="{{ route('nilai.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm me-2" 
                       placeholder="Cari mahasiswa..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-search me-1"></i> Cari
                </button>
                @if(request('search'))
                <a href="{{ route('nilai.index') }}" class="btn btn-secondary btn-sm ms-2">
                    <i class="fas fa-sync-alt me-1"></i> Reset
                </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Tabel Nilai -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="text-center py-3">No</th>
                            <th width="10%" class="py-3">NPM</th>
                            <th width="15%" class="py-3">Nama Mahasiswa</th>
                            <th width="20%" class="py-3">Mata Kuliah</th>
                            <th width="5%" class="text-center py-3">SKS</th>
                            <th width="10%" class="text-center py-3">Nilai</th>
                            <th width="8%" class="text-center py-3">Grade</th>
                            <th width="12%" class="text-center py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($nilai as $index => $item)
                        @php
                            // Data dummy jika kolom nilai belum ada
                            $nilaiValue = $item->nilai ?? '-';
                            $grade = $item->grade ?? '-';
                            $status = $item->status ?? '-';
                            
                            if($nilaiValue >= 85) {
                                $gradeBg = '#d1fae5';
                                $gradeColor = '#065f46';
                                $statusBg = '#d1fae5';
                                $statusColor = '#065f46';
                                $icon = 'fa-check-circle';
                            } elseif($nilaiValue >= 75) {
                                $gradeBg = '#dbeafe';
                                $gradeColor = '#1e40af';
                                $statusBg = '#d1fae5';
                                $statusColor = '#065f46';
                                $icon = 'fa-check-circle';
                            } elseif($nilaiValue >= 65) {
                                $gradeBg = '#fed7aa';
                                $gradeColor = '#9a3412';
                                $statusBg = '#fed7aa';
                                $statusColor = '#9a3412';
                                $icon = 'fa-exclamation-triangle';
                            } elseif($nilaiValue >= 55) {
                                $gradeBg = '#fecaca';
                                $gradeColor = '#991b1b';
                                $statusBg = '#fecaca';
                                $statusColor = '#991b1b';
                                $icon = 'fa-times-circle';
                            } else {
                                $gradeBg = '#fecaca';
                                $gradeColor = '#991b1b';
                                $statusBg = '#fecaca';
                                $statusColor = '#991b1b';
                                $icon = 'fa-times-circle';
                            }
                        @endphp
                        <tr>
                            <td class="text-center">{{ ($nilai->currentPage() - 1) * $nilai->perPage() + $loop->iteration }}</td>
                            <td><strong>{{ $item->mahasiswa->npm ?? '-' }}</strong></td>
                            <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                            <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                            <td class="text-center">{{ $item->matakuliah->sks ?? '-' }}</td>
                            <td class="text-center fw-bold">{{ $nilaiValue }}</td>
                            <td class="text-center">
                                <span style="background: {{ $gradeBg }}; color: {{ $gradeColor }}; padding: 4px 12px; border-radius: 20px; font-weight: 500; font-size: 12px;">
                                    {{ $grade }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span style="background: {{ $statusBg }}; color: {{ $statusColor }}; padding: 4px 12px; border-radius: 20px; font-weight: 500; font-size: 12px;">
                                    <i class="fas {{ $icon }} me-1"></i>
                                    {{ $status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                <h6>Belum ada data nilai untuk mahasiswa bimbingan Anda</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($nilai->hasPages())
        <div class="card-footer bg-white border-0 pt-0 pb-3 px-4">
            <div class="d-flex justify-content-center mt-3">
                {{ $nilai->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>

    <!-- Keterangan Grade -->
    <div class="alert alert-info mt-4 border-0 rounded-4 shadow-sm">
        <i class="fas fa-info-circle me-2"></i>
        <strong>Keterangan Grade:</strong>
        <span style="background: #d1fae5; color: #065f46; padding: 2px 12px; border-radius: 20px; margin: 0 5px;">A (85-100)</span>
        <span style="background: #dbeafe; color: #1e40af; padding: 2px 12px; border-radius: 20px; margin: 0 5px;">B (75-84)</span>
        <span style="background: #fed7aa; color: #9a3412; padding: 2px 12px; border-radius: 20px; margin: 0 5px;">C (65-74)</span>
        <span style="background: #fecaca; color: #991b1b; padding: 2px 12px; border-radius: 20px; margin: 0 5px;">D/E (≤64)</span>
    </div>
</div>
@endsection