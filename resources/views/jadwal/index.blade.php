@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Jadwal Kuliah</h5>
                <div>
                    <small class="text-muted">Total Jadwal: {{ $jadwal->total() ?? 0 }}</small>
                </div>
            </div>
            <div class="card-body">
                <!-- Search Form -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <form action="{{ route('jadwal.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control form-control-sm me-2" 
                                   placeholder="Cari mahasiswa (Nama/NPM)..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-search me-1"></i> Cari
                            </button>
                            @if(request('search'))
                            <a href="{{ route('jadwal.index') }}" class="btn btn-secondary btn-sm ms-2">
                                <i class="fas fa-sync-alt me-1"></i> Reset
                            </a>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="10%">NPM</th>
                                <th width="15%">Nama Mahasiswa</th>
                                <th width="10%">Kode MK</th>
                                <th width="25%">Mata Kuliah</th>
                                <th width="8%" class="text-center">SKS</th>
                                <th width="10%">Hari</th>
                                <th width="12%">Jam</th>
                                <th width="10%">Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwal as $index => $item)
                            @php
                                $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                                $jamMulaiList = [7, 8, 9, 10, 11, 13, 14, 15];
                                $ruanganList = ['101', '102', '103', '201', '202', '203', '301', '302', '303'];
                                
                                $hash = abs(crc32($item->id . $item->npm));
                                $randomHari = $hariList[$hash % 5];
                                $randomJam = $jamMulaiList[$hash % 8];
                                $randomRuangan = $ruanganList[$hash % 9];
                            @endphp
                            <tr>
                                <td class="text-center">{{ ($jadwal->currentPage() - 1) * $jadwal->perPage() + $loop->iteration }}</td>
                                <td><strong>{{ $item->mahasiswa->npm ?? '-' }}</strong></td>
                                <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                                <td>{{ $item->matakuliah->kode_matakuliah ?? '-' }}</td>
                                <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        {{ $item->matakuliah->sks ?? '-' }} SKS
                                    </span>
                                </td>
                                <td>{{ $randomHari }}</td>
                                <td>{{ sprintf('%02d', $randomJam) }}:00 - {{ sprintf('%02d', $randomJam + 2) }}:30</td>
                                <td>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                        <i class="fas fa-door-open me-1"></i> Ruang {{ $randomRuangan }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada data jadwal
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination - Tengah -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $jadwal->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection