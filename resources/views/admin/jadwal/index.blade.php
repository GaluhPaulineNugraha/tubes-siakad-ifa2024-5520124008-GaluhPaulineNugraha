@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Manajemen Jadwal Perkuliahan</h5>
                <div class="d-flex gap-2">
                    <a href="{{ url('/admin/jadwal/export-excel') }}" class="btn btn-success btn-sm rounded-pill">
                        <i class="fas fa-file-excel me-1"></i> Export Excel
                    </a>
                    <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary btn-sm rounded-pill">
                        <i class="fas fa-plus me-1"></i>Tambah Jadwal
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <ul class="nav nav-pills mb-4 gap-2 flex-wrap" id="kelasTab" role="tablist">
                    @php
                        $kelasList = ['A', 'B', 'C', 'D', 'E'];
                        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    @endphp
                    @foreach($kelasList as $index => $kelas)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link btn rounded-pill px-4 py-2 fw-medium {{ $index == 0 ? 'active' : '' }}" 
                                style="{{ $index == 0 ? 'background: #0A2540; color: white; border: none;' : 'background: #f1f3f5; color: #4a5568; border: 1px solid #e2e8f0;' }}"
                                data-bs-toggle="pill" 
                                data-bs-target="#kelas-{{ strtolower($kelas) }}" 
                                type="button" 
                                role="tab"
                                onmouseover="this.style.background='{{ $index == 0 ? '#0A2540' : '#e2e8f0' }}'"
                                onmouseout="this.style.background='{{ $index == 0 ? '#0A2540' : '#f1f3f5' }}'">
                            Kelas {{ $kelas }}
                        </button>
                    </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="kelasTabContent">
                    @foreach($kelasList as $kelas)
                    @php
                        $jadwalKelas = $jadwal->where('kelas', $kelas);
                    @endphp
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="kelas-{{ strtolower($kelas) }}" role="tabpanel">
                        @if($jadwalKelas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="25%">Mata Kuliah</th>
                                        <th width="25%">Dosen</th>
                                        <th width="12%">Hari</th>
                                        <th width="15%">Jam</th>
                                        <th width="18%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($jadwalKelas as $j)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>
                                            <span class="fw-semibold">{{ $j->matakuliah->nama_matakuliah }}</span>
                                            <br>
                                            <small class="text-muted">{{ $j->matakuliah->kode_matakuliah ?? '' }}</small>
                                        </td>
                                        <td>{{ $j->dosen->nama }}</td>
                                        <td>
                                            <span style="font-weight: 600; font-size: 14px; color: #2d3748;">
                                                {{ $j->hari }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ date('H:i', strtotime($j->jam)) }}
                                            <span class="text-muted ms-1" style="font-size: 11px;">WIB</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 justify-content-center flex-wrap">
                                                <a href="{{ route('admin.jadwal.edit', $j->id) }}" class="btn btn-warning btn-sm rounded-pill">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm rounded-pill" 
                                                        onclick="confirmDelete('{{ $j->id }}', '{{ addslashes($j->matakuliah->nama_matakuliah) }}')">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                                <form id="delete-form-{{ $j->id }}" 
                                                      action="{{ route('admin.jadwal.destroy', $j->id) }}" 
                                                      method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            Belum ada jadwal untuk Kelas {{ $kelas }}
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-danger text-white rounded-top-4">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <i class="fas fa-calendar-times fa-4x text-danger"></i>
                </div>
                <h5 class="mb-2">Yakin ingin menghapus jadwal ini?</h5>
                <p class="text-muted mb-0" id="deleteMessage">Data yang dihapus tidak dapat dikembalikan!</p>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-danger px-4" id="confirmDeleteBtn">
                    <i class="fas fa-trash me-2"></i>Ya, Hapus!
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.nav-pills .nav-link.active {
    background: #0A2540 !important;
    color: white !important;
    border: none !important;
}
.nav-pills .nav-link:not(.active) {
    background: #f1f3f5 !important;
    color: #4a5568 !important;
    border: 1px solid #e2e8f0 !important;
}
.nav-pills .nav-link:not(.active):hover {
    background: #e2e8f0 !important;
}
.nav-pills .nav-link {
    transition: all 0.2s ease;
}
</style>

@push('scripts')
<script>
    let deleteId = null;
    
    function confirmDelete(id, matkul) {
        deleteId = id;
        document.getElementById('deleteMessage').innerHTML = `Apakah Anda yakin ingin menghapus jadwal <strong class="text-danger">${matkul}</strong>?<br><small class="text-muted">Data yang dihapus tidak dapat dikembalikan!</small>`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
    
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteId) {
            document.getElementById(`delete-form-${deleteId}`).submit();
        }
    });
</script>
@endpush
@endsection