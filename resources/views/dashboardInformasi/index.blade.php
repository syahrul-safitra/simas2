@extends('layouts.main')

@section('container')
    <div class="col-12">
        <h4><i class="far fa-newspaper me-2"></i>Informasi</h4>
        {{-- pesan success input data :  --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="bg-light rounded h-100 p-4">
            <div class="table-responsive">
                <table class="table table-hover" style="color:black" id="table-instansi">
                    <a href="{{ url('dashboard/informasi/create') }} " class="btn btn-primary mb-3"><i
                            class="bi bi-plus-circle me-2"></i></i>Buat Informasi</a>
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($informasis as $key => $informasi)
                            <tr>
                                {{-- <th scope="row">{{ $informasis->firstItem() + $key }}</th> --}}
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $informasi->deskripsi }}</td>
                                <td>{{ $informasi->tujuan }}</td>
                                <td>
                                    <div class="d-flex gap-4">

                                        <a class="fs-4" style="color: red" href="{!! asset('file/' . $informasi->file) !!}"><i
                                                class="bi bi-file-earmark-pdf-fill"></i></a>

                                        <form action="{{ url('dashboard/informasi/' . $informasi->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-delete-informasi"
                                                style="padding-top: 2px; padding-bottom: 2px; padding-left: 5px; padding-right: 5px">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
