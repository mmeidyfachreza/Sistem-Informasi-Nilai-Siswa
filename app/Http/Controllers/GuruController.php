<?php

namespace App\Http\Controllers;

use App\Guru;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Rap2hpoutre\FastExcel\FastExcel;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $classrooms = Classroom::all();
        $gender = ['Laki-laki','Perempuan'];
        return view('admin.guru.form',compact('classrooms','gender'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Guru::create($request->all());
        return redirect()->route('guru.index')->with('success','Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.show',compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);        
        $gender = ['Laki-laki','Perempuan'];
        return view('admin.guru.form',compact('guru','gender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        $guru->update($request->all());
        return redirect()->route('guru.index')->with('success','Berhasil merubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru = Guru::find($id);
        User::find($guru->user_id)->delete();
        $guru->delete();
        return response()->json(['success'=>'berhasil menghapus data']);
    }

    // public function export(){
    //     return (new FastExcel(Guru::with('classroom')->get()))->download('users.xlsx', function ($data) {
    //         return [
    //             'NIS' => ($data->nip? $data->nip : " "),
    //             'Kelas' => ($data->classroom? $data->classroom->name : " "),
    //             'Nama' => $data->name,
    //             'Tanggal Lahir' => $data->born_date,
    //             'Tempat Lahir' => $data->born_city,
    //             'Alamat' => $data->address,
    //             'Jenis Kelamin' => $data->gender,
    //             'Golongan Darah' => $data->blood_type,
    //             'Asal Sekolah' => $data->school_from,
    //             'Nama Ayah' => $data->father_name,
    //             'Nama Ibu' => $data->mother_name,
    //             'Wali' => $data->guardian,
    //             'No BPJS' => $data->no_bpjs,
    //             'FASKES BPJS' => $data->faskes_bpjs,
    //         ];
    //     });
    // }
}
