<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Nilaiakademik;
use App\Matapelajaran;
use App\Siswa;
use Auth;
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
                        <a href="'.route("nilai.mapel.index",$data->id).'"class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        </div>';
                        return $button;
                    })
                    ->rawColumns(['action','walikelas','jurusan'])
                    ->make(true);
        }
        return view('admin.nilai.index_kelas');
    }

    // public function indexNilai($id)
    // {
    //     $records = Nilaiakademik::where('siswa_id','=',$id)->get();
    //     $siswa = Siswa::findOrFail($id);
    //     return view('admin.nilai.index3',compact('records','siswa'));
    // }

    public function indexMapel($kelas)
    {
        $matapelajaran = Matapelajaran::where('guru_id','=',Auth::user()->guru->id)->get();
        $kelas = Kelas::find($kelas);
        return view('admin.nilai.index_mapel',compact('matapelajaran','kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderBySemester(Request $request)
    {

        $siswa = Siswa::findOrFail($request->siswa_id);
        $matapelajaran = Matapelajaran::where('semester','=',$request->semester)->where('guru_id','=',Auth::user()->guru->id)->get();
        if (!$matapelajaran->first()) {
            return redirect()->to('admin/nilai-akademik/create/'.$request->siswa_id)->withErrors('data matapelajaran pada semester '.$request->semester.' kosong');
        }
        $semester = $request->semester;
        return view('admin.nilai.create',compact('siswa','matapelajaran','semester'));
    }

    public function orderBySemesterEdit(Request $request,$id)
    {

        $siswa = Siswa::findOrFail($request->siswa_id);
        $record = Nilaiakademik::with('nilaiMaPel')->findOrFail($id);
        $matapelajaran = Matapelajaran::where('semester','=',$request->semester)->get();
        $semester = $request->semester;
        if (!$matapelajaran->first()) {
            return redirect()->to('admin/nilai-akademik/'.$id.'/edit')->with([
                'error'=>'data matapelajaran pada semester '.$request->semester.' kosong',
                'record'=>$record,
                'semester'=>$semester
                ]);
        }

        return view('admin.nilai.edit',compact('siswa','matapelajaran','semester','record'));
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

    public function indexForm($kelas,$mapel)
    {
        $siswa = Siswa::with('kelas.jurusan')->where('kelas_id','=',$kelas)->get();
        $matapelajaran = Matapelajaran::all();
        return view('admin.nilai.create',compact('siswa'));
    }

    public function create2(Request $request,$kelas, $mapel)
    {
        $mapel = Matapelajaran::find($mapel);
        $kelas = Kelas::find($kelas);
        $nilaiakademik = Nilaiakademik::with('siswa')
        ->where('nama_kelas','=',$kelas->nama)
        ->where('nama_jurusan','=',$kelas->jurusan->nama)
        ->where('nomor_kelas','=',$kelas->nomor)
        ->where('semester','=',$request->semester)
        ->where('tahun','=',$request->tahun)
        ->where('angkatan','=',$request->angkatan)->get();
        $angkatan = $request->angkatan;
        $tahun_ajrn = $request->tahun;
        $semester = $request->semester;
        return view('admin.nilai.create_nilai',compact('nilaiakademik','kelas','angkatan','tahun_ajrn','mapel','semester'));
    }

    public function indexNilai($kelas,$mapel)
    {
        $mapel = Matapelajaran::find($mapel);
        $kelas = Kelas::findOrFail($kelas);
        $nilaiakademik = Nilaiakademik::where('nama_kelas','=',$kelas->nama)
        ->where('nama_jurusan','=',$kelas->jurusan->nama)
        ->where('nomor_kelas','=',$kelas->nomor)
        ->get()->groupBy(['angkatan','tahun','semester']);
        return view('admin.nilai.index_nilai',compact('mapel','kelas','nilaiakademik'));
    }

    public function index_walikelas()
    {

        if(request()->ajax()){
            $data = Kelas::with('jurusan')->where('guru_id','=',Auth::user()->id)->get();
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('jurusan', function($data){
                        return empty($data->jurusan->nama) ? "Belum Diatur" : $data->jurusan->nama;
                    })
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'.route("kelas.edit",$data->id).'"class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></div>';
                        return $button;
                    })
                    ->rawColumns(['action','jurusan'])
                    ->make(true);
        }

        return view('admin.kelas.index_walikelas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $kelas = Kelas::find($request->kelas);
        $nilaiakademik = Nilaiakademik::with('siswa')
        ->where('nama_kelas','=',$kelas->nama)
        ->where('nama_jurusan','=',$kelas->jurusan->nama)
        ->where('nomor_kelas','=',$kelas->nomor)
        ->where('semester','=',$request->semester)
        ->where('tahun','=',$request->tahun_ajrn)
        ->where('angkatan','=',$request->angkatan)->get();

        $mp = Matapelajaran::where('semester','=',$request->semester)->get();
        $x = 1;
        foreach ($nilaiakademik as $value) {
            $mp_id_array[$mp->find($request->mapel)->id] = [
                'pengetahuan' => $request->pengetahuan[$x],
                'keterampilan' => $request->keterampilan[$x],
                'nilai_akhir' => $request->nilai_akhir[$x],
                'predikat' => $request->predikat[$x++]
            ];
            $value->nilaiMaPel()->attach($mp_id_array);
            $value->sum_pengetahuan = $value->nilaiMaPel->sum('pivot.pengetahuan');
            $value->sum_keterampilan = $value->nilaiMaPel->sum('pivot.keterampilan');
            $value->sum_nilai_akhir = $value->nilaiMaPel->sum('pivot.nilai_akhir');
            $value->avg_pengetahuan = $value->sum_pengetahuan/$mp->count();
            $value->avg_keterampilan = $value->sum_keterampilan/$mp->count();
            $value->avg_nilai_akhir = $value->sum_nilai_akhir/$mp->count();
            if ($value->avg_nilai_akhir >= 85) {
                $value->avg_predikat = "A-";
            } else if ($value->avg_nilai_akhir >= 80) {
                $value->avg_predikat = "B+";
            } else if ($value->avg_nilai_akhir >= 75) {
                $value->avg_predikat = "B";
            } else if ($value->avg_nilai_akhir >= 70) {
                $value->avg_predikat = "B-";
            } else if ($value->avg_nilai_akhir >= 60) {
                $value->avg_predikat = "C";
            } else {
                $value->avg_predikat = "D";
            }
            $value->update();
        }

        return redirect()->route('nilai.index2',['kelas'=>$request->kelas,'mapel'=>$request->mapel])->with(['success'=>'Berhasil menambah data']);

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
        $semester = $record->semester;
        $matapelajaran = Matapelajaran::where('semester','=',$semester)->where('guru_id','=',Auth::user()->guru->id)->get();

        return view('admin.nilai.edit',compact(
            'record',
            'siswa',
            'matapelajaran',
            'semester'
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
        $mp = Matapelajaran::where('semester','=',$request->semester)->where('guru_id','=',Auth::user()->guru->id)->get();
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

        $nilaiakademik->nilaiMaPel()->sync($mp_id_array);

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
        $nilaiakademik = Nilaiakademik::findOrFail($id);
        $siswa = Siswa::findOrFail($nilaiakademik->siswa_id);
        $nilaiakademik->delete();
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
