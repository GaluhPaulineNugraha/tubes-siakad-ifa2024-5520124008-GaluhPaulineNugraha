@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Jadwal Perkuliahan</h5>
            </div>
            <div class="card-body">
                <!-- TAMPILKAN ERROR BENTROK -->
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Mata Kuliah <span class="text-danger">*</span></label>
                            <select name="kode_matakuliah" class="form-select @error('kode_matakuliah') is-invalid @enderror" required>
                                <option value="">-- Pilih Mata Kuliah --</option>
                                @foreach($matakuliah as $mk)
                                <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah', $jadwal->kode_matakuliah) == $mk->kode_matakuliah ? 'selected' : '' }}>
                                    {{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                                </option>
                                @endforeach
                            </select>
                            @error('kode_matakuliah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Dosen Pengajar <span class="text-danger">*</span></label>
                            <select name="nidn" class="form-select @error('nidn') is-invalid @enderror" required>
                                <option value="">-- Pilih Dosen --</option>
                                @foreach($dosen as $d)
                                <option value="{{ $d->nidn }}" {{ old('nidn', $jadwal->nidn) == $d->nidn ? 'selected' : '' }}>
                                    {{ $d->nidn }} - {{ $d->nama }}
                                </option>
                                @endforeach
                            </select>
                            @error('nidn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Hari <span class="text-danger">*</span></label>
                            <select name="hari" class="form-select @error('hari') is-invalid @enderror" required>
                                <option value="">-- Pilih Hari --</option>
                                <option value="Senin" {{ old('hari', $jadwal->hari) == 'Senin' ? 'selected' : '' }}>Senin</option>
                                <option value="Selasa" {{ old('hari', $jadwal->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="Rabu" {{ old('hari', $jadwal->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="Kamis" {{ old('hari', $jadwal->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="Jumat" {{ old('hari', $jadwal->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                <option value="Sabtu" {{ old('hari', $jadwal->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            </select>
                            @error('hari')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Jam <span class="text-danger">*</span></label>
                            <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror" 
                                   value="{{ old('jam', $jadwal->jam ? date('H:i', strtotime($jadwal->jam)) : '') }}" required>
                            <small class="text-muted">Format: HH:MM (contoh: 08:00, 13:30)</small>
                            @error('jam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Kelas <span class="text-danger">*</span></label>
                            <select name="kelas" class="form-select @error('kelas') is-invalid @enderror" required>
                                <option value="">-- Pilih Kelas --</option>
                                <option value="A" {{ old('kelas', $jadwal->kelas) == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('kelas', $jadwal->kelas) == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ old('kelas', $jadwal->kelas) == 'C' ? 'selected' : '' }}>C</option>
                                <option value="D" {{ old('kelas', $jadwal->kelas) == 'D' ? 'selected' : '' }}>D</option>
                                <option value="E" {{ old('kelas', $jadwal->kelas) == 'E' ? 'selected' : '' }}>E</option>
                            </select>
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">
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