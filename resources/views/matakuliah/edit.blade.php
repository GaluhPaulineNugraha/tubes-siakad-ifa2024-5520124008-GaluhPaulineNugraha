@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Mata Kuliah</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('matakuliah.update', $matakuliah->kode_matakuliah) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kode Mata Kuliah</label>
                        <input type="text" name="kode_matakuliah" class="form-control" 
                               value="{{ $matakuliah->kode_matakuliah }}" readonly style="background: #f0f0f0;">
                        <small class="text-muted">Kode tidak dapat diubah</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" name="nama_matakuliah" class="form-control @error('nama_matakuliah') is-invalid @enderror" 
                               value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}" required>
                        @error('nama_matakuliah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">SKS <span class="text-danger">*</span></label>
                        <input type="number" name="sks" class="form-control @error('sks') is-invalid @enderror" 
                               value="{{ old('sks', $matakuliah->sks) }}" required min="1" max="6">
                        @error('sks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection