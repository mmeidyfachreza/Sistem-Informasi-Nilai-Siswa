<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PKL;

class PKLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = PKL::all();
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'.route("pkl.edit",$data->id).'"class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i
                        class="fa fa-trash"></i></a></div>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.pkl.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pkl.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pkl = PKL::create($request->all());
        return redirect()->route('pkl.index')->with('success','Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PKL  $pkl
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pkl = PKL::findOrFail($id);
        return view('admin.pkl.show',compact('pkl'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PKL  $pkl
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pkl = PKL::findOrFail($id);        
        return view('admin.pkl.form',compact('pkl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PKL  $pkl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pkl = PKL::findOrFail($id);
        $pkl->update($request->all());
        return redirect()->route('pkl.index')->with('success','Berhasil merubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PKL  $pkl
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            $pkl = PKL::find($id);
            $pkl->delete();
            return response()->json(['success'=>'berhasil menghapus data']);
        }        
    }
}
