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
            <h1 class="h3 display">List Siswa </h1>
        </header>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="student-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nomor</th>
                                        <th>Jurusan</th>
                                        <th>Walikelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-script')
<script>
    $(document).ready(function() {
        $('#student-table').DataTable({
            processing: true,
            serverSide: true,
            ajax:"{{ route('nilai-akademik.index') }}",
            columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable:false, orderable:false},
            {data: 'nama', name: 'nama'},
            {data: 'nomor', name: 'nomor'},
            {data: 'jurusan', name: 'jurusan'},
            {data: 'walikelas', name: 'walikelas'},
            {data: 'action', name: 'action', searchable:false, orderable:false},
            ]
        });
    })
</script>
@endsection
