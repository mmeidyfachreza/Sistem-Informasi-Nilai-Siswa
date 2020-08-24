
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
            @isset($show)
            @foreach ($matapelajaran as $item)
            <tr>
                <td>{{$x}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->semester}}</td>                
                <td class="nilai-akademik" id="pengetahuan{{$x}}">{{$show->nilaiMaPel->find($item->id)->pivot->pengetahuan ?? 0}}</td>
                <td class="nilai-akademik" id="keterampilan{{$x}}">{{$show->nilaiMaPel->find($item->id)->pivot->keterampilan ?? 0}}</td>
                <td class="nilai-akademik" id="nilai_akhir{{$x}}">{{$show->nilaiMaPel->find($item->id)->pivot->nilai_akhir ?? 0}}</td>
                <td class="nilai-akademik" id="predikat{{$x++}}">{{$show->nilaiMaPel->find($item->id)->pivot->predikat ?? 0}}</td>
            </tr>
            @endforeach
            @else
                <?php $x=1;?>
                @isset($record)
                @foreach ($matapelajaran as $item)
                <tr>
                    <td>{{$x}}</td>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->semester}}</td>
                    <td><input class="pengetahuan" type="string" name="pengetahuan[{{$x}}]" id="pengetahuan{{$x}}" style="width:50px"
                        value="{{old('pengetahuan['.$x.']', $record->nilaiMaPel->find($item->id)->pivot->pengetahuan ?? 0)}}"></td>
                    <td><input class="keterampilan" type="string" name="keterampilan[{{$x}}]" id="keterampilan{{$x}}" style="width:50px"
                        value="{{old('keterampilan['.$x.']', $record->nilaiMaPel->find($item->id)->pivot->keterampilan ?? 0)}}"></td>
                    <td><input class="nilai_akhir" type="string" id="nilai_akhir{{$x}}" style="width:50px" value="{{old('nilai_akhir['.$x.']', $record->nilaiMaPel->find($item->id)->pivot->nilai_akhir ?? 0)}}" disabled></td>
                    <input type="hidden" name="nilai_akhir[{{$x}}]" id="na{{$x}}" value="{{old('nilai_akhir['.$x.']', $record->nilaiMaPel->find($item->id)->pivot->nilai_akhir ?? 0)}}">    
                    
                    <td><input type="string" id="predikat{{$x}}" style="width:50px" value="{{old('predikat['.$x.']', $record->nilaiMaPel->find($item->id)->pivot->predikat ?? " ")}}" disabled></td>
                    <input type="hidden" name="predikat[{{$x}}]" id="pd{{$x}}" value="{{old('predikat['.$x++.']', $record->nilaiMaPel->find($item->id)->pivot->predikat ?? " ")}}">
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-center">Jumlah</td>
                    <td><input type="string" id="total_pengetahuan" style="width:50px" value="0" disabled></td>
                    <input type="hidden" name="sum_pengetahuan" id="tp">
                    <td><input type="string" id="total_keterampilan" style="width:50px" value="0" disabled></td>
                    <input type="hidden" name="sum_keterampilan" id="tk">
                    <td><input type="string" id="total_nilai_akhir" style="width:50px" value="0" disabled></td>
                    <input type="hidden" name="sum_nilai_akhir" id="tna">
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-center">Rata-rata</td>
                    <td><input type="string" id="rata_pengetahuan" style="width:50px" value="0" disabled></td>
                    <input type="hidden" name="avg_pengetahuan" id="rp">
                    <td><input type="string" id="rata_keterampilan" style="width:50px" value="0" disabled></td>
                    <input type="hidden" name="avg_keterampilan" id="rk">
                    <td><input type="string" id="rata_nilai_akhir" style="width:50px" value="0" disabled></td>
                    <input type="hidden" name="avg_nilai_akhir" id="rna">
                    <td><input type="string" id="rata_predikat" style="width:50px" value="" disabled></td>
                    <input type="hidden" name="avg_predikat" id="rpre">
                </tr>
                @else
                @foreach ($matapelajaran as $item)
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
                <tr>
                    <td colspan="3" class="text-center">Jumlah</td>
                    <td><input type="string" id="total_pengetahuan" style="width:50px" value="0" disabled></td>
                    <input type="hidden" name="sum_pengetahuan" id="tp">
                    <td><input type="string" id="total_keterampilan" style="width:50px" value="0" disabled></td>
                    <input type="hidden" name="sum_keterampilan" id="tk">
                    <td><input type="string" id="total_nilai_akhir" style="width:50px" value="0" disabled></td>
                    <input type="hidden" name="sum_nilai_akhir" id="tna">
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-center">Rata-rata</td>
                    <td><input type="string" id="rata_pengetahuan" style="width:50px" value="0" disabled></td>
                    <input type="hidden" name="avg_pengetahuan" id="rp">
                    <td><input type="string" id="rata_keterampilan" style="width:50px" value="0" disabled></td>
                    <input type="hidden" name="avg_keterampilan" id="rk">
                    <td><input type="string" id="rata_nilai_akhir" style="width:50px" value="0" disabled></td>
                    <input type="hidden" name="avg_nilai_akhir" id="rna">
                    <td><input type="string" id="rata_predikat" style="width:50px" value="" disabled></td>
                    <input type="hidden" name="avg_predikat" id="rpre">
                </tr>
                @endisset
            @endisset
        </tbody>
    </table>

