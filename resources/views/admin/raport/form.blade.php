        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#nilai">Nilai Akademik</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pkl">PKL</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#ekskul">Ekstrakurikuler</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#lainnya">Lainnya</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane container active" id="nilai">
                <div class="table-responsive">
                    @include('admin.raport.nilai_akademik')
                    <br>
                </div>
            </div>
            <div class="tab-pane container" id="pkl">
                <div style="margin: 20px 0px">
                    @for ($i = 1; $i <= 3; $i++)
                    <div class="form-group">
                        <label>{{$i}}. Mitra DU/DI</label>
                        <select name="pkl[{{$i}}]" class="custom-select">
                            @isset($raport)
                            @foreach ($pkl as $item)
                            <option value={{$item->id}} @if($item->id==$raport->prodi_id)
                                selected @endif>{{$item->mitra}}</option>
                            @endforeach
                            @else
                            <option value='' selected disabled>--Pilih--</option>
                            @foreach ($pkl  as $item)
                            <option value={{$item->id}}>{{$item->mitra}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lama PKL (bulan)</label>
                        @isset($raport)
                        <input type="number" name="lamanya[{{$i}}]" class="form-control" min="0"
                            value="{{old('lamanya['.$i.']', $raport->PKLsiswa->hasilPKL->find($item->id)->pivot->lamanya ?? 0)}}" placeholder="masukan jumlah bulan">
                        @endisset
                        <input type="number" name="lamanya[{{$i}}]" class="form-control" min="0"
                            value="{{old('lamanya['.$i.']', 0)}}" placeholder="masukan jumlah bulan">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        @isset($raport)
                        <textarea name="keterangan[{{$i}}]" class="form-control" id="" cols="30" rows="2">{{old('keterangan['.$i.']', $raport->PKLsiswa->hasilPKL->find($item->id)->pivot->keterangan ?? 0)}}</textarea>
                        @endisset
                        <textarea name="keterangan[{{$i}}]" class="form-control" id="" cols="30" rows="2">{{old('keterangan['.$i.']', "")}}</textarea>
                    </div>
                    <br>
                    @endfor
                </div>
            </div>
            <div class="tab-pane container" id="ekskul">
                <div style="margin: 20px 0px">
                    @for ($i = 1; $i <= 3; $i++)
                    <div class="form-group">
                        <label>{{$i}}. Kegiatan Ekstrakurikuler</label>
                        <select name="ekskul[{{$i}}]" class="custom-select">
                            @isset($raport)
                            @foreach ($ekskul as $item)
                            <option value={{$item->id}} @if($item->id==$raport->prodi_id)
                                selected @endif>{{$item->nama}}</option>
                            @endforeach
                            @else
                            <option value='' selected disabled>--Pilih--</option>
                            @foreach ($ekskul  as $item)
                            <option value={{$item->id}}>{{$item->nama}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        @isset($raport)
                        <textarea name="keterangan2[{{$i}}]" class="form-control" id="" cols="30" rows="2">{{old('keterangan2['.$i.']', $raport->PKLsiswa->hasilPKL->find($item->id)->pivot->keterangan ?? 0)}}</textarea>
                        @endisset
                        <textarea name="keterangan2[{{$i}}]" class="form-control" id="" cols="30" rows="2">{{old('keterangan2['.$i.']', "")}}</textarea>
                    </div>
                    <br>
                    @endfor
                </div>
            </div>
            <div class="tab-pane container" id="lainnya">
                <div style="margin: 20px 0px">
                    <div class="form-group">
                        <label>Catatan Akademik</label>
                        <textarea class="form-control" name="cat_akademik" id="" cols="30" rows="2">{{old('cat_akademik', $raport->cat_akademik ?? '')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Izin</label>
                        <input class="form-control" type="number" name="izin" min="1" value="{{old('izin', $raport->izin ?? '')}}">
                    </div>
                    <div class="form-group">
                        <label>Sakit</label>
                        <input class="form-control" type="number" name="sakit" min="1" value="{{old('sakit', $raport->sakit ?? '')}}">
                    </div>
                    <div class="form-group">
                        <label>Tanpa Keterangan</label>
                        <input class="form-control" type="number" name="tanpa_ket" min="1" value="{{old('tanpa_ket', $raport->tanpa_ket ?? '')}}">
                    </div>
                    <div class="form-group">
                        <label>Keterangan Kenaikan Kelas</label>
                        <textarea class="form-control" name="keterangan_kenaikan" id="" cols="30" rows="2">{{old('keterangan_kenaikan', $raport->keterangan_kenaikan ?? '')}}</textarea>
                    </div>
                    {{-- <div class="form-group">
                        <label>Kenaikan Kelas</label>
                        <select name="kenaikan_kelas" class="custom-select">
                            <option value='' selected disabled>Pilih</option>
                            @isset($raport)
                            @foreach ($kenaikan as $item)
                            <option value={{$item}} @if($item==$raport->kenaikan_kelas)
                                selected @endif>{{$item}}</option>
                            @endforeach
                            @else
                            @foreach ($kenaikan as $item)
                            <option value={{$item}}>{{$item}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div> --}}
                </div>
            </div>
        </div>

