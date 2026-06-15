@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Nilai Mahasiswa Bimbingan</h5>
                <div>
                    <small class="text-muted">Dosen: {{ $dosen->nama ?? '' }}</small>
                </div>
            </div>
            <div class="card-body">
                <!-- Search Form -->
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
                    <div class="col-md-8 text-end">
                        <small class="text-muted text-success">
                            <i class="fas fa-edit me-1"></i> Mode: Edit (Anda dapat mengedit nilai mahasiswa bimbingan)
                        </small>
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
                                <th width="20%">Mata Kuliah</th>
                                <th width="5%" class="text-center">SKS</th>
                                <th width="10%" class="text-center">Nilai</th>
                                <th width="8%" class="text-center">Grade</th>
                                <th width="12%" class="text-center">Status</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($nilai as $index => $item)
                            @php
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
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editNilaiModal"
                                            data-id="{{ $item->id }}"
                                            data-npm="{{ $item->mahasiswa->npm }}"
                                            data-nama="{{ $item->mahasiswa->nama }}"
                                            data-matkul="{{ $item->matakuliah->nama_matakuliah }}"
                                            data-nilai="{{ $nilaiValue }}">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada data nilai untuk mahasiswa bimbingan Anda
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $nilai->appends(request()->query())->links('pagination::bootstrap-5') }}
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

<!-- Modal Edit Nilai (Hanya untuk Dosen) -->
<div class="modal fade" id="editNilaiModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-warning text-white rounded-top-4">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>Edit Nilai
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editNilaiForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mahasiswa</label>
                        <input type="text" class="form-control" id="editNamaMahasiswa" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mata Kuliah</label>
                        <input type="text" class="form-control" id="editMataKuliah" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nilai <span class="text-danger">*</span></label>
                        <input type="number" name="nilai" id="editNilai" class="form-control" 
                               min="0" max="100" step="1" required>
                        <small class="text-muted">Masukkan nilai antara 0 - 100</small>
                    </div>
                    <div class="alert alert-info mt-2">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Konversi Grade:</strong><br>
                        A (85-100) - Lulus | B (75-84) - Lulus | C (65-74) - Perbaikan | D/E (≤64) - Tidak Lulus
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const editModal = document.getElementById('editNilaiModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const npm = button.getAttribute('data-npm');
            const nama = button.getAttribute('data-nama');
            const matkul = button.getAttribute('data-matkul');
            const nilai = button.getAttribute('data-nilai');
            
            const form = document.getElementById('editNilaiForm');
            form.action = "{{ route('nilai.update', '') }}/" + id;
            
            document.getElementById('editNamaMahasiswa').value = nama + ' (' + npm + ')';
            document.getElementById('editMataKuliah').value = matkul;
            document.getElementById('editNilai').value = nilai;
        });
    }
</script>
@endpush
@endsection