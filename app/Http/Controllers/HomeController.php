<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use Auth;
use Alert;
use App\Artikel;
use App\Kelas;
use App\Guru;
use App\Kategori;
use App\Review;
use App\Siswa;
use App\Tugas;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function timeZone($location){
        return date_default_timezone_set($location);
    }
   
    public function index()
    {

        
        Alert::success('Selamat Anda Berhasil Login')->autoclose(1700);
        $this->timeZone('Asia/Jakarta');
        $user_id = Auth::user()->id;
        $date = date("Y-m-d");
        $cek_absen = Absen::where(['user_id' => $user_id, 'date' => $date])
                            ->get()
                            ->first();
        if (is_null($cek_absen)) {
            $info = array(
                "status" => "Anda belum mengisi absensi!",
                "btnIn" => "",
                "btnOut" => "disabled");
        } elseif ($cek_absen->time_out == NULL) {
            $info = array(
                "status" => "Jangan lupa absen keluar",
                "btnIn" => "disabled",
                "btnOut" => "");
        } else {
            $info = array(
                "status" => "Absensi hari ini telah selesai!",
                "btnIn" => "disabled",
                "btnOut" => "disabled");
        }

        $data_absen = Absen::where('user_id', $user_id)
                        ->orderBy('time_out', 'desc')
                        ->paginate(20);

        $artikel = Artikel::count();
        $siswa = Siswa::count();
        $guru = Guru::count();
        $user = User::count();
        $tugas = Tugas::count();
        $kelas = Kelas::count();
        $kategori = Kategori::count();
        $reviews = Review::count();
        return view('home', compact('tugas','kelas','data_absen','artikel','siswa','guru','info','user','reviews','kategori'));
        

        
    }

    public function store(Request $request){

        Alert::success('Selamat Data Berhasil Disimpan')->autoclose(1700);
        $this->timeZone('Asia/Jakarta');
        $user_id = Auth::user()->id;
        $date = date("Y-m-d"); // 2017-02-01
        $time = date("H:i:s"); // 12:31:20
        $note = $request->note;

        $absen = new Absen;
        $absen->user_id =Auth::user()->id;
        $absen->date = $date;
        $absen->time_in = $time;
        $absen->note = $note;


        $absen->save();
        return redirect()->route('home.index');


    }

    public function update(Request $request, $id)
    {
        Alert::success('Selamat Data Berhasil Disimpan')->autoclose(1700);
        $this->timeZone('Asia/Jakarta');
        $time = date("H:i:s"); // 12:31:20
        $note = $request->note;

        $absen = Absen::findOrFail($id);
        $absen->time_out = $time;
        

        $absen->save();
        return redirect()->route('home.index');
    }




        

}
