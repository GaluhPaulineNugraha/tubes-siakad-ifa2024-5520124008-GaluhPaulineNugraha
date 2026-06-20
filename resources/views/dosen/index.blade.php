@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-chalkboard-user me-2"></i>Data Dosen</h5>
                <a href="{{ route('dosen.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>Tambah Dosen
                </a>
            </div>
            <div class="card-body">
                <!-- Form Search -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <form action="{{ route('dosen.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control form-control-sm me-2" 
                                   placeholder="Cari dosen..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-search"></i> Cari
                            </button>
                            @if(request('search'))
                            <a href="{{ route('dosen.index') }}" class="btn btn-secondary btn-sm ms-2">
                                <i class="fas fa-sync-alt me-1"></i> Reset
                            </a>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Tabel Data -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="20%">NIDN</th>
                                <th width="55%">Nama Dosen</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dosen as $index => $item)
                            <tr>
                                <td class="text-center">{{ ($dosen->currentPage() - 1) * $dosen->perPage() + $loop->iteration }}</td>
                                <td><strong>{{ $item->nidn }}</strong></td>
                                <td>{{ $item->nama }}</td>
                                <td class="text-center">
                                    <a href="{{ route('dosen.edit', $item->nidn) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $item->nidn }}', '{{ addslashes($item->nama) }}')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                    <form id="delete-form-{{ $item->nidn }}" action="{{ route('dosen.destroy', $item->nidn) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                    <h6>Tidak ada data dosen</h6>
                                    <small>Silakan tambah data baru</small>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $dosen->appends(request()->query())->links('pagination::bootstrap-5') }}
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
                <h5 class="mb-2">Yakin ingin menghapus data ini?</h5>
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
    
    function confirmDelete(id, nama) {
        deleteId = id;
        document.getElementById('deleteMessage').innerHTML = `Apakah Anda yakin ingin menghapus dosen <strong class="text-danger">${nama}</strong>?<br><small class="text-muted">Data yang dihapus tidak dapat dikembalikan!</small>`;
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