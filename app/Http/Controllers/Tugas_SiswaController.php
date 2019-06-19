<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tugas_Siswa;
use App\Tugas;
Use File;
use Alert;
class Tugas_SiswaController extends Controller
{
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kirim($id)
    {
        //
        $tugas_siswa = Tugas_Siswa::findOrFail($id);
        $tugas = Tugas::where('id', $tugas_siswa->id_tugas )->first();
        return view('tugas_siswa.kirim',compact('tugas','tugas_siswa'));
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
        Alert::success('Selamat Data Berhasil Dikirim')->autoclose(3000);
        $this->validate($request,[
            'file' => 'required',
            'ket' => 'required',
            'batas' =>'',
            
        ]);
        $data = Tugas_Siswa::findOrFail($id);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPath = public_path().'/File/Tugas/Kirim/';
            $filename = $file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);
            $data->file = $filename;
            }
        $tgl_sekarang=date("Y-m-d");//tanggal sekarang
        $batas=$request->batas;
        if ($batas >= $tgl_sekarang){
            Alert::error('Maaf Tugas Sudah Anda Sudah Melawati Batas Waktu')->autoclose(3000);
            $data->ket = "Belum Tuntas";
            $data->nilai = 0;
 
        }elseif ($batas <= $tgl_sekarang) {
            $data->ket = $request->ket;            
        }
        $data->save();
        return redirect()->route('tugas.show',$data->id_tugas);
    }
        
    

    public function nilai($id)
    {
        //
        $tugas_siswa = Tugas_Siswa::findOrFail($id);
        $tugas = Tugas::where('id', $tugas_siswa->id_tugas )->first();
        return view('tugas_siswa.nilai',compact('tugas_siswa','tugas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aksi_nilai(Request $request, $id)
    {
        //
        Alert::success('Selamat Data Berhasil Disimpan')->autoclose(3000);
        $this->validate($request,[
            'nilai' => 'required',
            'KKM' => '',
        ]);
        $data = Tugas_Siswa::findOrFail($id);
        $nilai = $request->nilai;
        $KKM = $request->KKM;
        if( $nilai < 0){
        Alert::error('Maaf Data Nilai Tidak Boleh Kurang Dari 0')->autoclose(3000);
        return redirect()->route('tugas.nilai'); 
        }elseif ($nilai > 100) {
        Alert::error('Maaf Data Nilai Tidak Boleh Lebih Dari 100')->autoclose(3000);
        return redirect()->route('tugas.edit');
        }else{
            if ($nilai <  $KKM) {
                $data->nilai =$nilai;
                $data->ket = "Belum Tuntas";
            }elseif ($nilai >= $KKM) {
                $data->nilai =$nilai;
                $data->ket = "Tuntas";
            }
        }

        $data->save();
        return redirect()->route('tugas.show',$data->id_tugas);


}

public function unduh($id)
    {
        //
        $tugas_siswa = Tugas_Siswa::findOrFail($id);
        return view('tugas_siswa.unduh',compact('tugas_siswa'));
    }

    public function download($file) {

    $file_path = public_path('/File/Tugas/Kirim/'.$file);
    return response()->download($file_path);
    
    }
}