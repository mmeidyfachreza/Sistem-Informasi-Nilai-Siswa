<?php

namespace App\Http\Controllers;

use App\Guru;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;

    /**
     * controller ini berfungsi untuk mengelola
     * data guru yang termasuk tambah,lihat,ubah
     * dan hapus
     */

class GuruController extends Controller
{
    /**
     * fungsi ini untuk menampilkan data 
     * guru saat mengakses fitur guru
     * 
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Guru::with('user')->get();
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->editColumn('nip', function($data){
                        return empty($data->nip) ? "Belum Diatur" : $data->nip;
                    })
                    ->addColumn('email', function($data){
                        return empty($data->user->email) ? "Belum Diatur" : $data->user->email;
                    })
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'.route("guru.edit",$data->id).'"class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i
                        class="fa fa-trash"></i></a>
                        <a href="'.route("guru.show",$data->id).'"class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                    </div>';
                        return $button;
                    })
                    ->rawColumns(['action','email','nip'])
                    ->make(true);
        }
        
        return view('admin.guru.index');
    }

    /**
     * fungsi ini untuk mengarahkan ke 
     * formulir tambah data guru
     * 
     */
    public function create()
    {
        $gender = ['Laki-laki','Perempuan'];
        return view('admin.guru.form',compact('gender'));
    }

    /**
     * fungsi ini untuk proses menyimpan data
     * dari formulir tambah data ke dalam
     * database
     */
    public function store(Request $request)
    {
        $guru = Guru::create($request->all()); //proses tambah data guru
        $user = User::create([
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]); //proses tambah data user
        $guru->user_id = $user->id;
        $guru->save(); //proses acc simpan data ke db
        return redirect()->route('guru.index')->with('success','Berhasil menambah data');
    }

    /**
     * proses menampilkan rincian data guru
     * saat klik tombol mata di halaman utama
     * data guru
     */
    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.show',compact('guru'));
    }

    /**
     * proses mengarahkan ke formulir
     * halaman ubah data guru
     * 
     */
    public function edit($id)
    {
        $guru = Guru::with('user')->findOrFail($id);        
        $gender = ['Laki-laki','Perempuan'];
        return view('admin.guru.form',compact('guru','gender'));
    }

    /**
     * proses penyimpanan data dari formulir
     * ubah data guru ke dalam database
     * 
     */
    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id); //proses pencarian data guru di db
        $user = User::findOrFail($guru->id); //proses pencarian data user di db
        if ($request->password) { //jika user menginputkan password maka password akan dirubah
            $user->update([
                'email'=>$request->email,
                'password'=>Hash::make($request->password)]);
        }else{ //jika tidak update email saja
            $user->update(['email'=>$request->email]);
        }
        $guru->update($request->all()); //proses perbarui data guru di db
        return redirect()->route('guru.index')->with('success','Berhasil merubah data');
    }

    /**
     * proses hapus data guru di database
     * 
     * 
     */
    public function destroy($id)
    {
        if (request()->ajax()) { 
            if (auth()->user()->id==$id) {
                # code...
                return back()->withErrors(['Tidak Bisa Menghapus Akun yang sedang digunakan']);
            }
            $guru = Guru::find($id); //proses cari data guru di db
            User::find($guru->user_id)->delete(); //cari data user di db lalu hapus
            $guru->delete(); //proses hapus data guru
            return response()->json(['success'=>'berhasil menghapus data']);
        }
        
    }
}
