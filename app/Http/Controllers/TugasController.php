<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tugas;
use App\Siswa;
use App\Guru;
use App\Tugas_Siswa;
use Alert;
use Excel;
use File;
use Auth;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
        $data = Tugas::with('Guru')->orderBy('created_at', 'desc')->get();
        return view('tugas.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $siswa = Siswa::all();
        $guru = Guru::all();
        return view('tugas.create',compact('guru','siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Alert::success('Selamat Data Berhasil Ditambahkan')->autoclose(3000);
        $this->validate($request,[
            'pengirim' => 'required',
            'file' => 'required',
            'penerima' => 'required',
            'KKM' => 'required',
            'batas' => 'required',
            'ket' => 'required',
        ]);
        $data = new Tugas;
        $tgl_sekarang=date("Y-m-d");//tanggal sekarang

        $data->pengirim = $request->pengirim;
        if ($request->KKM > 100) {
            Alert::error('Maaf KKM Tidak Boleh Melebihi 100')->autoclose(3000);
            return redirect()->route('tugas.create');
        } elseif($request->KKM < 0){
           Alert::error('Maaf KKM Tidak Boleh Kurang Dari 0')->autoclose(3000);
           return redirect()->route('tugas.create');
        } else{
            $data->KKM = $request->KKM;
        }
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPath = public_path().'/File/Tugas/';
            $filename = $file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);
            $data->file = $filename;
            }
        $batas=$request->batas;
        if ($batas >= $tgl_sekarang){
            $data->batas = $request->batas;
        }elseif ($batas <= $tgl_sekarang) {
            Alert::error('Maaf Batas Tanggal Tidak Boleh Melewati Tanggal Sekarang')->autoclose(3000);
            return redirect()->route('tugas.create');
        }
        
        $data->save();
        $data->Siswa()->attach($request->penerima);
        return redirect()->route('tugas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $tugas = Tugas::findOrFail($id);
        $id = $tugas->id;
        $tugas1 = Tugas_Siswa::where('id_tugas',$id)->get();  
        $siswa = Siswa::all();
        $guru = Guru::all();
        return view('tugas.show',compact('guru','siswa','tugas','tugas1'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tugas = Tugas::findOrFail($id);
        $tugas1 = Tugas_Siswa::where('id_tugas', $tugas->id )->get();
        $siswa = Siswa::all();
        $guru = Guru::all();
        return view('tugas.edit',compact('guru','siswa','tugas','tugas1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        Alert::success('Selamat Data Berhasil Diganti Dengan Yang Baru')->autoclose(3000);
        $this->validate($request,[
            'pengirim' => 'required',
            'file' => 'required',
            'KKM' => 'required',
            'penerima' => 'required',
            
            
        ]);
        $data = Tugas::findOrFail($id);
        
        // edit upload file
        
        
        if ($request->KKM > 100) {
            Alert::error('Maaf Data Yang Dimasukan Tidak Valid')->autoclose(3000);
            return redirect()->route('tugas.edit');
        } elseif ($request->KKM < 0) {
           Alert::error('Maaf Data Yang Dimasukan Tidak Valid')->autoclose(3000);
            return redirect()->route('tugas.edit');
        }elseif ($request->KKM > 0){
            $data->KKM = $request->KKM;
        }
        $data->pengirim = $request->pengirim;
       if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPath = public_path().'/File/Tugas/';
            $filename = $file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);
            $data->file = $filename;
            }

        $data->save();
        $data->Siswa()->sync($request->penerima);
        return redirect()->route('tugas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Alert::success('Selamat Data Berhasil Dihapus')->autoclose(3000);
        $tugas = Tugas::findOrFail($id);
        if ($tugas->file) {
            $old_file = $tugas->file;
            $filepath = public_path() . DIRECTORY_SEPARATOR . '/File/Tugas/'
            . DIRECTORY_SEPARATOR . $tugas->file;
            try {
            File::delete($filepath);
            } catch (FileNotFoundException $e) {
            // File sudah dihapus/tidak ada
            }
            }
        $tugas->delete();
        return redirect()->route('tugas.index');
    }

    public function download($file) {

    $file_path = public_path('/File/Tugas/'.$file);
    return response()->download($file_path);
    
    }

    public function export(){
        $data = Tugas::get()->toArray();
        return Excel::create('Export Data Tugas '.date("Y-m-d"),function($excel) use ($data){
            $excel->sheet('sheet1',function($sheet) use ($data){
            $sheet->fromArray($data);
        });
        })->download("xlsx");
    }

    

    public function View_Guru(){
        $user = Auth::user()->id_guru;
        $data = Tugas::with('Guru')->where('id',$user)->get();
        return view('tugas.index',compact('data'));   
    }

    public function View_Siswa(){
        $users = Auth::user()->Siswa->nama;
        $tugas_siswa = Tugas_Siswa::where('siswa',$users);
        $tugas= $tugas_siswa->id_tugas;
        $data = Tugas::with('Guru')->where('id',$tugas)->get();
        return view('tugas.view',compact('data'));
    }

    public function tambah()
    {
        //
        $siswa = Siswa::all();
        $guru = Guru::all();
        return view('tugas.create',compact('guru','siswa'));
    }

    public function ubah($id)
    {
        //
        $tugas = Tugas::findOrFail($id);
        $siswa = Siswa::all();
        $guru = Guru::all();
        return view('tugas.edit',compact('guru','siswa','tugas'));
    }

    public function lihat_siswa()
    {
        $users = Auth::user()->Siswa->nama;
        $tugas_siswa = Tugas_Siswa::where('siswa',$users);
        $data = Tugas::with('Guru')->where('id',$tugas_siswa)->get();
        return view('tugas.view',compact('data')); 
    }
}
