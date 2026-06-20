@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Tambah Mahasiswa</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('mahasiswa.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">NPM <span class="text-danger">*</span></label>
                            <input type="text" name="npm" class="form-control @error('npm') is-invalid @enderror" 
                                   value="{{ old('npm') }}" required maxlength="10" placeholder="10 Digit NPM">
                            @error('npm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Dosen Wali <span class="text-danger">*</span></label>
                        <select name="nidn" class="form-control @error('nidn') is-invalid @enderror" required>
                            <option value="">-- Pilih Dosen Wali --</option>
                            @foreach($dosen as $d)
                            <option value="{{ $d->nidn }}" {{ old('nidn') == $d->nidn ? 'selected' : '' }}>
                                {{ $d->nidn }} - {{ $d->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('nidn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Informasi Akun:</strong>
                        <ul class="mb-0 mt-1">
                            <li>Email akan dibuat otomatis: <strong>nama@gmail.com</strong></li>
                            <li>Password login = <strong>NPM</strong> (contoh: 2024000001)</li>
                            <li>Mahasiswa bisa login menggunakan email dan password NPM</li>
                        </ul>
                    </div>
                    
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
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