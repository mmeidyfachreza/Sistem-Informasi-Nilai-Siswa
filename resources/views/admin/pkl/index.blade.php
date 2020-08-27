@extends('admin.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">PKL </li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">Praktik Kerja Lapangan </h1>
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
                        <h4 style="float:left"></h4>
                        <div style="float:right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('pkl.create')}}" class="btn btn-primary btn-sm">Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mitra</th>
                                        <th>Lokasi</th>
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
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax:"{{ route('pkl.index') }}",
            columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable:false, orderable:false},
            {data: 'mitra', name: 'mitra'},
            {data: 'lokasi', name: 'lokasi'},
            {data: 'action', name: 'action', searchable:false, orderable:false},
            ]
        });

        $('body').on('click', '.deleteProduct', function () { 
            var data_id = $(this).data("id");
            confirm("Apakah anda yakin untuk menghapus!");
            var url = '{{ route("pkl.destroy", ":id") }}';
            url = url.replace(':id', data_id );
            $.ajax({
                type: "DELETE",
                url: url,
                
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    })
</script>
@endsection