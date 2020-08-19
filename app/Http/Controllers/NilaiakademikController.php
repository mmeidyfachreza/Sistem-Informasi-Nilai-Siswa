<?php

namespace App\Http\Controllers;

use App\Nilaiakademik;
use App\Matapelajaran;
use App\Siswa;
use Illuminate\Http\Request;

class NilaiakademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(request()->ajax()){
            $data = Siswa::with('kelas')->with('prodi')->get();
            return datatables()->of($data)
                    ->editColumn('nama', function($data){
                        $nama = '<a href="'.route("cari.nilai.siswa", $data->id).'">'.$data->nama.'</a>';
                        return $nama;
                    })
                    ->addColumn('kelas', function($data){
                        return empty($data->kelas->nama) ? "Belum Diatur" : $data->kelas->nama;
                    })
                    ->addColumn('prodi', function($data){
                        return empty($data->prodi->nama) ? "Belum Diatur" : $data->prodi->nama;
                    })
                    ->rawColumns(['kelas','nama','prodi'])
                    ->make(true);
        }
        return view('admin.nilai.index_student');
    }

    public function indexNilai($id)
    {
        $records = Nilaiakademik::where('siswa_id','=',$id)->get();
        $siswa = Siswa::findOrFail($id);
        return view('admin.nilai.index3',compact('records','siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderBySemester(Request $request)
    {
        
        $siswa = Siswa::findOrFail($request->siswa_id);
        $matapelajaran = Matapelajaran::where('semester','=',$request->semester)->get();
        if (!$matapelajaran->first()) {
            return redirect()->to('admin/nilai-akademik/create/'.$request->siswa_id)->withErrors('data matapelajaran pada semester '.$request->semester.' kosong');
        }
        $semester = $request->semester;
        $tahun = $request->tahun;
        return view('admin.nilai.create',compact('siswa','matapelajaran','semester','tahun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $siswa = Siswa::findOrFail($id);
        $matapelajaran = Matapelajaran::all();
        
        return view('admin.nilai.create',compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $siswa = Siswa::findOrFail($request->siswa_id);
        $nilaiakademik = Nilaiakademik::create($request->all());
        $mp = Matapelajaran::all();
        $x = 1;
        foreach ($mp as $item) {
            //collect all inserted record IDs
            $mp_id_array[$item->id] = [
                'pengetahuan' => $request->pengetahuan[$x],
                'keterampilan' => $request->keterampilan[$x],
                'nilai_akhir' => $request->nilai_akhir[$x],
                'predikat' => $request->predikat[$x++]
            ];
        }

        $nilaiakademik->nilaiMaPel()->attach($mp_id_array);
        
        return redirect()->route('cari.nilai.siswa',$request->siswa_id)->with(['success'=>'Berhasil menambah data','data'=>$siswa]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nilaiakademik  $Nilaiakademik
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $show = Nilaiakademik::with('mentalHealth')->with('mentalHealth2')->with('brainDomination')->with('learningModality')->with('healthScreening')->findOrFail($id);
    //     $student = Student::findOrFail($show->siswa_id);

    //     $mentalHealths = MentalHealth::all();
    //     $mentalHealths2 = MentalHealth2::all();
    //     $learningModalities = LearningModality::all();
    //     $brainDominations = BrainDomination::all();

    //     $choice1 = ['ya','tidak'];
    //     $choice2 = ['ya','tidak','1 kali','lebih dari 1 kali'];
    //     $choice3 = ['ya','tidak','tidak tahu'];
    //     $choice4 = ['selalu','kadang-kadang','tidak pernah'];
    //     $choice5 = ['ada','kadang-kadang','tidak ada'];

    //     return view('admin.medical_record.form',compact(
    //         'show',
    //         'student',
    //         'mentalHealths',
    //         'mentalHealths2',
    //         'learningModalities',
    //         'brainDominations',
    //         'choice1',
    //         'choice2',
    //         'choice3',
    //         'choice4',
    //         'choice5',
    //     ));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nilaiakademik  $Nilaiakademik
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Nilaiakademik::with('nilaiMaPel')->findOrFail($id);
        $siswa = Siswa::findOrFail($record->siswa_id);

        $matapelajaran = Matapelajaran::all();

        return view('admin.nilai.edit',compact(
            'record',
            'siswa',
            'matapelajaran',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nilaiakademik  $Nilaiakademik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $siswa = Siswa::findOrFail($request->siswa_id);
        $nilaiakademik = Nilaiakademik::findOrFail($id);
        $nilaiakademik->update($request->all());
        $mp = Matapelajaran::all();
        $x = 1;
        foreach ($mp as $item) {
            //collect all inserted record IDs
            $mp_id_array[$item->id] = [
                'pengetahuan' => $request->pengetahuan[$x],
                'keterampilan' => $request->keterampilan[$x],
                'nilai_akhir' => $request->nilai_akhir[$x],
                'predikat' => $request->predikat[$x++]
            ];
        }

        $nilaiakademik->nilaiMaPel()->syncWithoutDetaching($mp_id_array);
       
        return redirect()->route('cari.nilai.siswa',$request->siswa_id)->with(['success'=>'Berhasil merubah data','data'=>$siswa]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nilaiakademik  $Nilaiakademik
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilaiakademik = Nilaiakademik::findOrFail($id)->delete();
        $siswa = Siswa::findOrFail($nilaiakademik->siswa_id);
        return redirect()->route('cari.nilai.siswa',$siswa->id)->with(['success'=>'Berhasil merubah data','data'=>$siswa]);
    }

    public function searchStudent(Request $request)
    {
        $students = Siswa::search($request->name)->get();
        $search = $request->name;
        return view('admin.medical_record.index_student',compact('students','search'));
    }

    public function ajax(Request $request)
    {
        $siswa = Siswa::findOrFail(1);
        $matapelajaran = Matapelajaran::all();
        $html = view('admin.nilai.nilai_akademik', compact('siswa','matapelajaran'))->render();

        return response()->json(compact('html'));
    }
    
}
