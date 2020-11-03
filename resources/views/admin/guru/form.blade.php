@extends('admin.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Guru </li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">Guru </h1>
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
                        @isset ($guru)
                        <div class="card-header d-flex align-items-center">
                            <h4>Ubah Data Guru</h4>
                        </div>
                        <div class="card-body">
                        <form enctype="multipart/form-data" action="{{route('guru.update',$guru->id)}}" method="POST">
                            @method('PUT')
                            @else
                            <div class="card-header d-flex align-items-center">
                                <h4>Tambah Data Guru</h4>
                            </div>
                            <div class="card-body">
                            <form enctype="multipart/form-data" action="{{route('guru.store')}}" method="POST">
                                @endisset
                                @csrf
                                <div class="form-group">
                                    <label>Nomor Induk Pegawai</label>
                                    <input type="text" name="nip" placeholder="Masukan Nomor Induk Pegawai" class="form-control"
                                        value="{{old('nip', $guru->nip ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama" placeholder="Masukan Nama Lengkap" class="form-control"
                                        value="{{old('name', $guru->nama ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Tempat lahir</label>
                                    <input type="text" name="tempat_lahir" placeholder="Masukan Tempat Lahir"
                                        class="form-control" value="{{old('tempat_lahir', $guru->tempat_lahir ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" value="{{old('tanggal_lahir', $guru->tanggal_lahir ?? '')}}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" id="" cols="30" rows="5" class="form-control"
                                        required>{{old('alamat', $guru->alamat ?? '')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" name="nohp" placeholder="Masukan No HP"
                                        class="form-control" value="{{old('nohp', $guru->nohp ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="email" placeholder="Masukan Username"
                                        class="form-control" value="{{old('email', $guru->user->email ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Masukan Password" class="form-control" @empty($guru) required @endisset  autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="custom-select">
                                        <option value='' selected disabled>Pilih</option>
                                        @isset($guru)
                                        @foreach ($gender as $item)
                                        <option value={{$item}} @if($item==$guru->jenis_kelamin)
                                            selected @endif>{{$item}}</option>
                                        @endforeach
                                        @else
                                        @foreach ($gender as $item)
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
