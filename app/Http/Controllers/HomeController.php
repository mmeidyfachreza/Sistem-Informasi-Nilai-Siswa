<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Kepsek;
use App\Matapelajaran;
use App\Nilaiakademik;
use App\Raport;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
     * controller ini berfungsi untuk mengelola
     * fitur untuk akun jenis siswa
     *
     */

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * menampilkan layout halaman siswa
     *
     *
     */
    public function index()
    {
        return view('siswa.layout');
    }

    /**
     * proses menampilan data raport siswa
     * saat siswa akses menu raport
     *
     */
    public function indexRaport()
    {
        $siswa_id = auth()->user()->siswa->id;
        if(request()->ajax()){
            $data = Nilaiakademik::with('raport')->where('siswa_id','=',$siswa_id)->get();
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('kelas', function($data){
                        return $data->nama_kelas.' '.$data->nama_jurusan.' '.$data->nomor_kelas;
                    })
                    ->addColumn('action', function($data){
                        if (empty($data->raport->id)) {
                            $button = '<div class="btn-group" role="group" aria-label="Basic example">Belum di publikasi</div>';
                        }else
                        $button = '<div class="btn-group" role="group" aria-label="Basic example">
                            <a href="'.route("print.raport.siswa",$data->raport->id).'" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                            </div>';
                        return $button;
                    })
                    ->rawColumns(['kelas','action'])
                    ->make(true);
        }

        return view('siswa.raport.index');
    }

    /**
     * proses cetak raport siswa
     *
     *
     */
    public function printRaport($id)
    {
        $raport = Raport::with('nilaiAkademik')->with('PKLSiswa')->with('EkskulSiswa')->find($id); //proses pencarian raport
        $matapelajaran = Matapelajaran::where('semester','=',$raport->nilaiAkademik->semester)->get(); //penyesuaiam data matapelajaran yang ditampilkan saat cetak raport
        $kepsek = Kepsek::all()->first();
        return view('siswa.raport.print',compact('raport','matapelajaran','kepsek'));
    }

    public function query()
    {
        DB::statement("SET sql_mode = 'STRICT_ALL_TABLES' ");
        // $query = DB::table('kelas')->join('siswa','kelas.id','=','siswa.kelas_id')->select('kelas.id','kelas.nama','siswa.id')->where('kelas.guru_id','=',4)->groupBy('kelas.id','siswa.id')->get();
        $query = DB::table('jurusan')
        ->join('kelas','jurusan.id','=','kelas.jurusan_id')
        ->join('siswa','kelas.id','=','siswa.kelas_id')
        ->select('kelas.*','siswa.angkatan_thn as angkatan','jurusan.nama')
        ->where('kelas.guru_id','=',10)
        ->groupBy('siswa.angkatan_thn')
        ->get();
        dd($query);
    }

    public function kepsekForm()
    {
        $kepsek = Kepsek::all()->first();
        return view('admin.kepsek.form',compact('kepsek'));
    }

    public function kepsekUpdate(Request $request)
    {
        $kepsek = Kepsek::all()->first();
        $kepsek->update($request->all());
        return redirect()->route('kepsek.show')->with('success','Berhasil merubah data');
    }
}
