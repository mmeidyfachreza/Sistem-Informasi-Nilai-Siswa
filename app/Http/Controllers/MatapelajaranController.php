<?php

namespace App\Http\Controllers;

use App\Matapelajaran;
use App\Guru;
use Illuminate\Http\Request;

class MatapelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Matapelajaran::with('guru')->get();
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('guru', function($data){
                        return empty($data->guru->nama) ? "Belum Diatur" : $data->guru->nama;
                    })
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'.route("matapelajaran.edit",$data->id).'"class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i
                        class="fa fa-trash"></i></a></div>';
                        return $button;
                    })
                    ->rawColumns(['action','guru'])
                    ->make(true);
        }

        return view('admin.matapelajaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guru = Guru::all();
        $jenis = ['A. Muatan Nasional','B. Muatan Kewilayahan','C. Muatan Peminatan Kejuruan'];
        $sub_jenis = ['C1. Dasar Program Keahlian'];
        return view('admin.matapelajaran.form',compact('guru','jenis','sub_jenis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $matapelajaran = Matapelajaran::create($request->all());
        return redirect()->route('matapelajaran.index')->with('success','Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Matapelajaran  $matapelajaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $matapelajaran = Matapelajaran::findOrFail($id);
        return view('admin.matapelajaran.show',compact('matapelajaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Matapelajaran  $matapelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matapelajaran = Matapelajaran::findOrFail($id);
        $guru = Guru::all();
        $jenis = ['A. Muatan Nasional','B. Muatan Kewilayahan','C. Muatan Peminatan Kejuruan'];
        $sub_jenis = ['C1. Dasar Program Keahlian'];
        return view('admin.matapelajaran.form',compact('matapelajaran','guru','jenis','sub_jenis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Matapelajaran  $matapelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $matapelajaran = Matapelajaran::findOrFail($id);
        $matapelajaran->update($request->all());
        return redirect()->route('matapelajaran.index')->with('success','Berhasil merubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Matapelajaran  $matapelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            $matapelajaran = Matapelajaran::find($id);
            $matapelajaran->delete();
            return response()->json(['success'=>'berhasil menghapus data']);
        }
    }
}
