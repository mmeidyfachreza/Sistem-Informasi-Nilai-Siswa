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
                <h4>Input Data Nilai Akademik</h4>
            </div>
            <div class="card-body">
                <p>Kelas : {{$kelas->nama}} {{$kelas->jurusan->nama}} {{$kelas->nomor}}</p>
                <p>Mata Pelajaran : {{$mapel->nama}}</p>
                <p>Angkatan : {{$angkatan}}</p>
                <p>Tahun Ajaran : {{$tahun_ajrn}}</p>
                <p>Semester : {{$semester}}</p>
                <form action="{{route('nilai-akademik.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="angkatan" value="{{$angkatan}}">
                    <input type="hidden" name="semester" value="{{$semester}}">
                    <input type="hidden" name="tahun_ajrn" value="{{$tahun_ajrn}}">
                    <input type="hidden" name="mapel" value="{{$mapel->id}}">
                    <input type="hidden" name="kelas" value="{{$kelas->id}}">
                    <br>
                    <div class="table-responsive table-striped">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Siswa</th>
                                    <th>Pengetahuan</th>
                                    <th>Keterampilan</th>
                                    <th>Nilai Akhir</th>
                                    <th>Predikat</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $x=1;?>
                                    @foreach ($nilaiakademik as $item)
                                    <tr>
                                        <td>{{$x}}</td>
                                        <td>{{$item->siswa->nama}}</td>
                                        <td><input class="pengetahuan" type="string" name="pengetahuan[{{$x}}]" id="pengetahuan{{$x}}" style="width:50px" value="0"></td>
                                        <td><input class="keterampilan" type="string" name="keterampilan[{{$x}}]" id="keterampilan{{$x}}" style="width:50px" value="0"></td>
                                        <td><input class="nilai_akhir" type="string" id="nilai_akhir{{$x}}" style="width:50px" value="0" disabled>
                                        <input type="hidden" name="nilai_akhir[{{$x}}]" id="na{{$x}}" value="0">
                                        <td><input type="string" id="predikat{{$x}}" style="width:50px" value="" disabled></td>
                                        <input type="hidden" name="predikat[{{$x}}]" id="pd{{$x++}}" value="D">
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
    </div>
</section>
@endsection
@section('custom-script')
<script type="text/javascript">
    $(function () {

        $('.pengetahuan[id^="pengetahuan"]').keyup(function () {
            var id = parseInt(this.id.replace("pengetahuan", ""), 10);
            $('#nilai_akhir' + id).val((parseInt(this.value) + parseInt($('#keterampilan' + id)
            .val())) / 2);
            var nilai_akhir = parseInt($('#nilai_akhir' + id).val());
            $('#na' + id).val(nilai_akhir);
            if (nilai_akhir >= 85) {
                $('#predikat' + id).val("A-");
                $('#pd' + id).val("A-");
            } else if (nilai_akhir >= 80) {
                $('#predikat' + id).val("B+");
                $('#pd' + id).val("B+");
            } else if (nilai_akhir >= 75) {
                $('#predikat' + id).val("B");
                $('#pd' + id).val("B");
            } else if (nilai_akhir >= 70) {
                $('#predikat' + id).val("B-");
                $('#pd' + id).val("B-");
            } else if (nilai_akhir >= 60) {
                $('#predikat' + id).val("C");
                $('#pd' + id).val("C");
            } else {
                $('#predikat' + id).val("D");
                $('#pd' + id).val("D");
            }
            var total = 0;
            var totalNA = 0;
            var count = 0;
            $('.pengetahuan').each(function () {
                total += parseInt(this.value);
                count++;
            })
            $('.nilai_akhir').each(function () {
                totalNA += parseInt(this.value);
            })

            $('#total_pengetahuan').val(total);
            $('#rata_pengetahuan').val(total / count);
            $('#total_nilai_akhir').val(totalNA);
            $('#tp').val(total);
            $('#rp').val(total / count);
            $('#tna').val(totalNA);
            var rna = totalNA / count;
            if (rna >= 85) {
                $('#rata_predikat').val("A-");
                $('#rpre').val("A-");
            } else if (rna >= 80) {
                $('#rata_predikat').val("B+");
                $('#rpre').val("B+");
            } else if (rna >= 75) {
                $('#rata_predikat').val("B");
                $('#rpre').val("B");
            } else if (rna >= 70) {
                $('#rata_predikat').val("B-");
                $('#rpre').val("B-");
            } else if (rna >= 60) {
                $('#rata_predikat').val("C");
                $('#rpre').val("C");
            } else {
                $('#rata_predikat').val("D");
                $('#rpre').val("D");
            }
            $('#rata_nilai_akhir').val(rna);
            $('#rna').val(rna);
        });

        $('.keterampilan[id^="keterampilan"]').keyup(function () {
            var id = parseInt(this.id.replace("keterampilan", ""), 10);
            $('#nilai_akhir' + id).val(parseInt((parseInt(this.value) + parseInt($(
                '#pengetahuan' + id).val())) / 2));
            var nilai_akhir = parseInt($('#nilai_akhir' + id).val());
            $('#na' + id).val(nilai_akhir);
            if (nilai_akhir >= 85) {
                $('#predikat' + id).val("A-");
                $('#pd' + id).val("A-");
            } else if (nilai_akhir >= 80) {
                $('#predikat' + id).val("B+");
                $('#pd' + id).val("B+");
            } else if (nilai_akhir >= 75) {
                $('#predikat' + id).val("B");
                $('#pd' + id).val("B");
            } else if (nilai_akhir >= 70) {
                $('#predikat' + id).val("B-");
                $('#pd' + id).val("B-");
            } else if (nilai_akhir >= 60) {
                $('#predikat' + id).val("C");
                $('#pd' + id).val("C");
            } else {
                $('#predikat' + id).val("D");
                $('#pd' + id).val("D");
            }

            var total = 0;
            var totalNA = 0;
            var count = 0;
            $('.keterampilan').each(function () {
                total += parseInt(this.value);
                count++;
            })
            $('.nilai_akhir').each(function () {
                totalNA += parseInt(this.value);
            })
            $('#total_keterampilan').val(total);
            $('#tk').val(total);
            $('#rata_keterampilan').val(total / count);
            $('#rk').val(total / count);
            $('#total_nilai_akhir').val(totalNA);
            $('#tna').val(totalNA);
            var rna = totalNA / count;
            if (rna >= 85) {
                $('#rata_predikat').val("A-");
                $('#rpre').val("A-");
            } else if (rna >= 80) {
                $('#rata_predikat').val("B+");
                $('#rpre').val("B+");
            } else if (rna >= 75) {
                $('#rata_predikat').val("B");
                $('#rpre').val("B");
            } else if (rna >= 70) {
                $('#rata_predikat').val("B-");
                $('#rpre').val("B-");
            } else if (rna >= 60) {
                $('#rata_predikat').val("C");
                $('#rpre').val("C");
            } else {
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
            totalP += parseInt(this.value);
            countP++;
        })
        $('.keterampilan').each(function () {
            totalK += parseInt(this.value);
            countK++;
        })
        $('.nilai_akhir').each(function () {
            totalNA += parseInt(this.value);
        })

        $('#total_pengetahuan').val(totalP);
        $('#total_keterampilan').val(totalK);
        $('#rata_pengetahuan').val(totalP / countP);
        $('#rata_keterampilan').val(totalK / countK);
        $('#total_nilai_akhir').val(totalNA);
        $('#tp').val(totalP);
        $('#rp').val(totalP / countP);
        $('#tk').val(totalK);
        $('#rk').val(totalK / countK);
        $('#tna').val(totalNA);
        var rna = totalNA / countP;
        if (rna >= 85) {
            $('#rata_predikat').val("A-");
            $('#rpre').val("A-");
        } else if (rna >= 80) {
            $('#rata_predikat').val("B+");
            $('#rpre').val("B+");
        } else if (rna >= 75) {
            $('#rata_predikat').val("B");
            $('#rpre').val("B");
        } else if (rna >= 70) {
            $('#rata_predikat').val("B-");
            $('#rpre').val("B-");
        } else if (rna >= 60) {
            $('#rata_predikat').val("C");
            $('#rpre').val("C");
        } else {
            $('#rata_predikat').val("D");
            $('#rpre').val("D");
        }
        $('#rata_nilai_akhir').val(rna);
        $('#rna').val(rna);
    });

</script>
@endsection
