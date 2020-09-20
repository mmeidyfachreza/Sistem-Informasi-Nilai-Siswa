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
use App\Siswa;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Kelas::with('guru')->with('jurusan')->where('guru_id','=',Auth::user()->guru->id)->get();
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('jurusan', function($data){
                        return empty($data->jurusan->nama) ? "Belum Diatur" : $data->jurusan->nama;
                    })
                    ->addColumn('walikelas', function($data){
                        return empty($data->guru->nama) ? "Belum Diatur" : $data->guru->nama;
                    })
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'.route("raport.index.nilai",$data->id).'"class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        </div>';
                        return $button;
                    })
                    ->rawColumns(['action','walikelas','jurusan'])
                    ->make(true);
        }
        return view('admin.raport.index_kelas');
    }

    public function indexNilai($kelas)
    {
        $kelas = Kelas::findOrFail($kelas);
        $nilaiakademik = Nilaiakademik::where('nama_kelas','=',$kelas->nama)
        ->where('nama_jurusan','=',$kelas->jurusan->nama)
        ->where('nomor_kelas','=',$kelas->nomor)
        ->get()->groupBy(['angkatan','tahun','semester']);

        return view('admin.raport.index_nilai',compact('kelas','nilaiakademik'));
    }

    public function detailNilai(Request $request,$kelas)
    {
        $kelas = Kelas::findOrFail($kelas);
        $nilaiakademik = Nilaiakademik::with('siswa')
        ->where('nama_kelas','=',$kelas->nama)
        ->where('nama_jurusan','=',$kelas->jurusan->nama)
        ->where('nomor_kelas','=',$kelas->nomor)
        ->where('semester','=',$request->semester)
        ->where('tahun','=',$request->tahun)
        ->where('angkatan','=',$request->angkatan)->get();
        $tahun = $request->tahun;
        return view('admin.raport.index3',compact('nilaiakademik','kelas','tahun'));
    }

    public function createNilai($kelas)
    {
        $kelas = Kelas::findOrFail($kelas);
        return view('admin.raport.create_nilai',compact('kelas'));
    }

    public function checkNilai(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $siswa = Siswa::where('angkatan_thn','=',$request->angkatan)->where('kelas_id','=',$id)->get();
        $angkatan = $request->angkatan;
        return view('admin.raport.create_nilai',compact('kelas','siswa','angkatan'));
    }

    public function generateNilai(Request $request, $kelas)
    {
        $siswa = Siswa::where('angkatan_thn','=',$request->angkatan)->where('kelas_id','=',$kelas)->get();
        $matapelajaran = Matapelajaran::where('semester','=',$request->semester)->get();
        if (!$matapelajaran->first()) {
            return redirect()->to('admin/raport/kelas/'.$kelas.'/nilai-akademik/tambah')->withErrors('data matapelajaran pada semester '.$request->semester.' kosong');
        }
        foreach ($siswa as $value) {
            Nilaiakademik::create([
                'siswa_id'=>$value->id,
                'tahun'=>$request->tahun,
                'semester'=>$request->semester,
                'nama_kelas'=>$value->kelas->nama,
                'nama_jurusan'=>$value->kelas->jurusan->nama,
                'nomor_kelas'=>$value->kelas->nomor,
                'angkatan'=>$value->angkatan_thn,
                ]);
        }

        return redirect()->route("raport.index.nilai",$kelas)->with(['success'=>'Berhasil menambah data, guru dapat input nilai siswa']);
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
    public function show($id)
    {
        $nilaiakademik = Nilaiakademik::find($id);
        $raport = Raport::with('nilaiAkademik')->with('PKLSiswa')->with('EkskulSiswa')->find($nilaiakademik->raport->id);
        $matapelajaran = Matapelajaran::where('semester','=',$raport->nilaiakademik->semester)->get();
        return view('admin.raport.print',compact('raport','matapelajaran'));
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
