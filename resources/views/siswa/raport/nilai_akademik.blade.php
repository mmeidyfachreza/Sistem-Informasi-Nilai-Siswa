    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Mata Pelajran</th>
                <th>Pengetahuan</th>
                <th>Keterampilan</th>
                <th>Nilai Akhir</th>
                <th>Predikat</th>
            </tr>
        </thead>
        <tbody>
            <?php $x=1;?>
            @isset($record)
            @foreach ($matapelajaran as $item)
            <tr>
                <td>{{$x++}}</td>
                <td>{{$item->nama}}</td>
                <td class="text-center" >{{$record->nilaiMaPel->find($item->id)->pivot->pengetahuan ?? 0}}</td>
                <td class="text-center" >{{$record->nilaiMaPel->find($item->id)->pivot->keterampilan ?? 0}}</td>
                <td class="text-center" >{{$record->nilaiMaPel->find($item->id)->pivot->nilai_akhir ?? 0}}</td>
                <td class="text-center" >{{$record->nilaiMaPel->find($item->id)->pivot->predikat ?? 0}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" class="text-center">Jumlah</td>
                <td class="text-center" >{{$record->sum_pengetahuan}}</td>
                <td class="text-center" >{{$record->sum_keterampilan}}</td>
                <td class="text-center" >{{$record->sum_nilai_akhir}}</td>
                <td class="text-center" ></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">Rata-rata</td>
                <td class="text-center" >{{$record->avg_pengetahuan}}</td>
                <td class="text-center" >{{$record->avg_keterampilan}}</td>
                <td class="text-center" >{{$record->avg_nilai_akhir}}</td>
                <td class="text-center" >{{$record->avg_predikat}}</td>
            </tr>
            @else
                
            @endisset
        </tbody>
    </table>

