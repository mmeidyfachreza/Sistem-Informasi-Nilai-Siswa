<?php

namespace App\Http\Controllers;

use App\Ekskul;
use App\EkskulSiswa;
use App\Kelas;
use App\Matapelajaran;
use App\Nilaiakademik;
use App\PKL;
use App\PKLSiswa;
use App\Raport;
use Illuminate\Http\Request;

class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $record = Nilaiakademik::with('siswa')->find($id);
        $matapelajaran = Matapelajaran::where('semester','=',$record->semester)->get();
        $pkl = PKL::all();
        $ekskul = Ekskul::all();
        $kenaikan = ['Naik','Tidak Naik'];
        $kelas = Kelas::all();
    
        return view('admin.raport.create',compact('record','matapelajaran','pkl','ekskul','kenaikan','kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nilaiakademik = Nilaiakademik::find($request->nilaiakademik_id);
        $matapelajaran = Matapelajaran::where('semester','=',$nilaiakademik->semester)->get();
        $list_pkl = PKL::all();
        $list_ekskul = Ekskul::all();

        $raport = Raport::create([
            'nilaiakademik_id' => $nilaiakademik->id,
            'cat_akademik' => $request->cat_akademik,
            'sakit' => $request->sakit,
            'izin' => $request->izin,
            'tanpa_ket' => $request->tanpa_ket,
            'kenaikan_kelas'=>'Naik'
        ]);

        if ($request->pkl) {
            $pkl = PKLSiswa::create([
                'tahun'=>$nilaiakademik->tahun,
                'semester'=>$nilaiakademik->semester,
                'siswa_id'=>$nilaiakademik->siswa_id,
            ]);
            for ($i=1; $i <= count($request->pkl) ; $i++) {
                foreach ($list_pkl as $value) {
                    if ($value->id == $request->pkl[$i]) {
                        $pkl_id_array[$value->id] = [
                            'lamanya' => $request->lamanya[$i],
                            'keterangan' => $request->keterangan[$i],
                        ];
                    }
                }
            }
            $pkl->hasilPKL()->attach($pkl_id_array);
            $raport->pkl_siswa_id = $pkl->id;
        }

        if ($request->ekskul) {
            $ekskul = EkskulSiswa::create([
                'tahun'=>$nilaiakademik->tahun,
                'semester'=>$nilaiakademik->semester,
                'siswa_id'=>$nilaiakademik->siswa_id,
            ]);
            for ($i=1; $i <= count($request->ekskul) ; $i++) {
                foreach ($list_ekskul as $value) {
                    if ($value->id == $request->ekskul[$i]) {
                        $ekskul_id_array[$value->id] = [
                            'keterangan' => $request->keterangan2[$i],
                        ];
                    }
                }
            }
            $ekskul->hasilEkskul()->attach($ekskul_id_array);
            $raport->ekskul_siswa_id = $ekskul->id;
        }
        $raport->save();
        
        $raport = Raport::with('nilaiAkademik')->with('PKLSiswa')->with('EkskulSiswa')->find($raport->id);
        return view('admin.raport.print',compact('raport','matapelajaran'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function show(Raport $raport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function edit(Raport $raport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Raport $raport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Raport $raport)
    {
        //
    }

    public function cetak()
    {
        $raport = Raport::with('nilaiAkademik')->with('PKLSiswa')->with('EkskulSiswa')->find(38);
        $matapelajaran = Matapelajaran::where('semester','=',$raport->nilaiAkademik->semester)->get();
        return view('admin.raport.print',compact('raport','matapelajaran'));
    }
}
