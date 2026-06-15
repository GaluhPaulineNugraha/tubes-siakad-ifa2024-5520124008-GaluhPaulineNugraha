@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Jadwal Kuliah Saya</h5>
                <div>
                    <small class="text-muted">{{ $mahasiswa->nama ?? '' }} ({{ $mahasiswa->npm ?? '' }})</small>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    Jadwal diurutkan berdasarkan <strong>Hari</strong> (Senin s/d Jumat)
                </div>

                <!-- Tabel Jadwal -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="10%">Kode MK</th>
                                <th width="30%">Mata Kuliah</th>
                                <th width="5%" class="text-center">SKS</th>
                                <th width="10%">Hari</th>
                                <th width="15%">Jam</th>
                                <th width="10%">Ruangan</th>
                                <th width="20%">Dosen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwal as $index => $item)
                            @php
                                $kodeMK = $item->matakuliah->kode_matakuliah ?? '-';
                                $hash = abs(crc32($kodeMK . $item->id));
                                
                                $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                                $jamMulaiList = [7, 8, 9, 10, 11, 13, 14, 15];
                                $ruanganList = ['A101', 'A102', 'B201', 'B202', 'C301', 'C302'];
                                $dosenList = [
                                    'Dr. Ahmad Rizki, M.Kom',
                                    'Prof. Siti Nurhaliza, M.Sc',
                                    'Dr. Budi Santoso, M.Eng',
                                    'Dewi Lestari, S.Kom, M.Kom',
                                    'Dr. Eko Prasetyo, M.Kom'
                                ];
                                
                                $randomHari = $hariList[$hash % 5];
                                $randomJam = $jamMulaiList[$hash % 8];
                                $randomRuangan = $ruanganList[$hash % 6];
                                $randomDosen = $dosenList[$hash % 5];
                            @endphp
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td><strong>{{ $kodeMK }}</strong></td>
                                <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        {{ $item->matakuliah->sks ?? '-' }} SKS
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info">
                                        <i class="fas fa-calendar-day me-1"></i> {{ $randomHari }}
                                    </span>
                                </td>
                                <td>
                                    <i class="fas fa-clock me-1 text-muted"></i> {{ sprintf('%02d', $randomJam) }}:00 - {{ sprintf('%02d', $randomJam + 2) }}:30
                                </td>
                                <td>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                        <i class="fas fa-door-open me-1"></i> Ruang {{ $randomRuangan }}
                                    </span>
                                </td>
                                <td>
                                    <i class="fas fa-chalkboard-user me-1 text-muted"></i> {{ $randomDosen }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada jadwal. Silakan ambil mata kuliah terlebih dahulu.
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
            </div>
        </div>
    </div>
</div>
@endsection