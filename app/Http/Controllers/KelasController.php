<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Guru;
use App\Jurusan;
use Auth;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * controller ini berfungsi untuk mengelola
     * data kelas yang termasuk tambah,ubah
     * dan hapus
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Kelas::with('guru')->with('jurusan')->get();
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
                        <a href="'.route("kelas.edit",$data->id).'"class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i
                        class="fa fa-trash"></i></a></div>';
                        return $button;
                    })
                    ->rawColumns(['action','walikelas','jurusan'])
                    ->make(true);
        }

        return view('admin.kelas.index');
    }

    /**
     * proses mengarahkan ke halaman
     * formulir tambah data kelas
     *
     */
    public function create()
    {
        $guru = Guru::all();
        $jurusan = Jurusan::all();
        return view('admin.kelas.form',compact('guru','jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kelas = Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success','Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('admin.kelas.show',compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $guru = Guru::all();
        $jurusan = Jurusan::all();
        return view('admin.kelas.form',compact('kelas','guru','jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());
        return redirect()->route('kelas.index')->with('success','Berhasil merubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            $kelas = Kelas::find($id);
            $kelas->delete();
            return response()->json(['success'=>'berhasil menghapus data']);
        }
    }
}
