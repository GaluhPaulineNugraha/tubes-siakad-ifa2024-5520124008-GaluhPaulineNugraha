@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Jadwal Kuliah Saya</h5>
                <div class="text-end">
                    <div class="d-flex flex-column align-items-end gap-1">
                        <small class="text-muted">{{ $mahasiswa->nama ?? '' }} ({{ $mahasiswa->npm ?? '' }})</small>
                        <a href="{{ route('jadwal.export.pdf') }}" class="btn btn-danger btn-sm rounded-pill">
                            <i class="fas fa-file-pdf me-1"></i> Export PDF
                        </a>
                    </div>
                </div>
            </div>

                @if($jadwal->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="10%">Kode MK</th>
                                <th width="25%">Mata Kuliah</th>
                                <th width="5%" class="text-center">SKS</th>
                                <th width="10%">Hari</th>
                                <th width="15%">Jam</th>
                                <th width="8%" class="text-center">Kelas</th>
                                <th width="22%">Dosen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwal as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td><strong>{{ $item->matakuliah->kode_matakuliah ?? '-' }}</strong></td>
                                <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        {{ $item->matakuliah->sks ?? '-' }} SKS
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info">
                                        {{ $item->hari }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->jam)
                                        {{ date('H:i', strtotime($item->jam)) }}
                                        <span class="text-muted ms-1" style="font-size: 11px;">WIB</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                        {{ $item->kelas }}
                                    </span>
                                </td>
                                <td>
                                    {{ $item->dosen->nama ?? '-' }}
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

                @else
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                    <h5>Belum Ada Jadwal</h5>
                    <p class="text-muted">Anda belum mengambil mata kuliah, atau jadwal belum tersedia.</p>
                    <a href="{{ route('krs.index') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Ambil Mata Kuliah
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection