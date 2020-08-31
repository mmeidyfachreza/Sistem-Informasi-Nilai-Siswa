<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ekskul;

    /**
     * controller ini berfungsi untuk mengelola
     * data ekskul yang termasuk tambah,lihat,ubah
     * dan hapus
     */

class EkskulController extends Controller
{
    /**
     * fungsinya uktuk menampilkan data ekskul
     * saat mengakses fitur ekskul 
     * 
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Ekskul::all();
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'.route("ekskul.edit",$data->id).'"class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i
                        class="fa fa-trash"></i></a></div>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.ekskul.index');
    }

    /**
     * fungsinya mengarahkan ke halaman 
     * yang menampilkan formulir untuk
     * menambahkan data baru
     */
    public function create()
    {
        return view('admin.ekskul.form');
    }

    /**
     * fungsinya menyimpan data dari
     * formulir yang diisi saat menambah
     * data baru ke dalam database
     */
    public function store(Request $request)
    {
        $ekskul = Ekskul::create($request->all()); //proses simpan data ke database
        return redirect()->route('ekskul.index')->with('success','Berhasil menambah data'); //jika berhasil akan diarahkan ke halaman utama ekskul
    }

    /**
     * fungsinya untuk mengarahkan ke halaman 
     * formulir ubah data
     * 
     */
    public function edit($id)
    {
        $ekskul = Ekskul::findOrFail($id);        
        return view('admin.ekskul.form',compact('ekskul'));
    }

    /**
     * fungsinya untuk menyimpan data
     * dari formulir ubah data ke dalam
     * database
     */
    public function update(Request $request, $id)
    {
        $ekskul = Ekskul::findOrFail($id); //proses pencarian data di db
        $ekskul->update($request->all()); //proses update data ke db
        return redirect()->route('ekskul.index')->with('success','Berhasil merubah data'); // jika berhasil diarahkan ke halaman utama ekskul
    }

    /**
     * proses penghapusan data yang dipilih
     * 
     * 
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            $ekskul = Ekskul::find($id); //proses pencarian data di db
            $ekskul->delete(); //proses hapus data di db
            return response()->json(['success'=>'berhasil menghapus data']); //jika berhasil
        }        
    }
}
