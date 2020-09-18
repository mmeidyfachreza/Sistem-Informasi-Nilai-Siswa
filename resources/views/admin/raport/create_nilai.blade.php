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
            <h1 class="h3 display">Nilai Akademik </h1>
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
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4>Cek Siswa Kelas {{$kelas->nama}} {{$kelas->jurusan->nama}} {{$kelas->nomor}}</h4>
            </div>
            <div class="card-body">
                <form action="{{route('raport.check.nilai',$kelas->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Angkatan Tahun</label>
                        <input type="number" name="angkatan" placeholder="Masukan Tahun" class="form-control"
                            value="{{old('angkatan', $angkatan ?? '')}}" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" value="Cek" class="btn btn-primary">
                    </div>
                </form>
            </div>

        </div>
        @isset($angkatan)
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4>Tambah Data Nilai Akademik Kelas {{$kelas->nama}} {{$kelas->jurusan->nama}} {{$kelas->nomor}} Angkatan {{$angkatan}}</h4>
            </div>
            <div class="card-body">
                <form action="{{route('raport.generate.nilai',$kelas->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Semester</label>
                                <input type="number" name="semester" placeholder="Masukan Semester" class="form-control"
                                    value="{{old('semester', $nilai->semester ?? '')}}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <input type="number" name="tahun" placeholder="Masukan Tahun" class="form-control"
                                    value="{{old('tahun', $nilai->tahun ?? '')}}" required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="angkatan" value="{{$angkatan}}">
                    <br>
                    <div class="table-responsive table-striped">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nis</th>
                                    <th>Nama</th>
                                    <th>Angkatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x=1;?>
                                @foreach ($siswa as $item)
                                <tr>
                                    <td scope="row">{{$x++}}</th>
                                    <td>{{$item->nis}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->angkatan_thn}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>

        </div>
        @endisset
    </div>
</section>
@endsection
