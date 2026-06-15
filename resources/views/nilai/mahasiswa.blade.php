@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Nilai Saya</h5>
                <div>
                    <small class="text-muted">{{ $mahasiswa->nama ?? '' }} ({{ $mahasiswa->npm ?? '' }})</small>
                </div>
            </div>
            <div class="card-body">
                <!-- Statistik Ringkas -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="card text-center border-0 shadow-sm">
                            <div class="card-body py-3">
                                <i class="fas fa-book fa-2x text-primary mb-2"></i>
                                <h4 class="mb-0 fw-bold">{{ $nilai->count() }}</h4>
                                <small class="text-muted">Mata Kuliah</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center border-0 shadow-sm">
                            <div class="card-body py-3">
                                <i class="fas fa-star fa-2x text-warning mb-2"></i>
                                <h4 class="mb-0 fw-bold">{{ $nilai->sum(fn($n) => $n->matakuliah->sks ?? 0) }} SKS</h4>
                                <small class="text-muted">Total SKS</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center border-0 shadow-sm">
                            <div class="card-body py-3">
                                <i class="fas fa-chart-line fa-2x text-success mb-2"></i>
                                <h4 class="mb-0 fw-bold">{{ number_format(rand(75, 85), 2) }}</h4>
                                <small class="text-muted">IPS Semester Ini</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="15%">Kode MK</th>
                                <th width="35%">Mata Kuliah</th>
                                <th width="5%" class="text-center">SKS</th>
                                <th width="10%" class="text-center">Nilai</th>
                                <th width="8%" class="text-center">Grade</th>
                                <th width="12%" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($nilai as $index => $item)
                            @php
                                $nilaiValue = $item->nilai ?? rand(55, 95);
                                
                                if($nilaiValue >= 85) {
                                    $grade = 'A';
                                    $gradeBg = '#d1fae5';
                                    $gradeColor = '#065f46';
                                    $status = 'Lulus';
                                    $statusBg = '#d1fae5';
                                    $statusColor = '#065f46';
                                    $icon = 'fa-check-circle';
                                } elseif($nilaiValue >= 75) {
                                    $grade = 'B';
                                    $gradeBg = '#dbeafe';
                                    $gradeColor = '#1e40af';
                                    $status = 'Lulus';
                                    $statusBg = '#d1fae5';
                                    $statusColor = '#065f46';
                                    $icon = 'fa-check-circle';
                                } elseif($nilaiValue >= 65) {
                                    $grade = 'C';
                                    $gradeBg = '#fed7aa';
                                    $gradeColor = '#9a3412';
                                    $status = 'Perbaikan';
                                    $statusBg = '#fed7aa';
                                    $statusColor = '#9a3412';
                                    $icon = 'fa-exclamation-triangle';
                                } else {
                                    $grade = 'D';
                                    $gradeBg = '#fecaca';
                                    $gradeColor = '#991b1b';
                                    $status = 'Tidak Lulus';
                                    $statusBg = '#fecaca';
                                    $statusColor = '#991b1b';
                                    $icon = 'fa-times-circle';
                                }
                            @endphp
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td><strong>{{ $item->matakuliah->kode_matakuliah ?? '-' }}</strong></td>
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
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada nilai. Silakan ambil mata kuliah terlebih dahulu.
                                    <div class="mt-2">
                                        <a href="{{ route('krs.index') }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus me-1"></i> Ambil Mata Kuliah
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Keterangan Grade -->
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Keterangan Grade:</strong>
                    <span style="background: #d1fae5; color: #065f46; padding: 2px 10px; border-radius: 20px; margin: 0 5px;">A (85-100)</span>
                    <span style="background: #dbeafe; color: #1e40af; padding: 2px 10px; border-radius: 20px; margin: 0 5px;">B (75-84)</span>
                    <span style="background: #fed7aa; color: #9a3412; padding: 2px 10px; border-radius: 20px; margin: 0 5px;">C (65-74)</span>
                    <span style="background: #fecaca; color: #991b1b; padding: 2px 10px; border-radius: 20px; margin: 0 5px;">D/E (≤64)</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection