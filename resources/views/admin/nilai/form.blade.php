        <div class="form-group">
            <label>Tahun</label>
            <input type="text" name="tahun" class="form-control"
                value="{{old('tahun', $record->tahun ?? '')}}" placeholder="masukan tahun" required>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#lm">Nilai Akademik</a>
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
        <input type="hidden" name="semester" value="{{$semester ?? $record->semester}}">
        <div class="form-group">
            <input type="submit" value="Simpan" class="btn btn-primary">
            <a href="{{URL::previous()}}" class="btn btn-danger">Batal</a>
        </div>


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