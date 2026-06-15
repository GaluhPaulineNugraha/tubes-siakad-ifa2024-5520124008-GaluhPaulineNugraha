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
                        <label>Kode Mata Kuliah</label>
                        <input type="text" name="kode_matakuliah" class="form-control" value="{{ $matakuliah->kode_matakuliah }}" required maxlength="8" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Nama Mata Kuliah</label>
                        <input type="text" name="nama_matakuliah" class="form-control" value="{{ $matakuliah->nama_matakuliah }}" required>
                    </div>
                    <div class="mb-3">
                        <label>SKS</label>
                        <input type="number" name="sks" class="form-control" value="{{ $matakuliah->sks }}" required min="1" max="6">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection