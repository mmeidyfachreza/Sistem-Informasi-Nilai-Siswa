@extends('siswa.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Akun </li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">Akun </h1>
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
                    <div class="card-header d-flex align-items-center">
                        <h4>Ubah Data Akun</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('akun.siswa.update',$user->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="email" placeholder="Masukan email" class="form-control"
                                    value="{{old('email', $user->email ?? '')}}" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Masukan password jika ingin dirubah" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="new_confirm_password" placeholder="Masukan lagi password jika ingin dirubah" class="form-control">
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
