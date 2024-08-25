@extends('layouts.main')

@section('container')
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Surat Masuk</h6>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <form action="{{ url('dashboard/suratmasuk/' . $suratMasuk->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <!-- row 1 -->
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="no-surat" class="form-label">No Surat</label>
                            <input type="text" class="form-control @error('no_surat') is-invalid @enderror"
                                name="no_surat" value="{{ @old('no_surat', $suratMasuk->no_surat) }}" id="no-surat"
                                autocomplete="off">
                            @error('no_surat')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="asal_surat" class="form-label">Asal Surat</label>
                            <input type="text" class="form-control @error('asal_surat') is-invalid @enderror"
                                name="asal_surat" value="{{ old('asal_surat', $suratMasuk->asal_surat) }}">
                            @error('asal_surat')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- row 2 -->
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="tanggal-surat" class="form-label">Tanggal Surat</label>
                            <input type="date" class="form-control @error('tanggal_surat') is-invalid @enderror"
                                name="tanggal_surat" value="{{ @old('tanggal_surat', $suratMasuk->tanggal_surat) }}"
                                id="tanggal-surat">
                            @error('tanggal_surat')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="tanggal-diterima" class="form-label">Tanggal Diterima</label>
                            <input type="date" class="form-control @error('tanggal_diterima') is-invalid @enderror"
                                name="tanggal_diterima"
                                value="{{ @old('tanggal_diterima', $suratMasuk->tanggal_diterima) }}" id="tanggal-diterima">
                            @error('tanggal_diterima')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- row 3 -->
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="sifat" class="form-label">Sifat</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="sifat" id="sifat">
                                @if (@old('sifat'))
                                    @foreach ($sifats as $sifat)
                                        @if (@old('sifat') == $sifat)
                                            <option value="{{ $sifat }}" selected>{{ $sifat }}</option>
                                        @else
                                            <option value="{{ $sifat }}">{{ $sifat }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($sifats as $sifat)
                                        @if ($sifat == $suratMasuk->sifat)
                                            <option value="{{ $sifat }}" selected>{{ $sifat }}</option>
                                        @else
                                            <option value="{{ $sifat }}">{{ $sifat }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            @error('sifat')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="isi" class="form-label">Isi Ringkas</label>
                            <input type="text" class="form-control @error('isi_ringkas') is-invalid @enderror"
                                name="isi_ringkas" value="{{ @old('isi_ringkas', $suratMasuk->isi_ringkas) }}"
                                id="isi">
                            @error('isi_ringkas')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <!-- row 4 -->
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                                @if (@old('status'))
                                    @foreach ($statuss as $status)
                                        @if (@old('status') == $status)
                                            <option value="{{ $status }}" selected>{{ $status }}</option>
                                        @else
                                            <option value="{{ $status }}">{{ $status }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($statuss as $status)
                                        @if ($status == $suratMasuk->status)
                                            <option value="{{ $status }}" selected>{{ $status }}</option>
                                        @else
                                            <option value="{{ $status }}">{{ $status }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            @error('status')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="file" class="form-label">File</label>
                            <input class="form-control" type="file" name="file" id="file">

                        </div>
                        @error('file')
                            <p class="text-red" style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <a href="{{ url('dashboard/suratmasuk') }}" class="btn btn-warning me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
