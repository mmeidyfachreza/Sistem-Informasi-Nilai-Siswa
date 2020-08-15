
@extends('layouts.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Prodi </li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">Prodi </h1>
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
                        @isset ($prodi)
                        <div class="card-header d-flex align-items-center">
                            <h4>Ubah Data Prodi</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{route('prodi.update',$prodi->id)}}" method="POST">
                            @method('PUT')
                            @else
                            <div class="card-header d-flex align-items-center">
                                <h4>Tambah Data Prodi</h4>
                            </div>
                            <div class="card-body">
                            <form action="{{route('prodi.store')}}" method="POST">
                                @endisset
                                @csrf
                                <div class="form-group">
                                    <label>Nama Prodi</label>
                                    <input type="text" name="nama" placeholder="Masukan Nama Lengkap" class="form-control"
                                        value="{{old('nama', $prodi->nama ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <select name="jurusan_id" class="custom-select">
                                        @isset($prodi)
                                        @foreach ($jurusan as $item)
                                        <option value={{$item->id}} @if($item->id==$prodi->jurusan_id)
                                            selected @endif>{{$item->nama}}</option>
                                        @endforeach
                                        @else
                                        <option value='' selected disabled>--Pilih--</option>
                                        @foreach ($jurusan  as $item)
                                        <option value={{$item->id}}>{{$item->nama}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kode Label Prodi</label>
                                    <input type="text" name="kode_label_prodi" placeholder="Masukan kode" class="form-control"
                                        value="{{old('kode_label_prodi', $prodi->kode_label_prodi ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Kode Jurusan Prodi</label>
                                    <input type="number" name="kode_jurusan_prodi" placeholder="Masukan kode" class="form-control"
                                        value="{{old('kode_jurusan_prodi', $prodi->kode_jurusan_prodi ?? '')}}" required>
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
