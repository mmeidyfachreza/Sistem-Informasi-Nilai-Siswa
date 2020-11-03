
@extends('admin.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Siswa </li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">Siswa </h1>
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
                        @isset ($siswa)
                        <div class="card-header d-flex align-items-center">
                            <h4>Ubah Data Siswa</h4>
                        </div>
                        <div class="card-body">
                        <form enctype="multipart/form-data" action="{{route('siswa.update',$siswa->id)}}" method="POST">
                            @method('PUT')
                            @else
                            <div class="card-header d-flex align-items-center">
                                <h4>Tambah Data Siswa</h4>
                            </div>
                            <div class="card-body">
                            <form enctype="multipart/form-data" action="{{route('siswa.store')}}" method="POST">
                                @endisset
                                @csrf
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input type="text" name="nis" placeholder="Masukan Nomor Induk Siswa" class="form-control"
                                        value="{{old('nis', $siswa->nis ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input type="text" name="nisn" placeholder="Masukan Nomor Induk Nasional Siswa (jika ada)" class="form-control"
                                        value="{{old('nis', $siswa->nisn ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama" placeholder="Masukan Nama Lengkap" class="form-control"
                                        value="{{old('name', $siswa->nama ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Tempat lahir</label>
                                    <input type="text" name="tempat_lahir" placeholder="Masukan Tempat Lahir"
                                        class="form-control" value="{{old('tempat_lahir', $siswa->tempat_lahir ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" value="{{old('tanggal_lahir', $siswa->tanggal_lahir ?? '')}}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" id="" cols="30" rows="5" class="form-control"
                                        required>{{old('alamat', $siswa->alamat ?? '')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" name="nohp" placeholder="Masukan No HP"
                                        class="form-control" value="{{old('nohp', $siswa->nohp ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="email" placeholder="Masukan Username"
                                        class="form-control" value="{{old('email', $siswa->user->email ?? '')}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Masukan Password" class="form-control" @empty($siswa) required @endisset  autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="custom-select">
                                        <option value='' selected disabled>Pilih</option>
                                        @isset($siswa)
                                        @foreach ($gender as $item)
                                        <option value={{$item}} @if($item==$siswa->jenis_kelamin)
                                            selected @endif>{{$item}}</option>
                                        @endforeach
                                        @else
                                        @foreach ($gender as $item)
                                        <option value={{$item}}>{{$item}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select name="kelas_id" class="custom-select">
                                        @isset($siswa)
                                        @foreach ($kelas as $item)
                                        <option value={{$item->id}} @if($item->id==$siswa->kelas_id)
                                            selected @endif>{{$item->nama}} {{$item->jurusan->nama}} {{$item->nomor}}</option>
                                        @endforeach
                                        @else
                                        <option value='' selected disabled>--Pilih--</option>
                                        @foreach ($kelas  as $item)
                                        <option value={{$item->id}}>{{$item->nama}} {{$item->jurusan->nama}} {{$item->nomor}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <select name="jurusan_id" class="custom-select">
                                        @isset($siswa)
                                        @foreach ($jurusan as $item)
                                        <option value={{$item->id}} @if($item->id==$siswa->jurusan_id)
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
                                    <label>Tanggal Diterima</label>
                                    <input type="date" name="tanggal_masuk" class="form-control" value="{{old('tanggal_masuk', $siswa->tanggal_masuk ?? '')}}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Angkatan Tahun</label>
                                    <input type="text" name="angkatan_thn" placeholder="Masukan Tahun"
                                        class="form-control" value="{{old('angkatan_thn', $siswa->angkatan_thn ?? '')}}" required>
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
