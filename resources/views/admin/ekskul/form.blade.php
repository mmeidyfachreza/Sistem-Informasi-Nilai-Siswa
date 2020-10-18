@extends('admin.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Kegiatan Ekstrakurikuler </li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">Kegiatan Ekstrakurikuler </h1>
        </header>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <li>Proses Gagal!!!</li>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                        @isset ($ekskul)
                        <div class="card-header d-flex align-items-center">
                            <h4>Ubah Data Kegiatan Ekstrakurikuler</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{route('ekskul.update',$ekskul->id)}}" method="POST">
                            @method('PUT')
                            @else
                            <div class="card-header d-flex align-items-center">
                                <h4>Tambah Data Kegiatan Ekstrakurikuler</h4>
                            </div>
                            <div class="card-body">
                            <form action="{{route('ekskul.store')}}" method="POST">
                                @endisset
                                @csrf
                                <div class="form-group">
                                    <label>Nama Kegiatan</label>
                                    <input type="text" name="nama" placeholder="Masukan Nama Kegiatan" class="form-control"
                                        value="{{old('nama', $ekskul->nama ?? '')}}" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="submit" value="Simpan" class="btn btn-primary">
                                    <a href="{{URL::previous()}}" class="btn btn-danger">Batal</a>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
