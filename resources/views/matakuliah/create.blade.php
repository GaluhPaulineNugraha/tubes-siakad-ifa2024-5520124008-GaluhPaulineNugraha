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
                        <label>Kode Mata Kuliah</label>
                        <input type="text" name="kode_matakuliah" class="form-control" required maxlength="8">
                    </div>
                    <div class="mb-3">
                        <label>Nama Mata Kuliah</label>
                        <input type="text" name="nama_matakuliah" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>SKS</label>
                        <input type="number" name="sks" class="form-control" required min="1" max="6" value="3">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection