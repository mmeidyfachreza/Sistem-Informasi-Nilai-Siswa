<?php

namespace App\Http\Controllers;

use App\Jurusan;
use Illuminate\Http\Request;

/**
     * controller ini berfungsi untuk mengelola
     * data jurusan yang termasuk tambah,ubah
     * dan hapus
     */

class JurusanController extends Controller
{
    /**
     * proses menampilkan data jurusan
     * saat mengakses menu jurusan
     * 
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Jurusan::all();
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'.route("jurusan.edit",$data->id).'"class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i
                        class="fa fa-trash"></i></a></div>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.jurusan.index');
    }

    /**
     * proses mengarahan ke halaman
     * formulir tambah data jurusan
     * 
     */
    public function create()
    {
        return view('admin.jurusan.form');
    }

    /**
     * proses simpan data ke database
     * dari formulir tambah data jurusan
     * 
     */
    public function store(Request $request)
    {
        $jurusan = Jurusan::create($request->all()); //proses simpan data ke database
        return redirect()->route('jurusan.index')->with('success','Berhasil menambah data');
    }

    /**
     * proses mengarahakan ke halaman 
     * formulir ubah data jurusan
     * 
     */
    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);        
        return view('admin.jurusan.form',compact('jurusan'));
    }

    /**
     * proses perbarui data jurusan di
     * database
     * 
     */
    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update($request->all());
        return redirect()->route('jurusan.index')->with('success','Berhasil merubah data');
    }

    /**
     * proses hapus data 
     * 
     * 
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            $jurusan = Jurusan::find($id);
            $jurusan->delete();
            return response()->json(['success'=>'berhasil menghapus data']);
        }        
    }
}
