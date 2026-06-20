@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Tambah Dosen</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dosen.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">NIDN <span class="text-danger">*</span></label>
                        <input type="text" name="nidn" class="form-control @error('nidn') is-invalid @enderror" 
                               value="{{ old('nidn') }}" required maxlength="10" placeholder="10 Digit NIDN">
                        @error('nidn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                               value="{{ old('nama') }}" required placeholder="Nama lengkap dosen">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Informasi:</strong>
                        <ul class="mb-0 mt-1">
                            <li>Email akan dibuat otomatis dengan format <strong>nama@gmail.com</strong></li>
                            <li>Akun login akan dibuat dengan password = <strong>NIDN</strong></li>
                            <li>Dosen bisa login menggunakan email dan password NIDN</li>
                        </ul>
                    </div>
                    
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dosen.index') }}" class="btn btn-secondary">
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