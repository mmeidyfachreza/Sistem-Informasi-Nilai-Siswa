@extends('admin.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Mata Pelajaran </li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">Mata Pelajaran </h1>
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
                        @isset ($matapelajaran)
                        <div class="card-header d-flex align-items-center">
                            <h4>Ubah Data Mata Pelajaran</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{route('matapelajaran.update',$matapelajaran->id)}}" method="POST">
                            @method('PUT')
                            @else
                            <div class="card-header d-flex align-items-center">
                                <h4>Tambah Data Mata Pelajaran</h4>
                            </div>
                            <div class="card-body">
                            <form action="{{route('matapelajaran.store')}}" method="POST">
                                @endisset
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" placeholder="Masukan Nama Matapelajaran" class="form-control"
                                        value="{{old('nama', $matapelajaran->nama ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Guru</label>
                                    <select name="guru_id" class="custom-select">
                                        @isset($matapelajaran)
                                        @foreach ($guru as $item)
                                        <option value={{$item->id}} @if($item->id==$matapelajaran->guru_id)
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
                                    <label>Semester</label>
                                    <input type="number" name="semester" placeholder="Masukan Angka Semester" class="form-control"
                                        value="{{old('semester', $matapelajaran->semester ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <select name="jenis" class="custom-select">
                                        <option value='' selected disabled>Pilih</option>
                                        @isset($siswa)
                                        @foreach ($jenis as $item)
                                        <option value={{$item}} @if($item==$matapelajaran->jenis)
                                            selected @endif>{{$item}}</option>
                                        @endforeach
                                        @else
                                        @foreach ($jenis as $item)
                                        <option value={{$item}}>{{$item}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sub Jenis</label>
                                    <select name="sub_jenis" class="custom-select">
                                        <option value='' selected disabled>Pilih</option>
                                        @isset($siswa)
                                        @foreach ($sub_jenis as $item)
                                        <option value={{$item}} @if($item==$matapelajaran->sub_jenis)
                                            selected @endif>{{$item}}</option>
                                        @endforeach
                                        @else
                                        @foreach ($sub_jenis as $item)
                                        <option value={{$item}}>{{$item}}</option>
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
