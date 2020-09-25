@extends('admin.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active">Nilai Akademik</li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">List Nilai Akademik </h1>
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
                    <div class="card-header">
                        <h4 style="float:left">
                            {{$kelas->nama}} {{$kelas->jurusan->nama}} {{$kelas->nomor}} | {{$mapel->nama}}
                        </h4>
                        <div style="float:right">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="student-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Semester</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Tahun Angkatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x=1;?>
                                    @forelse ($nilaiakademik as  $angkatan => $nilai_tahun)
                                        @foreach ($nilai_tahun as $tahun => $nilai_semester)
                                            @foreach ($nilai_semester as $semester => $item)
                                            <tr>
                                                <td scope="row">{{$x++}}</th>
                                                <td>{{$semester}}</td>
                                                <td>{{$tahun}}</td>
                                                <td>{{$angkatan}}</td>
                                                <td>
                                                    <form
                                                    action="{{route('nilai-akademik.create',['kelas'=>$kelas->id,'mapel'=>$mapel->id])}}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="tahun" value="{{$tahun}}">
                                                        <input type="hidden" name="semester" value="{{$semester}}">
                                                        <input type="hidden" name="angkatan" value="{{$angkatan}}">
                                                        <button type="submit" class="btn btn-warning btn-sm">Input</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endforeach
                                        @empty
                                        <td colspan="5" class="text-center">Data Kosong</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
