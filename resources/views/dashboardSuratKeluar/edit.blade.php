@extends('layouts.main')

@section('container')
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Surat Keluar</h6>
                <form action="{{ url('dashboard/suratkeluar/' . $suratKeluar->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <!-- row 1 -->
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="kode" class="form-label">Kode Klasifikasi <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_klasifikasi') is-invalid @enderror"
                                name="kode_klasifikasi"
                                value="{{ @old('kode_klasifikasi', $suratKeluar->kode_klasifikasi) }}" id="kode"
                                autocomplete="off">
                            @error('kode_klasifikasi')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="tanggal-surat" class="form-label">Tanggal Surat Keluar <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_surat_keluar') is-invalid @enderror"
                                name="tanggal_surat_keluar"
                                value="{{ @old('tanggal_surat_keluar', $suratKeluar->tanggal_surat_keluar) }}"
                                id="tanggal-surat">
                            @error('tanggal_surat_keluar')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- row 2 -->
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="sifat" class="form-label">Sifat <span class="text-danger">*</span></label>
                            <select class="form-select @error('sifat') is-invalid @enderror" name="sifat" id="sifat">
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
                                        @if ($sifat == $suratKeluar->sifat)
                                            <option value="{{ $sifat }}" selected>{{ $sifat }}</option>
                                        @else
                                            <option value="{{ $sifat }}">{{ $sifat }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            @error('sifat')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="isi" class="form-label">Isi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('isi') is-invalid @enderror" name="isi"
                                value="{{ @old('isi', $suratKeluar->isi) }}" id="isi-diterima">
                            @error('isi')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- row 3 -->
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="tujuan" class="form-label">Tujuan <span class="text-danger">*</span></label>

                            @if ($suratKeluar->surat_masuk_id)
                                <input type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                    name="tujuan" value="{{ @old('tujuan', $suratKeluar->tujuan) }}" id="tujuan"
                                    autocomplete="off" readonly>
                            @else
                                <input type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                    value="{{ @old('tujuan', $suratKeluar->tujuan) }}" name="tujuan">
                            @endif
                            @error('tujuan')
                                <div class="invalid-feedback text-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">

                            @if ($suratKeluar->surat_masuk_id)
                                <label for="tindak-lanjut" class="form-label">Tindak Lanjut Surat Dari</label>
                                <select class="form-select @error('surat_masuk_id') is-invalid @enderror"
                                    name="surat_masuk_id" id="tindak-lanjut">


                                    {{-- @if ($suratKeluar->surat_masuk_id) --}}
                                    <option value="{{ $suratKeluar->surat_masuk_id }}" selected>
                                        {{ $suratKeluar->suratMasuk->no_surat }}
                                    </option>
                                    {{-- @else
                                    <option value="">Pilih</option>
                                @endif --}}


                                    {{-- @if (@old('surat_masuk_id'))
                                    @foreach ($suratMasuks as $suratMasuk->id)
                                        @if (@old('suratMasuk->id') == $suratMasuk->id)
                                            <option value="{{ $suratMasuk->id }}" selected>{{ $suratMasuk->no_surat }}
                                            </option>
                                        @else
                                            <option value="{{ $suratMasuk->id }}">{{ $suratMasuk->no_surat }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="">Pilih</option>
                                    @if ($suratKeluar->surat_masuk_id)
                                        <option value="{{ $suratKeluar->surat_masuk_id }}" selected>
                                            {{ $suratKeluar->suratMasuk->instansi->nama }}</option>
                                    @else
                                        @foreach ($suratMasuks as $suratMasuk)
                                            <option value="{{ $suratMasuk->id }}">{{ $suratMasuk->no_surat }}</option>
                                        @endforeach
                                    @endif
                                @endif --}}
                                </select>
                                @error('sifat')
                                    <div class="invalid-feedback text-red">{{ $message }}</div>
                                @enderror
                            @else
                                <label for="file" class="form-label">File</label>
                                <input class="form-control" type="file" name="file" id="file">
                            @endif

                        </div>
                    </div>

                    <a href="{{ url('dashboard/suratkeluar') }}" class="btn btn-warning me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
