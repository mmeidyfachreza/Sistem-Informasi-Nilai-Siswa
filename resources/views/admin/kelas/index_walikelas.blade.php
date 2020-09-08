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
            <h1 class="h3 display">List Walikelas </h1>
        </header>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="kelas-table">
                                <thead>
                                    <tr>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Nomor</th>
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
        $('#kelas-table').DataTable({
            processing: true,
            serverSide: true,
            ajax:"{{ route('aaaa') }}",
            columns:[
            {data: 'nama', name: 'nama'},
            {data: 'jurusan', name: 'jurusan'},
            {data: 'nomor', name: 'nomor'},
            {data: 'action', name: 'action', searchable:false, orderable:false},
            ]
        });
    })
</script>
@endsection