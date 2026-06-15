@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-users me-2"></i>Mahasiswa Bimbingan</h5>
                <small class="text-muted">Dosen: {{ $dosen->nama }}</small>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">NPM</th>
                                <th width="35%">Nama Mahasiswa</th>
                                <th width="20%" class="text-center">Jumlah MK Diambil</th>
                                <th width="20%" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mahasiswa as $index => $mhs)
                            @php
                                $jumlahMK = App\Models\KRS::where('npm', $mhs->npm)->count();
                            @endphp
                            <tr>
                                <td class="text-center">{{ ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() + $loop->iteration }}</td
                                <td><strong>{{ $mhs->npm }}</strong></td
                                <td>{{ $mhs->nama }}</td
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                        {{ $jumlahMK }} Mata Kuliah
                                    </span>
                                </td
                                <td class="text-center">
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                        <i class="fas fa-check-circle me-1"></i> Aktif
                                    </span>
                                </td
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada mahasiswa bimbingan
                                </td
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $mahasiswa->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection