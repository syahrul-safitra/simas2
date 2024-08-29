@extends('layouts.main')

@section('container')
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Tambah Informasi</h6>
                <form action="{{ url('dashboard/informasi') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                            id="deskripsi" value="{{ @old('deskripsi') }}" autocomplete="off" autofocus>
                        @error('deskripsi')
                            <div class="invalid-feedback text-red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tujuan" class="form-label">Tujuan</label>
                        <input type="text" class="form-control @error('tujuan') is-invalid @enderror" name="tujuan"
                            id="tujuan" value="{{ @old('tujuan') }}" autocomplete="off">
                        @error('tujuan')
                            <div class="invalid-feedback text-red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="informasi" class="form-label">File</label>
                        <input type="file" class="form-control" name="file">
                        @error('file')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <a href="{{ url('dashboard/informasi') }}" class="btn btn-warning me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
