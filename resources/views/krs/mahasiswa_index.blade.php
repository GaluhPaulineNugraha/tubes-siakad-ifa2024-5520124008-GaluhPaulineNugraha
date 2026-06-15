@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Kartu Rencana Studi (KRS)</h5>
                <div>
                    <a href="{{ route('krs.export.pdf') }}" class="btn btn-danger btn-sm me-2">
                        <i class="fas fa-file-pdf me-1"></i>Export PDF
                    </a>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ambilMatkulModal">
                        <i class="fas fa-plus me-1"></i>Ambil Mata Kuliah
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Statistik -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="stat-card p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; color: white;">
                            <i class="fas fa-book fa-2x mb-2"></i>
                            <h3 class="mb-0">{{ $krsList->count() }}</h3>
                            <small>Total Mata Kuliah</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card p-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 12px; color: white;">
                            <i class="fas fa-star fa-2x mb-2"></i>
                            <h3 class="mb-0">{{ $totalSks }} SKS</h3>
                            <small>Total SKS</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card p-3" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px; color: white;">
                            <i class="fas fa-chart-line fa-2x mb-2"></i>
                            <h3 class="mb-0">24 SKS</h3>
                            <small>Maksimal SKS</small>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar" style="background: white; width: {{ min(100, ($totalSks/24)*100) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tabel KRS -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="15%">Kode MK</th>
                                <th width="50%">Mata Kuliah</th>
                                <th width="10%" class="text-center">SKS</th>
                                <th width="15%" class="text-center">Tanggal Ambil</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($krsList as $index => $krs)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td><strong>{{ $krs->matakuliah->kode_matakuliah ?? '-' }}</strong></td>
                                <td>{{ $krs->matakuliah->nama_matakuliah ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        {{ $krs->matakuliah->sks ?? '-' }} SKS
                                    </span>
                                </td>
                                <td class="text-center">{{ $krs->created_at ? $krs->created_at->format('d/m/Y') : '-' }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" 
                                            onclick="confirmDelete('{{ $krs->id }}', '{{ addslashes($krs->matakuliah->nama_matakuliah ?? 'Mata Kuliah') }}')">
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
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                    <h6>Belum ada mata kuliah yang diambil</h6>
                                    <small>Silakan ambil mata kuliah melalui tombol di atas</small>
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

<!-- Modal Ambil Mata Kuliah -->
<div class="modal fade" id="ambilMatkulModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Ambil Mata Kuliah</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('krs.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    @if($ambilMatkul->count() > 0)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Mata Kuliah</label>
                            <select name="kode_matakuliah" class="form-select" required>
                                <option value="">-- Pilih Mata Kuliah --</option>
                                @foreach($ambilMatkul as $mk)
                                <option value="{{ $mk->kode_matakuliah }}">
                                    {{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                                </option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Tidak ada mata kuliah yang tersedia untuk diambil.
                        </div>
                    @endif
                </div>
                <div class="modal-footer border-0 pb-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    @if($ambilMatkul->count() > 0)
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Ambil
                        </button>
                    @endif
                </div>
            </form>
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
    
    function confirmDelete(id, matkul) {
        deleteId = id;
        document.getElementById('deleteMessage').innerHTML = `Apakah Anda yakin ingin membatalkan KRS <strong class="text-danger">${matkul}</strong>?<br><small class="text-muted">Data yang dihapus tidak dapat dikembalikan!</small>`;
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