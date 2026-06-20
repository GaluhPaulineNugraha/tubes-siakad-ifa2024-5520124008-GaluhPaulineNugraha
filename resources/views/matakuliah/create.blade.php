@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Tambah Mata Kuliah</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('matakuliah.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kode Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" name="kode_matakuliah" class="form-control @error('kode_matakuliah') is-invalid @enderror" 
                               value="{{ old('kode_matakuliah') }}" required maxlength="8" placeholder="Contoh: IF53401">
                        @error('kode_matakuliah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" name="nama_matakuliah" class="form-control @error('nama_matakuliah') is-invalid @enderror" 
                               value="{{ old('nama_matakuliah') }}" required>
                        @error('nama_matakuliah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">SKS <span class="text-danger">*</span></label>
                        <input type="number" name="sks" class="form-control @error('sks') is-invalid @enderror" 
                               value="{{ old('sks', 3) }}" required min="1" max="6">
                        @error('sks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection