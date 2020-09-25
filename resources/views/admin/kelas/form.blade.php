@extends('admin.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Kelas </li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">Kelas </h1>
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
                        @isset ($kelas)
                        <div class="card-header d-flex align-items-center">
                            <h4>Ubah Data Kelas</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{route('kelas.update',$kelas->id)}}" method="POST">
                            @method('PUT')
                            @else
                            <div class="card-header d-flex align-items-center">
                                <h4>Tambah Data Kelas</h4>
                            </div>
                            <div class="card-body">
                            <form action="{{route('kelas.store')}}" method="POST">
                                @endisset
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" placeholder="Masukan Nama Kelas" class="form-control"
                                        value="{{old('nama', $kelas->nama ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Ruang</label>
                                    <input type="number" name="nomor" placeholder="Masukan Nomor Kelas" class="form-control"
                                        value="{{old('nomor', $kelas->nomor ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Walikelas</label>
                                    <select name="guru_id" class="custom-select">
                                        @isset($kelas)
                                        @foreach ($guru as $item)
                                        <option value={{$item->id}} @if($item->id==$kelas->guru_id)
                                            selected @endif>{{$item->nama}}</option>
                                        @endforeach
                                        @else
                                        <option value='' selected disabled>--Pilih--</option>
                                        @foreach ($guru  as $item)
                                        <option value={{$item->id}}>{{$item->nama}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <select name="jurusan_id" class="custom-select">
                                        @isset($kelas)
                                        @foreach ($jurusan as $item)
                                        <option value={{$item->id}} @if($item->id==$kelas->prodi_id)
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
