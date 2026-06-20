@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Manajemen KRS</h5>
                <div>
                    <a href="{{ route('krs.export.excel') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel me-1"></i>Export Excel
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Form Search & Filter -->
                <div class="row mb-3 g-2">
                    <div class="col-md-5">
                        <form action="{{ route('krs.admin') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control form-control-sm me-2" 
                                   placeholder="Cari mahasiswa (Nama/NPM)..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-search me-1"></i> Cari
                            </button>
                            @if(request('search') || request('mahasiswa_id'))
                            <a href="{{ route('krs.admin') }}" class="btn btn-secondary btn-sm ms-2">
                                <i class="fas fa-sync-alt me-1"></i> Reset
                            </a>
                            @endif
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form action="{{ route('krs.admin') }}" method="GET">
                            <select name="mahasiswa_id" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">-- Filter Berdasarkan Mahasiswa --</option>
                                @foreach($mahasiswa as $mhs)
                                <option value="{{ $mhs->npm }}" {{ request('mahasiswa_id') == $mhs->npm ? 'selected' : '' }}>
                                    {{ $mhs->npm }} - {{ $mhs->nama }}
                                </option>
                                @endforeach
                            </select>
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
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
                                <th width="15%">Dosen Wali</th>
                                <th width="10%">Kode MK</th>
                                <th width="20%">Mata Kuliah</th>
                                <th width="5%" class="text-center">SKS</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($krsList as $index => $krs)
                            <tr>
                                <td class="text-center">{{ ($krsList->currentPage() - 1) * $krsList->perPage() + $loop->iteration }}</td>
                                <td><strong>{{ $krs->mahasiswa->npm ?? '-' }}</strong></td>
                                <td>{{ $krs->mahasiswa->nama ?? '-' }}</td>
                                <td>
                                    @if($krs->mahasiswa && $krs->mahasiswa->dosen)
                                        <span class="badge bg-info bg-opacity-10 text-info">
                                            <i class="fas fa-chalkboard-user me-1"></i>
                                            {{ $krs->mahasiswa->dosen->nama }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $krs->matakuliah->kode_matakuliah ?? '-' }}</td>
                                <td>{{ $krs->matakuliah->nama_matakuliah ?? '-' }}</td>
                                <td class="text-center">
                                    @if($krs->matakuliah)
                                        <span class="badge bg-primary bg-opacity-10 text-primary">
                                            {{ $krs->matakuliah->sks }} SKS
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" 
                                            onclick="confirmDelete('{{ $krs->id }}', '{{ addslashes($krs->matakuliah->nama_matakuliah ?? 'Mata Kuliah') }}', '{{ addslashes($krs->mahasiswa->nama ?? '-') }}')">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                    <form id="delete-form-{{ $krs->id }}" action="{{ route('krs.destroy', $krs->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada data KRS
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $krsList->appends(request()->query())->links('pagination::bootstrap-5') }}
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
                    <i class="fas fa-trash-alt fa-4x text-danger"></i>
                </div>
                <h5 class="mb-2">Yakin ingin membatalkan KRS ini?</h5>
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

@push('scripts')
<script>
    let deleteId = null;
    
    function confirmDelete(id, matkul, mahasiswa) {
        deleteId = id;
        document.getElementById('deleteMessage').innerHTML = `Apakah Anda yakin ingin membatalkan KRS <strong class="text-danger">${matkul}</strong><br>untuk mahasiswa <strong class="text-danger">${mahasiswa}</strong>?<br><small class="text-muted">Data yang dihapus tidak dapat dikembalikan!</small>`;
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