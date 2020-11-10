<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .identitas .titik-dua {
            text-align: center;
            width: 20%;
        }

        .identitas td.td-head {
            width: 20%;
        }

        .nilai-akademik table,
        .pkl table,
        .ekskul table,
        .ttd table {
            width: 100%;
            border-collapse: collapse;
        }

        .ketidakhadiran table {
            width: 50%;
            border-collapse: collapse;
        }

        .nilai-akademik td,
        .nilai-akademik th,
        .pkl td,
        .pkl th,
        .ekskul td,
        .ekskul th,
        .ketidakhadiran td {
            border: 1px solid black;
        }

        .nilai-akademik th,
        .pkl th,
        .ekskul th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
        }

        .nilai-akademik td,
        .pkl td,
        .ekskul td {
            padding: 10px;
        }

        .ketidakhadiran td {
            padding: 1px;
        }

        .catatan-akademik .catatan {
            border: 1px solid black;
            padding: 20px 0px;
        }

        .text-center {
            text-align: center;
        }

        .page1 {
            padding: 10px 30px 25px 60px;
            margin-bottom: 110px;
        }

        .page2 {
            padding: 10px 30px 25px 60px;
            margin-top: 110px;
        }

        body {
            font-size: 12px;
            margin: 0px;
        }

    </style>
</head>

<body>
    <div class="page1">
        <div class="identitas">
            <table>
                <tr>
                    <td class="td-head">Nama Peserta Didik</td>
                    <td class="titik-dua">:</td>
                    <td>{{$raport->nilaiakademik->siswa->nama ?? ''}}</td>
                </tr>
                <tr>
                    <td class="td-head">NISN/NIS</td>
                    <td class="titik-dua">:</td>
                    <td>{{$raport->nilaiakademik->siswa->nisn ?? '-'}} / {{$raport->nilaiakademik->siswa->nis ?? ''}}
                    </td>
                </tr>
                <tr>
                    <td class="td-head">Kelas</td>
                    <td class="titik-dua">:</td>
                    <td>{{$raport->nilaiakademik->siswa->kelas->nama ?? ''}}
                        {{$raport->nilaiakademik->siswa->kelas->jurusan->nama ?? ''}}
                        {{$raport->nilaiakademik->siswa->kelas->nomor ?? ''}}</td>
                </tr>
                <tr>
                    <td class="td-head">Semester</td>
                    <td class="titik-dua">:</td>
                    <td>{{$raport->nilaiakademik->semester ?? ''}}</td>
                </tr>
            </table>
        </div>
        <div class="nilai-akademik">
            <p><b>A. Nilai Akademik</b></p>
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%" class="text-center">No</th>
                        <th class="text-center">Mata Pelajaran</th>
                        <th class="text-center">Pengetahuan</th>
                        <th class="text-center">Keterampilan</th>
                        <th class="text-center">Nilai Akhir</th>
                        <th class="text-center">Predikat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x=1?>
                    @foreach ($matapelajaran as $item)
                    <tr>
                        <td>{{$x++}}</td>
                        <td>{{$item->nama}}</td>
                        @if ($raport->nilaiakademik->nilaiMaPel->find($item->id))
                        <td class="text-center">
                            {{$raport->nilaiakademik->nilaiMaPel->find($item->id)->pivot->pengetahuan}}</td>
                        <td class="text-center">
                            {{$raport->nilaiakademik->nilaiMaPel->find($item->id)->pivot->keterampilan}}</td>
                        <td class="text-center">
                            {{$raport->nilaiakademik->nilaiMaPel->find($item->id)->pivot->nilai_akhir}}</td>
                        <td class="text-center">{{$raport->nilaiakademik->nilaiMaPel->find($item->id)->pivot->predikat}}
                        </td>
                        @else
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @endif
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="text-center">Jumlah</td>
                        <td class="text-center">{{$raport->nilaiakademik->sum_pengetahuan}}</td>
                        <td class="text-center">{{$raport->nilaiakademik->sum_keterampilan}}</td>
                        <td class="text-center">{{$raport->nilaiakademik->sum_nilai_akhir}}</td>
                        <td class="text-center"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">Rata-rata</td>
                        <td class="text-center">{{$raport->nilaiakademik->avg_pengetahuan}}</td>
                        <td class="text-center">{{$raport->nilaiakademik->avg_keterampilan}}</td>
                        <td class="text-center">{{$raport->nilaiakademik->avg_nilai_akhir}}</td>
                        <td class="text-center">{{$raport->nilaiakademik->avg_predikat}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="catatan-akademik">
            <p><b>B. Catatan Akademik</b></p>
            <p class="catatan"><i><b>{{$raport->cat_akademik}}</b></i></p>
        </div>
    </div>
    <br>
    <div class="page2">
        <div class="identitas">
            <table>
                <tr>
                    <td class="td-head">Nama Peserta Didik</td>
                    <td class="titik-dua">:</td>
                    <td>{{$raport->nilaiakademik->siswa->nama ?? ''}}</td>
                </tr>
                <tr>
                    <td class="td-head">NISN/NIS</td>
                    <td class="titik-dua">:</td>
                    <td>{{$raport->nilaiakademik->siswa->nisn ?? '-'}} / {{$raport->nilaiakademik->siswa->nis ?? ''}}
                    </td>
                </tr>
                <tr>
                    <td class="td-head">Kelas</td>
                    <td class="titik-dua">:</td>
                    <td>{{$raport->nilaiakademik->siswa->kelas->nama ?? ''}}
                        {{$raport->nilaiakademik->siswa->kelas->jurusan->nama ?? ''}}
                        {{$raport->nilaiakademik->siswa->kelas->nomor ?? ''}}</td>
                </tr>
                <tr>
                    <td class="td-head">Semester</td>
                    <td class="titik-dua">:</td>
                    <td>{{$raport->nilaiakademik->semester ?? ''}}</td>
                </tr>
            </table>
        </div>
        <div class="pkl">
            <p><b>C. Prakter Kerja Lapangan</b></p>
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%" class="text-center">No</th>
                        <th class="text-center">Mitra DU/DI</th>
                        <th class="text-center">Lokasi</th>
                        <th class="text-center">Lamanya (bulan)</th>
                        <th class="text-center">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x=1 ?>
                    @isset($raport->PKLSiswa)
                    @for ($i = 0; $i < 3; $i++) <tr>
                        <td>{{$x++}}</td>
                        <td>{{$raport->PKLSiswa->hasilPKL->toArray()[$i]['mitra'] ?? ""}}</td>
                        <td>{{$raport->PKLSiswa->hasilPKL->toArray()[$i]['lokasi'] ?? ""}}</td>
                        <td>{{$raport->PKLSiswa->hasilPKL->toArray()[$i]['pivot']['lamanya'] ?? ""}}</td>
                        <td>{{$raport->PKLSiswa->hasilPKL->toArray()[$i]['pivot']['keterangan'] ?? ""}}</td>
                        </tr>
                        @endfor
                        @else
                        @for ($i = 0; $i < 3; $i++) <tr>
                            <td>{{$x++}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            @endfor
                            @endisset
                </tbody>
            </table>
        </div>
        <div class="ekskul">
            <p><b>D. Ekstrakurikuler</b></p>
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%" class="text-center">No</th>
                        <th class="text-center">Kegiatan Ekstrakurikuler</th>
                        <th class="text-center">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x=1 ?>
                    @isset($raport->EkskulSiswa)
                    @for ($i = 0; $i < 3; $i++) <tr>
                        <td>{{$x++}}</td>
                        <td>{{$raport->EkskulSiswa->hasilEkskul->toArray()[$i]['nama'] ?? ""}}</td>
                        <td>{{$raport->EkskulSiswa->hasilEkskul->toArray()[$i]['pivot']['keterangan'] ?? ""}}</td>
                        </tr>
                        @endfor
                        @else
                        @for ($i = 0; $i < 3; $i++) <tr>
                            <td>{{$x++}}</td>
                            <td></td>
                            <td></td>
                            </tr>
                            @endfor
                            @endisset
                </tbody>
            </table>
        </div>
        <div class="ketidakhadiran">
            <p><b>E. Ketidakhadiran</b></p>
            <table>
                <tr>
                    <td>Sakit</td>
                    <td>{{$raport->sakit ?? 0}} Hari</td>
                </tr>
                <tr>
                    <td>Izin</td>
                    <td>{{$raport->izin ?? 0}} Hari</td>
                </tr>
                <tr>
                    <td>Tanpa Keterangan</td>
                    <td>{{$raport->tanpa_ket ?? 0}} Hari</td>
                </tr>
            </table>
        </div>
        <div class="catatan-akademik">
            <p><b>F. Kenaikan Kelas</b></p>
            <p class="catatan"><i><b>{{$raport->keterangan_kenaikan}}</b></i></p>
        </div>
        <div class="ttd">
            <p style="margin-top:0pt; margin-bottom:0pt; line-height:115%; font-size:12px;"><span
                    style="">Mengetahui,</span><span style="width:11.46pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span>
                    <span
                    style="width:36pt; display:inline-block;">&nbsp;</span>
                    <span
                    style="width:36pt; display:inline-block;">&nbsp;</span>

                    <span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span style="">Samarinda,</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; line-height:115%; font-size:12px;"><span style="">Orang
                    Tua/Wali</span><span style="width:30.97pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span>
                    <span
                    style="width:36pt; display:inline-block;">&nbsp;</span>
                    <span
                    style="width:36pt; display:inline-block;">&nbsp;</span>
                    <span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span style="">&nbsp;&nbsp;Wali Kelas</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; line-height:115%; font-size:12px;"><span style="">&nbsp;</span>
            </p>
            <p style="margin-top:0pt; margin-bottom:0pt; line-height:115%; font-size:12px;"><span style="">&nbsp;</span>
            </p>
            <p style="margin-top:0pt; margin-bottom:0pt; line-height:115%; font-size:12px;"><span style="">&nbsp;</span>
            </p>
            <p style="margin-top:0pt; margin-bottom:0pt; line-height:115%; font-size:12px;"><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
                    style="">Mengetahui,</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; line-height:115%; font-size:12px;"><span
                    style="">_______________</span><span style="width:16.23pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
                    style="">Kepala Sekolah</span><span style="width:55pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span
                    style="width:36pt; display:inline-block;">&nbsp;</span><span style=""><u>{{$raport->guru->nama}}</u></span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; line-height:115%; font-size:12px;">
                <span style="width:16.23pt; display:inline-block;">&nbsp;</span>
                <span style="width:36pt; display:inline-block;">&nbsp;</span>
                <span style="width:55pt; display:inline-block;">&nbsp;</span>
                <span style="width:36pt; display:inline-block;">&nbsp;</span>
                <span style="width:36pt; display:inline-block;">&nbsp;</span>
                <span style="width:36pt; display:inline-block;">&nbsp;</span>
                <span style="width:36pt; display:inline-block;">&nbsp;</span>
                <span style="width:36pt; display:inline-block;">&nbsp;</span>
                <span style="width:36pt; display:inline-block;">&nbsp;</span>
                <span style="width:45pt; display:inline-block;">&nbsp;</span>
                <span style="">NIP : {{$raport->guru->nip}}</span>
            </p>
            <p style="margin-top:0pt; margin-bottom:0pt; line-height:115%; font-size:12px;"><span style="">&nbsp;</span>
            </p>
            <p style="margin-top:0pt; margin-bottom:0pt; line-height:115%; font-size:12px;"><span style="">&nbsp;</span>
            </p>
            <p style="margin-top:0pt; margin-bottom:0pt; line-height:115%; font-size:12px;"><span style="">&nbsp;</span>
            </p>
            <p style="margin-top:0pt; margin-bottom:0pt; line-height:115%; font-size:12px;"><span style="">&nbsp;</span>
            </p>
            <p style="text-align:center; margin-bottom:0"><u>{{$kepsek->nama}}</u></p>
            <p style="text-align:center; margin-top:0">NIP : {{$kepsek->nip}}</p>

        </div>

    </div>
    <div>

    </div>
</body>

</html>
