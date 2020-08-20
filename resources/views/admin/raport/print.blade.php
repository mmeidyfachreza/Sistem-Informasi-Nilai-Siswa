<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .identitas{
            margin: 35px 30px 25px 60px;
        }

        .identitas .titik-dua{
            text-align: center;
            width: 20%;
        }

        .identitas td.td-head{
            width: 20%;
        }

        .nilai-akademik{
            margin: 35px 30px 25px 60px;
        }

        .nilai-akademik table{
            width: 100%;
            border-collapse: collapse;
        }

        .nilai-akademik td, .nilai-akademik th{
            border: 1px solid black;
            padding: 8px;
        }

        .nilai-akademik th{
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
        }

        .nilai-akademik td{
            padding: 12px;
        }

        body{
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="identitas">
        <table>
            <tr>
                <td class="td-head">Nama Peserta Didik</td>
                <td class="titik-dua">:</td>
                <td>Devina Utari</td>
            </tr>
            <tr>
                <td class="td-head">NISN/NIS</td>
                <td class="titik-dua">:</td>
                <td>0033770189 / 18042034</td>
            </tr>
            <tr>
                <td class="td-head">Kelas</td>
                <td class="titik-dua">:</td>
                <td>X Audio Video 2</td>
            </tr>
            <tr>
                <td class="td-head">Semester</td>
                <td class="titik-dua">:</td>
                <td>2 (Dua)</td>
            </tr>
        </table>
    </div>
    <div class="nilai-akademik">
        <p>A. Nilai Akademik</p>
        <table>
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Mata Pelajaran</th>
                    <th class="text-center">Pengetahuan</th>
                    <th class="text-center">Keterampilan</th>
                    <th class="text-center">Nilai Akhir</th>
                    <th class="text-center">Predikat</th>
                </tr>
            </thead>
            <tbody>
                <?php $x=1?>
                <tr>
                    <td>{{$x++}}</td>
                    <td>Pndidikan Agama dan Budi Pekerti</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>