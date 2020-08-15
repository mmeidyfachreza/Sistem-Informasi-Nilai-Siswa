<?php

namespace App\Http\Controllers;

use App\Jurusan;
use App\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Prodi::with('jurusan')->get();
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('jurusan', function($data){
                        return empty($data->jurusan->nama) ? "Belum Diatur" : $data->jurusan->nama;
                    })
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'.route("prodi.edit",$data->id).'"class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i
                        class="fa fa-trash"></i></a></div>';
                        return $button;
                    })
                    ->rawColumns(['action','jurusan'])
                    ->make(true);
        }
        
        return view('admin.prodi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        return view('admin.prodi.form',compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prodi = Prodi::create($request->all());
        return redirect()->route('prodi.index')->with('success','Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prodi = Prodi::findOrFail($id);
        return view('admin.prodi.show',compact('prodi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        $jurusan = Jurusan::all();
        return view('admin.prodi.form',compact('prodi','jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->all());
        return redirect()->route('prodi.index')->with('success','Berhasil merubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            $prodi = Prodi::find($id);
            $prodi->delete();
            return response()->json(['success'=>'berhasil menghapus data']);
        }        
    }
}
