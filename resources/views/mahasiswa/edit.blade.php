@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Mahasiswa</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('mahasiswa.update', $mahasiswa->npm) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">NPM <span class="text-danger">*</span></label>
                            <input type="text" name="npm" class="form-control @error('npm') is-invalid @enderror" 
                                   value="{{ old('npm', $mahasiswa->npm) }}" required maxlength="10">
                            @error('npm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama', $mahasiswa->nama) }}" required>
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
                            <option value="{{ $d->nidn }}" {{ old('nidn', $mahasiswa->nidn) == $d->nidn ? 'selected' : '' }}>
                                {{ $d->nidn }} - {{ $d->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('nidn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
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