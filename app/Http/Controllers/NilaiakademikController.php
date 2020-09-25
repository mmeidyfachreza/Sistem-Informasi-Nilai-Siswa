<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Nilaiakademik;
use App\Matapelajaran;
use App\Siswa;
use Auth;
use Illuminate\Http\Request;

class NilaiakademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //fungsi menampilkan data kelas saat akses menu nilai akademik
    {
        if(request()->ajax()){ //jika mengirimlan response menggunakan ajax
            $data = Kelas::with('guru')->with('jurusan')->get(); //mengambil seluruh data kelas bersama relasi guru dan jurusan
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
                        <a href="'.route("nilai.mapel.index",$data->id).'"class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        </div>';
                        return $button;
                    })
                    ->rawColumns(['action','walikelas','jurusan'])
                    ->make(true); //kirim data berupa response ke halaman pilih kelas di menu nilai akademik
        }
        return view('admin.nilai.index_kelas'); //mengarahkan ke halaman pilih kelas di menu nilai akademik
    }

    public function indexMapel($kelas) //fungsi untuk menampilkan data matapelajaran yang diampu oleh guru setelah tadi memilih kelas
    {
        $matapelajaran = Matapelajaran::where('guru_id','=',Auth::user()->guru->id)->get(); //menampilkan data matapelajaran berdasarkan guru yang login
        $kelas = Kelas::find($kelas); //mencari kelas berdasarkan yang dipilih saat di halaman pilih kelas menu nilai akademik
        return view('admin.nilai.index_mapel',compact('matapelajaran','kelas')); //mengarahkan ke halaman pilih mata pelajaran
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$kelas, $mapel) //fungsi untuk menyiapkan form input data nilai buat guru
    {
        $mapel = Matapelajaran::find($mapel); //mendapatkan data mapel berdasarkan mata pelajaran saat di menu nilai akademiik
        $kelas = Kelas::find($kelas); // mendapatkan data kelas berdasarkan kelas yang dipilih saat di menu nilai akademik
        $nilaiakademik = Nilaiakademik::with('siswa')
        ->where('nama_kelas','=',$kelas->nama)
        ->where('nama_jurusan','=',$kelas->jurusan->nama)
        ->where('nomor_kelas','=',$kelas->nomor)
        ->where('semester','=',$request->semester)
        ->where('tahun','=',$request->tahun)
        ->where('angkatan','=',$request->angkatan)->get(); //mendapatkan data nilai akademik siswa berdasarkan kondisi pada 'where'
        $angkatan = $request->angkatan; //simpan data request ke variabel untuk dibawa ke halaman input nilai siswa
        $tahun_ajrn = $request->tahun; //simpan data request ke variabel untuk dibawa ke halaman input nilai siswa
        $semester = $request->semester; //simpan data request ke variabel untuk dibawa ke halaman input nilai siswa
        return view('admin.nilai.create',compact('nilaiakademik','kelas','angkatan','tahun_ajrn','mapel','semester')); //mengarahkan ke halaman input data nilai siswa buat guru
    }

    public function indexNilai($kelas,$mapel) //fungsi untuk menampilkan nilai akademik yang telah dibuat oleh walikelas
    {
        $mapel = Matapelajaran::find($mapel); //mendapatkan data mapel berdasarkan mata pelajaran saat di menu nilai akademiik
        $kelas = Kelas::findOrFail($kelas); // mendapatkan data kelas berdasarkan kelas yang dipilih saat di menu nilai akademik
        $nilaiakademik = Nilaiakademik::where('nama_kelas','=',$kelas->nama)
        ->where('nama_jurusan','=',$kelas->jurusan->nama)
        ->where('nomor_kelas','=',$kelas->nomor)
        ->get()->groupBy(['angkatan','tahun','semester']); //mendapatkan data nilai akademik siswa berdasarkan kondisi pada 'where'
        return view('admin.nilai.index_nilai',compact('mapel','kelas','nilaiakademik')); //mengarahka ke halaman pilih nilai akademik untuk guru di menu nilai akademik
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //fungsi simpan data nilai siswa yang telah diinput oleh guru
    {
        $kelas = Kelas::find($request->kelas); //mendapatkan data kelas berdasarkan id
        $nilaiakademik = Nilaiakademik::with('siswa')
        ->where('nama_kelas','=',$kelas->nama)
        ->where('nama_jurusan','=',$kelas->jurusan->nama)
        ->where('nomor_kelas','=',$kelas->nomor)
        ->where('semester','=',$request->semester)
        ->where('tahun','=',$request->tahun_ajrn)
        ->where('angkatan','=',$request->angkatan)->get(); // mendapatkan data nilai akademik siswa bersarkan kondis 'where'

        $mp = Matapelajaran::where('semester','=',$request->semester)->get(); //mendapatkan data matapelajaran
        $x = 1;
        /*
        karena relasi tabel nilai akademik dan matapelajaran itu many to many jadi
        untuk proses penyimpanan datanya lumayan ribet dan agak susah dijelaskan dengan kalimat
        */
        foreach ($nilaiakademik as $value) { //proses simpan data nilai akademik per siswa
            //contoh ini proses simpan data nilai siswa namanya meidy
            $mp_id_array[$mp->find($request->mapel)->id] = [
                'pengetahuan' => $request->pengetahuan[$x],
                'keterampilan' => $request->keterampilan[$x],
                'nilai_akhir' => $request->nilai_akhir[$x],
                'predikat' => $request->predikat[$x++]
            ]; //data nilai meidy yang diinput oleh guru disimpan dulu ke dalam array
            $value->nilaiMaPel()->attach($mp_id_array); //baru data array tadi di simpan/sinkronkan ke tabel pivot(nilai_mapel) hasil relasi many to many tabel nilai akademik dan matapelajran
            $value->sum_pengetahuan = $value->nilaiMaPel->sum('pivot.pengetahuan'); //untuk mendapatkan nilai total pengetahuan
            $value->sum_keterampilan = $value->nilaiMaPel->sum('pivot.keterampilan'); //untuk mendapatkan nilai total keterampilan
            $value->sum_nilai_akhir = $value->nilaiMaPel->sum('pivot.nilai_akhir'); //untuk mendapatkan nilai total nilai akhir
            $value->avg_pengetahuan = $value->sum_pengetahuan/$mp->count(); //untuk mendapatkan nilai rata2 pengetahuan
            $value->avg_keterampilan = $value->sum_keterampilan/$mp->count(); //untuk mendapatkan nilai rata2 keterampilan
            $value->avg_nilai_akhir = $value->sum_nilai_akhir/$mp->count(); //untuk mendapatkan nilai rata2 nilai akhir
            if ($value->avg_nilai_akhir >= 85) { //untuk menentukan predikat si meidy berdarkan nilai rata2 nilai akhir
                $value->avg_predikat = "A-";
            } else if ($value->avg_nilai_akhir >= 80) {
                $value->avg_predikat = "B+";
            } else if ($value->avg_nilai_akhir >= 75) {
                $value->avg_predikat = "B";
            } else if ($value->avg_nilai_akhir >= 70) {
                $value->avg_predikat = "B-";
            } else if ($value->avg_nilai_akhir >= 60) {
                $value->avg_predikat = "C";
            } else {
                $value->avg_predikat = "D";
            }
            $value->update(); //update data nilai akademiknya si meidy
        }

        return redirect()->route('nilai.index2',['kelas'=>$request->kelas,'mapel'=>$request->mapel])->with(['success'=>'Berhasil menambah data']); //mengarahkan ke pilih nilai akademik di menu nilai akademik

    }

    //sampai ini aja fungsi yang digunakan, sisanya sampai kebawah gak dipakai

    /**
     * Display the specified resource.
     *
     * @param  \App\Nilaiakademik  $Nilaiakademik
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $show = Nilaiakademik::with('mentalHealth')->with('mentalHealth2')->with('brainDomination')->with('learningModality')->with('healthScreening')->findOrFail($id);
    //     $student = Student::findOrFail($show->siswa_id);

    //     $mentalHealths = MentalHealth::all();
    //     $mentalHealths2 = MentalHealth2::all();
    //     $learningModalities = LearningModality::all();
    //     $brainDominations = BrainDomination::all();

    //     $choice1 = ['ya','tidak'];
    //     $choice2 = ['ya','tidak','1 kali','lebih dari 1 kali'];
    //     $choice3 = ['ya','tidak','tidak tahu'];
    //     $choice4 = ['selalu','kadang-kadang','tidak pernah'];
    //     $choice5 = ['ada','kadang-kadang','tidak ada'];

    //     return view('admin.medical_record.form',compact(
    //         'show',
    //         'student',
    //         'mentalHealths',
    //         'mentalHealths2',
    //         'learningModalities',
    //         'brainDominations',
    //         'choice1',
    //         'choice2',
    //         'choice3',
    //         'choice4',
    //         'choice5',
    //     ));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nilaiakademik  $Nilaiakademik
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Nilaiakademik::with('nilaiMaPel')->findOrFail($id);
        $siswa = Siswa::findOrFail($record->siswa_id);
        $semester = $record->semester;
        $matapelajaran = Matapelajaran::where('semester','=',$semester)->where('guru_id','=',Auth::user()->guru->id)->get();

        return view('admin.nilai.edit',compact(
            'record',
            'siswa',
            'matapelajaran',
            'semester'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nilaiakademik  $Nilaiakademik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($request->siswa_id);
        $nilaiakademik = Nilaiakademik::findOrFail($id);
        $nilaiakademik->update($request->all());
        $mp = Matapelajaran::where('semester','=',$request->semester)->where('guru_id','=',Auth::user()->guru->id)->get();
        $x = 1;
        foreach ($mp as $item) {
            //collect all inserted record IDs
            $mp_id_array[$item->id] = [
                'pengetahuan' => $request->pengetahuan[$x],
                'keterampilan' => $request->keterampilan[$x],
                'nilai_akhir' => $request->nilai_akhir[$x],
                'predikat' => $request->predikat[$x++]
            ];
        }

        $nilaiakademik->nilaiMaPel()->sync($mp_id_array);

        return redirect()->route('cari.nilai.siswa',$request->siswa_id)->with(['success'=>'Berhasil merubah data','data'=>$siswa]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nilaiakademik  $Nilaiakademik
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilaiakademik = Nilaiakademik::findOrFail($id);
        $siswa = Siswa::findOrFail($nilaiakademik->siswa_id);
        $nilaiakademik->delete();
        return redirect()->route('cari.nilai.siswa',$siswa->id)->with(['success'=>'Berhasil merubah data','data'=>$siswa]);
    }

}
