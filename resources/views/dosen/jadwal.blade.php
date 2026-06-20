@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Jadwal Mengajar Saya</h5>
                <small class="text-muted">Anda hanya dapat melihat jadwal yang telah ditentukan oleh Admin</small>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Jadwal mengajar ini dikelola oleh Admin. Jika ada perubahan, silakan hubungi Admin.
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="25%">Mata Kuliah</th>
                                <th width="10%">Hari</th>
                                <th width="15%">Jam</th>
                                <th width="15%">Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwal as $index => $j)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $j->matakuliah->nama_matakuliah }}</td>
                                <td>{{ $j->hari }}</td>
                                <td>{{ date('H:i', strtotime($j->jam)) }}</td>
                                <td>{{ $j->kelas }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada jadwal mengajar
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $jadwal->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection