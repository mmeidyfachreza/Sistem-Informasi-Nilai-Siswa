<?php

namespace App\Http\Controllers;

use App\Ekskul;
use App\EkskulSiswa;
use App\Kelas;
use App\Kepsek;
use App\Matapelajaran;
use App\Nilaiakademik;
use App\PKL;
use App\PKLSiswa;
use App\Raport;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //fungsi untuk menampilkan data kelas
    {
        if(request()->ajax()){
            $data = Kelas::with('guru')->with('jurusan')->where('guru_id','=',Auth::user()->guru->id)->get();
            //data kelas yang ditampilkan berdasarkan akun guru yang terdaftar sebagai walikelas
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

    public function indexNilai($kelas) //fungsi untuk menampikan nilai akademik yang sudah dibuat walikelas dan dikategorikan berdasarkan angkatan, tahun ajaran dan semester
    {
        $kelas = Kelas::findOrFail($kelas); //mendapatkan nilai siswa berdasarkan kelas yang dipilih saat halaman utama raport
        $nilaiakademik = Nilaiakademik::where('nama_kelas','=',$kelas->nama)
        ->where('nama_jurusan','=',$kelas->jurusan->nama)
        ->where('nomor_kelas','=',$kelas->nomor)
        ->get()->groupBy(['angkatan','tahun','semester']); //mendaparkan data nilai akademik siswa yang dikategorikan berdasarkan angaktan,tahun dan semester

        return view('admin.raport.index_nilai',compact('kelas','nilaiakademik')); //mengarahkan ke halaman pertama menu raport
    }

    public function detailNilai(Request $request,$kelas) //fungsi untuk menampilkan siswa beserta nilai akademiknya
    {
        $kelas = Kelas::findOrFail($kelas); //mendapatkan nilai siswa berdasarkan kelas yang dipilih saat halaman utama raport
        $nilaiakademik = Nilaiakademik::with('siswa')
        ->where('nama_kelas','=',$kelas->nama)
        ->where('nama_jurusan','=',$kelas->jurusan->nama)
        ->where('nomor_kelas','=',$kelas->nomor)
        ->where('semester','=',$request->semester)
        ->where('tahun','=',$request->tahun)
        ->where('angkatan','=',$request->angkatan)->get(); //menampilkan data nilai akademik siswa setelah tadi kita pilih nilai akademik yang dikategorikan
        $tahun = $request->tahun;
        return view('admin.raport.index3',compact('nilaiakademik','kelas','tahun')); //mengarahkan ke halaman yang menampilkan data siswa beserta nilai akademiknya
    }

    public function createNilai($kelas) //menyiapkan form untuk halaman buat nilai akademik yang akan di proses walikelas
    {
        $kelas = Kelas::findOrFail($kelas); //mendapatkan data kelas berdasarkan data yang dipilih di halaman utama menu raport
        return view('admin.raport.create_nilai',compact('kelas')); //mengarahkan ke halaman untuk buat nilai akademik
    }

    public function checkNilai(Request $request, $id) //fugnsi menampilkan list siswa pada halaman buat nilai akademik
    {
        $kelas = Kelas::findOrFail($id); //mendapatkan data kelas berdasarkan data yang dipilih di halaman utama menu raport
        $siswa = Siswa::where('angkatan_thn','=',$request->angkatan)->where('kelas_id','=',$id)->get(); //mendapatkan data seluruh siswa berdasarkan tahun angkatan
        $angkatan = $request->angkatan;
        return view('admin.raport.create_nilai',compact('kelas','siswa','angkatan')); //mengarahkan kembali ke halaman tambah/buat nilai akademik
    }

    public function generateNilai(Request $request, $kelas) //fungsi untuk membuat nilai akademik siswa oleh walikelas yang nantinya akan digunakan guru untuk input nilai akademik
    {
        $siswa = Siswa::where('angkatan_thn','=',$request->angkatan)->where('kelas_id','=',$kelas)->get(); //mendapatka data siswa berdasarkan angkatan dan kelas
        $matapelajaran = Matapelajaran::where('semester','=',$request->semester)->get(); //mendapatkan data matapelajaran berdasarkan semester yang telah diinput di halaman tambah nilai akademik
        if (!$matapelajaran->first()) { //jika matapelajaran pada semester yang dipilih kosong maka proses tidak bisa dilanjut
            return redirect()->to('admin/raport/kelas/'.$kelas.'/nilai-akademik/tambah')->withErrors('data matapelajaran pada semester '.$request->semester.' kosong');
        }
        foreach ($siswa as $value) { //proses pembuatan nilai akademik untuk seluruh siswa berdasarkan kelas
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

        return redirect()->route("raport.index.nilai",$kelas)->with(['success'=>'Berhasil menambah data, guru dapat input nilai siswa']); //mengarahkan ke halaman pilih nilai akademik di menu raport
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) //fungsi untuk menyiapkan formulir pembuatan raport
    {
        $record = Nilaiakademik::with('siswa')->find($id); //mendapatkan data nilai akademik berdsarkan nilai akademik yang dipilih
        $matapelajaran = Matapelajaran::where('semester','=',$record->semester)->get(); //mendapatkan data matapelajaran untuk halaman buat raport
        $pkl = PKL::all(); //mendapatkan data pkl
        $ekskul = Ekskul::all(); //mendapatkan data eksul
        $kenaikan = ['Naik','Tidak Naik']; //pilihan untuk status kenaikan kelas siswa
        $kelas = Kelas::all(); //mendapatkan data kelas

        return view('admin.raport.create',compact('record','matapelajaran','pkl','ekskul','kenaikan','kelas')); //mengarahkan ke halaman pembuatan raport
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //fungsi penyimpanan data raport yang telah diisi di halaman pembuatan raport
    {
        $nilaiakademik = Nilaiakademik::with('siswa')->find($request->nilaiakademik_id); //mendapatkan data nilai akademik dari database
        $matapelajaran = Matapelajaran::where('semester','=',$nilaiakademik->semester)->get(); //mendapatkan data mata pelajaran dari database berdasarkan semester
        $list_pkl = PKL::all(); //mendapatkan data pkl dari database
        $list_ekskul = Ekskul::all(); //mendapatkan data ekskul dari database

        $raport = Raport::create([
            'nilaiakademik_id' => $nilaiakademik->id,
            'cat_akademik' => $request->cat_akademik,
            'sakit' => $request->sakit,
            'izin' => $request->izin,
            'tanpa_ket' => $request->tanpa_ket,
            'keterangan_kenaikan'=>$request->keterangan_kenaikan,
            'guru_id'=>Auth::user()->guru->id,
        ]); //proses penyimpanan data raport ke database

        /*
            proses penyimpanan data pkl dan ekskul persiswa ini agak ribet karena
            relasi tabelnya many to many jadi diperlukan tabel pivot yang namanya
            tabel nilai akademik + tabel pkl_siswa = pivot tabel hasil_pkl_siswa
            tabel nilai akademik + tabel ekskul_siswa = pivot tabel hasil_pkl_siswa
        */
        if ($request->pkl) { //proses penyimpanan data pkl jika diisi
            $pkl = PKLSiswa::create([
                'tahun'=>$nilaiakademik->tahun,
                'semester'=>$nilaiakademik->semester,
                'siswa_id'=>$nilaiakademik->siswa_id,
            ]); //proses simpan data pkl siswa jika ada pilih pkl saat buat raport
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
            //intinya ini proses penambahan data pkl siswa dan proses sinkronsasi data pkl ke nilai akademik untuk raport
        }

        if ($request->ekskul) { //sama aja kayak diatas cuman ini untuk data ekskul
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
        $tahun = $nilaiakademik->tahun;
        $kelas = Kelas::findOrFail($request->kelas_id); //mendapatkan nilai siswa berdasarkan kelas yang dipilih saat halaman utama raport
        $nilaiakademik = Nilaiakademik::with('siswa')
        ->where('nama_kelas','=',$kelas->nama)
        ->where('nama_jurusan','=',$kelas->jurusan->nama)
        ->where('nomor_kelas','=',$kelas->nomor)
        ->where('semester','=',$nilaiakademik->semester)
        ->where('tahun','=',$nilaiakademik->tahun)
        ->where('angkatan','=',$nilaiakademik->angkatan)->get();
        //return view('admin.raport.print',compact('raport','matapelajaran'));
        $kepsek = Kepsek::all()->first();
        return view('admin.raport.index3',compact('nilaiakademik','kelas','tahun','kepsek')); //mengarahkan ke halaman yang menampilkan data siswa beserta nilai akademiknya
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function show($id) //untuk melihat data raport yang sudah dibuat dan dicetak
    {
        $nilaiakademik = Nilaiakademik::find($id); //mendapatkan data nilai akdemik yang dipilih
        $raport = Raport::with('nilaiAkademik')->with('PKLSiswa')->with('EkskulSiswa')->find($nilaiakademik->raport->id); //mendapatkan data raport yang dipilih bersama relasi tabelnya
        $matapelajaran = Matapelajaran::where('semester','=',$raport->nilaiakademik->semester)->get(); //menampilkan data matapelajaran berdasarkan semester
        $kepsek = Kepsek::all()->first();
        return view('admin.raport.print',compact('raport','matapelajaran','kepsek')); //mengarahkan ke halaman lihat raport
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

    public function cetak() //sama seperti fungsi show, cuman ini khusus siswa
    {
        $raport = Raport::with('nilaiAkademik')->with('PKLSiswa')->with('EkskulSiswa')->find(38);
        $matapelajaran = Matapelajaran::where('semester','=',$raport->nilaiAkademik->semester)->get();
        $kepsek = Kepsek::all()->first();
        return view('admin.raport.print',compact('raport','matapelajaran','kepsek'));
    }
}
