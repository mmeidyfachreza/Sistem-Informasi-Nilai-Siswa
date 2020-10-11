@extends('admin.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Raport </li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">Raport </h1>
        </header>
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="media-body overflow-hidden">
                        <h5 class="card-text mb-0">{{$record->siswa->nama}}</h5>
                        <p class="card-text text-uppercase">Kelas {{$record->siswa->kelas->nama ?? ''}}</p>
                        <p class="card-text">NIS: {{$record->siswa->nis ?? "belum diatur"}}<br></p>
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
                        <h4>Nilai Akademik</h4>
                    </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Semester : {{$record->semester}}</label>
                            </div>
                            <div class="form-group">
                                <label>Tahun : {{$record->tahun}}</label>
                            </div>
                        </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Data Raport</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('raport.store')}}" method="POST">
                            @csrf
                            @include('admin.raport.form')
                            <input type="hidden" name="nilaiakademik_id" value="{{$record->id}}">
                            <input type="hidden" name="kelas_id" value="{{$record->siswa->kelas->id}}">
                            <div class="form-group">
                                <button type="submit" value="Simpan" class="btn btn-primary">Submit</button>
                                <a href="{{URL::previous()}}" class="btn btn-danger">Batal</a>
                            </div>
                        </form>
                    <div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
