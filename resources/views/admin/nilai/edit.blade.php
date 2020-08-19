@extends('layouts.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Nilai Akademik </li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">Nilai Akademik </h1>
        </header>
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="media-body overflow-hidden">
                        <h5 class="card-text mb-0">{{$siswa->nama}}</h5>
                        <p class="card-text text-uppercase">Kelas {{$siswa->kelas->nama ?? ''}}</p>
                        <p class="card-text">NIS: {{$siswa->nis ?? "belum diatur"}}<br></p>
                    </div>
                </div><a href="#" class="tile-link"></a>
            </div>
        </div>
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
                        <h4>Ubah Nilai Akademik</h4>
                    </div>
                    @include('admin.nilai.form')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
