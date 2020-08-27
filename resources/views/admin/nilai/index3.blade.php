@extends('admin.layout')

@section('custom-style')
    <style>
        .nilai-akademik thead th{
            border: 1px solid grey !important; 
            vertical-align: middle;
            text-align: center;
        }
        .nilai-akademik tbody td{
            text-align: center;
        }
    </style>
@endsection

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
            <h1 class="h3 display">List Data Nilai Akademik </h1>
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
                            {{$siswa->nama}}
                        </h4>
                        <div style="float:right">
                            <a href="{{route('nilai.siswa.create',$siswa->id)}}" class="btn btn-primary btn-sm">Tambah</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-striped nilai-akademik">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" rowspan="2">#</th>
                                        <th rowspan="2">Semester</th>
                                        <th rowspan="2">Tahun</th>
                                        <th class="text-center" colspan="3">Total</th>
                                        <th class="text-center" colspan="3">rata-rata</th>
                                        <th rowspan="2">Predikat</th>
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>Pengetahuan</th>
                                        <th>Keterampilan</th>
                                        <th>Nilai Akhir</th>
                                        <th>Pengetahuan</th>
                                        <th>Keterampilan</th>
                                        <th>Nilai Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x=1;?>
                                    @foreach ($records as $item)
                                    <tr>
                                        <td scope="row">{{$x++}}</th>
                                        <td>{{$item->semester}}</td>
                                        <td>{{$item->tahun}}</td>
                                        <td>{{$item->sum_pengetahuan}}</td>
                                        <td>{{$item->sum_keterampilan}}</td>
                                        <td>{{$item->sum_nilai_akhir}}</td>
                                        <td>{{$item->avg_pengetahuan}}</td>
                                        <td>{{$item->avg_keterampilan}}</td>
                                        <td>{{$item->avg_nilai_akhir}}</td>
                                        <td>{{$item->avg_predikat}}</td>
                                        <td>
                                            <form class="btn-group" role="group" aria-label="Basic example" action="{{ route('nilai-akademik.destroy',$item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Apakah anda yakin?')"
                                                    class="btn btn-danger btn-sm"><i
                                                        class="fa fa-trash"></i></button>
                                                <a href="{{route('nilai-akademik.edit',$item->id)}}"
                                                    class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('nilai-akademik.show',$item->id)}}"
                                                    class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('raport.create',$item->id)}}"
                                                    class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
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