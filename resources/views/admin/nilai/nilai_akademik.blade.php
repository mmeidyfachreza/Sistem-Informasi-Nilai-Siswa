
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Mata Pelajran</th>
                <th>Semester</th>
                <th>Pengetahuan</th>
                <th>Keterampilan</th>
                <th>Nilai Akhir</th>
                <th>Predikat</th>
            </tr>
        </thead>
        <tbody>
                <?php $x=1;?>
                @foreach ($siswa as $item)
                <tr>
                    <td>{{$x}}</td>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->semester}}</td>
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

