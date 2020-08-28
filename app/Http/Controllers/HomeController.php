<?php

namespace App\Http\Controllers;

use App\Matapelajaran;
use App\Nilaiakademik;
use App\Raport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('siswa.layout');
    }

    public function indexRaport()
    {
        $siswa_id = auth()->user()->siswa->id;
        if(request()->ajax()){
            $data = Nilaiakademik::with('raport')->where('siswa_id','=',$siswa_id)->get();
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        if (empty($data->raport->id)) {
                            $button = '<div class="btn-group" role="group" aria-label="Basic example">Belum di publikasi</div>';
                        }else
                        $button = '<div class="btn-group" role="group" aria-label="Basic example">
                            <a href="'.route("print.raport.siswa",$data->raport->id).'" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                            </div>';                        
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('siswa.raport.index');
    }

    public function printRaport($id)
    {

        $raport = Raport::with('nilaiAkademik')->with('PKLSiswa')->with('EkskulSiswa')->find($id);
        $matapelajaran = Matapelajaran::where('semester','=',$raport->nilaiAkademik->semester)->get();
        return view('siswa.raport.print',compact('raport','matapelajaran'));
    }
}
