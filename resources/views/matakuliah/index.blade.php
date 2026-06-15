@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-book me-2"></i>Data Mata Kuliah</h5>
                <a href="{{ route('matakuliah.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>Tambah Mata Kuliah
                </a>
            </div>
            <div class="card-body">
                <!-- Search -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <form action="{{ route('matakuliah.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control form-control-sm me-2" 
                                   placeholder="Cari mata kuliah..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="20%">Kode MK</th>
                                <th width="45%">Nama Mata Kuliah</th>
                                <th width="10%" class="text-center">SKS</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($matakuliah as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $item->kode_matakuliah }}</td>
                                <td>{{ $item->nama_matakuliah }}</td>
                                <td class="text-center">{{ $item->sks }} SKS</td>
                                <td class="text-center">
                                    <a href="{{ route('matakuliah.edit', $item->kode_matakuliah) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('matakuliah.destroy', $item->kode_matakuliah) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $matakuliah->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection