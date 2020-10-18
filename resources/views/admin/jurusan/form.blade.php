
@extends('admin.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Jurusan </li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">Jurusan </h1>
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
                        @isset ($jurusan)
                        <div class="card-header d-flex align-items-center">
                            <h4>Ubah Data Jurusan</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{route('jurusan.update',$jurusan->id)}}" method="POST">
                            @method('PUT')
                            @else
                            <div class="card-header d-flex align-items-center">
                                <h4>Tambah Data Jurusan</h4>
                            </div>
                            <div class="card-body">
                            <form action="{{route('jurusan.store')}}" method="POST">
                                @endisset
                                @csrf
                                <div class="form-group">
                                    <label>Nama Jurusan</label>
                                    <input type="text" name="nama" placeholder="Masukan Nama Jurusan" class="form-control"
                                        value="{{old('nama', $jurusan->nama ?? '')}}" required>
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
