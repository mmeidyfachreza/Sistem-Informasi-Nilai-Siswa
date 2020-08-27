@extends('admin.layout')

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
                @isset($show)
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Lihat Nilai Akademik</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <p style="color: black;font-weight: bold;">Tgl Pemeriksaan : {{$show->date}}</p>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#lm">Nilai Akademik</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#bd">Praktek Kerja Lapangan</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">

                            <div class="tab-pane container active" id="lm">
                                @include('admin.nilai.nilai_akademik')
                            </div>

                        </div>
                    </div>
                </div>
                @else
                <div class="card">
                    @isset ($record)
                    <div class="card-header d-flex align-items-center">
                        <h4>Ubah Nilai Akademik</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('nilai-akademik.update',$record->id)}}"
                            method="POST">
                            @method('PUT')
                            @else
                            <div class="card-header d-flex align-items-center">
                                <h4>Tambah Nilai Akademik</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('nilai-akademik.store')}}"
                                    method="POST">
                                    @endisset
                                    @csrf
                                    <div class="form-group">
                                        <label>Semester</label>
                                        <input type="number" name="semester" class="form-control"
                                            value="{{old('semester', $record->semester ?? ' ')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <input type="text" name="tahun" class="form-control"
                                            value="{{old('tahun', $record->tahun ?? ' ')}}" required>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#lm">Nilai Akademik</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#bd">Praktek Kerja Lapangan</a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane container active" id="lm">
                                            <div class="table-responsive">
                                                @include('admin.nilai.nilai_akademik')
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="siswa_id" value="{{$siswa->id}}">
                                    <div class="form-group">
                                        <input type="submit" value="Simpan" class="btn btn-primary">
                                        <a href="{{URL::previous()}}" class="btn btn-danger">Batal</a>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
                @endisset
            </div>
        </div>
</section>
@endsection

@section('custom-script')
<script type="text/javascript">
    $(function () {

        $('.pengetahuan[id^="pengetahuan"]').keyup(function () {
            var id = parseInt(this.id.replace("pengetahuan",""),10);
            $('#nilai_akhir'+ id).val((parseFloat(this.value)+parseFloat($('#keterampilan'+ id).val()))/2);
            var nilai_akhir = parseFloat($('#nilai_akhir'+ id).val());
            $('#na'+ id).val(nilai_akhir);
            if (nilai_akhir>=85) {
                $('#predikat'+ id).val("A-");
                $('#pd'+ id).val("A-");
            }else if (nilai_akhir>=80) {
                $('#predikat'+ id).val("B+");
                $('#pd'+ id).val("B+");
            }else if (nilai_akhir>=75) {
                $('#predikat'+ id).val("B");
                $('#pd'+ id).val("B");
            }else if (nilai_akhir>=70) {
                $('#predikat'+ id).val("B-");
                $('#pd'+ id).val("B-");
            }else if (nilai_akhir>=60) {
                $('#predikat'+ id).val("C");
                $('#pd'+ id).val("C");
            }else{
                $('#predikat'+ id).val("D");
                $('#pd'+ id).val("D");
            }
            var total = 0;
            var totalNA = 0;
            var count = 0;
            $('.pengetahuan').each(function () {
                total+=parseFloat(this.value);
                count++;
            })
            $('.nilai_akhir').each(function () {
                totalNA+=parseFloat(this.value);
            })
            
            $('#total_pengetahuan').val(total);
            $('#rata_pengetahuan').val(total/count);
            $('#total_nilai_akhir').val(totalNA);
            $('#tp').val(total);
            $('#rp').val(total/count);
            $('#tna').val(totalNA);
            var rna = totalNA/count;
            if (rna>=85) {
                $('#rata_predikat').val("A-");
                $('#rpre').val("A-");
            }else if (rna>=80) {
                $('#rata_predikat').val("B+");
                $('#rpre').val("B+");
            }else if (rna>=75) {
                $('#rata_predikat').val("B");
                $('#rpre').val("B");
            }else if (rna>=70) {
                $('#rata_predikat').val("B-");
                $('#rpre').val("B-");
            }else if (rna>=60) {
                $('#rata_predikat').val("C");
                $('#rpre').val("C");
            }else{
                $('#rata_predikat').val("D");
                $('#rpre').val("D");
            }
            $('#rata_nilai_akhir').val(rna);
            $('#rna').val(rna);
        });

        $('.keterampilan[id^="keterampilan"]').keyup(function () {
            var id = parseInt(this.id.replace("keterampilan",""),10);
            $('#nilai_akhir'+ id).val(parseFloat((parseFloat(this.value)+parseFloat($('#pengetahuan'+ id).val()))/2));
            var nilai_akhir = parseFloat($('#nilai_akhir'+ id).val());
            $('#na'+ id).val(nilai_akhir);
            if (nilai_akhir>=85) {
                $('#predikat'+ id).val("A-");
                $('#pd'+ id).val("A-");
            }else if (nilai_akhir>=80) {
                $('#predikat'+ id).val("B+");
                $('#pd'+ id).val("B+");
            }else if (nilai_akhir>=75) {
                $('#predikat'+ id).val("B");
                $('#pd'+ id).val("B");
            }else if (nilai_akhir>=70) {
                $('#predikat'+ id).val("B-");
                $('#pd'+ id).val("B-");
            }else if (nilai_akhir>=60) {
                $('#predikat'+ id).val("C");
                $('#pd'+ id).val("C");
            }else{
                $('#predikat'+ id).val("D");
                $('#pd'+ id).val("D");
            }
            
            var total = 0;
            var totalNA = 0;
            var count = 0;
            $('.keterampilan').each(function () {
                total+=parseFloat(this.value);
                count++;
            })
            $('.nilai_akhir').each(function () {
                totalNA+=parseFloat(this.value);
            })
            $('#total_keterampilan').val(total);
            $('#tk').val(total);
            $('#rata_keterampilan').val(total/count);
            $('#rk').val(total/count);
            $('#total_nilai_akhir').val(totalNA);
            $('#tna').val(totalNA);
            var rna = totalNA/count;
            if (rna>=85) {
                $('#rata_predikat').val("A-");
                $('#rpre').val("A-");
            }else if (rna>=80) {
                $('#rata_predikat').val("B+");
                $('#rpre').val("B+");
            }else if (rna>=75) {
                $('#rata_predikat').val("B");
                $('#rpre').val("B");
            }else if (rna>=70) {
                $('#rata_predikat').val("B-");
                $('#rpre').val("B-");
            }else if (rna>=60) {
                $('#rata_predikat').val("C");
                $('#rpre').val("C");
            }else{
                $('#rata_predikat').val("D");
                $('#rpre').val("D");
            }
            $('#rata_nilai_akhir').val(rna);
            $('#rna').val(rna);
        });


    })
    $(window).on('load', function () {
            var totalP = 0;
            var totalK = 0;
            var totalNA = 0;
            var countP = 0;
            var countK = 0;
            $('.pengetahuan').each(function () {
                totalP+=parseFloat(this.value);
                countP++;
            })
            $('.keterampilan').each(function () {
                totalK+=parseFloat(this.value);
                countK++;
            })
            $('.nilai_akhir').each(function () {
                totalNA+=parseFloat(this.value);
            })
            
            $('#total_pengetahuan').val(totalP);
            $('#total_keterampilan').val(totalK);
            $('#rata_pengetahuan').val(totalP/countP);
            $('#rata_keterampilan').val(totalK/countK);
            $('#total_nilai_akhir').val(totalNA);
            $('#tp').val(totalP);
            $('#rp').val(totalP/countP);
            $('#tk').val(totalK);
            $('#rk').val(totalK/countK);
            $('#tna').val(totalNA);
            var rna = totalNA/countP;
            if (rna>=85) {
                $('#rata_predikat').val("A-");
                $('#rpre').val("A-");
            }else if (rna>=80) {
                $('#rata_predikat').val("B+");
                $('#rpre').val("B+");
            }else if (rna>=75) {
                $('#rata_predikat').val("B");
                $('#rpre').val("B");
            }else if (rna>=70) {
                $('#rata_predikat').val("B-");
                $('#rpre').val("B-");
            }else if (rna>=60) {
                $('#rata_predikat').val("C");
                $('#rpre').val("C");
            }else{
                $('#rata_predikat').val("D");
                $('#rpre').val("D");
            }
            $('#rata_nilai_akhir').val(rna);
            $('#rna').val(rna);
    });

</script>
@endsection
