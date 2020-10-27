@extends('admin.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Kepala Sekolah </li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">Kepala Sekolah </h1>
        </header>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Ubah Data Kepala Sekolah</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('kepsek.update')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" placeholder="Masukan Kepala Sekolah" class="form-control"
                                    value="{{old('nama', $kepsek->nama ?? '')}}" required>
                            </div>
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" name="nip" placeholder="Masukan NIP" class="form-control"
                                    value="{{old('nip', $kepsek->nip ?? '')}}" required>
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
