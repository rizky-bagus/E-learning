<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Siswa;
use App\Guru;
use Alert;
use Auth;
use Excel;

class UsersController extends Controller
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
        $data = User::with('Guru','Siswa')->orderBy('created_at', 'desc')->get();
        return view('users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $siswa = Siswa::doesnthave('User')->get();
        return view('users.create',compact('siswa'));
    }

    public function createguru()
    {
        //
        $guru = Guru::doesnthave('User')->get();
        return view('users.createguru',compact('guru'));
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
        Alert::success('Selamat Data Berhasil Disimpan')->autoclose(3000);
        $this->validate($request,[
            'id_siswa' =>'unique:users',
            'id_guru' => 'unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
            
            
        ]);
        $data = new User;
        $data->id_siswa = $request->id_siswa;
        $data->id_guru = $request->id_guru;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->role = $request->role;
        $data->save();
        return redirect()->route('users.index');
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

        $users = User::findOrFail($id);
        $siswa = Siswa::all();
        $guru = Guru::all();
        return view('users.edit',compact('users','siswa','guru'));
        
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
        Alert::success('Selamat Data Berhasil Diubah')->autoclose(3000);
        $this->validate($request,[
            'id_siswa',
            'id_guru',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            
            
        ]);
        $data = User::findOrFail($id);
        $data->id_siswa = $request->id_siswa;
        $data->id_guru = $request->id_guru;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->role = $request->role;
        $data->save();
        return redirect()->route('users.index');



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
        $users = User::findOrFail($id);
        $users->delete();
        return redirect()->route('users.index');
    }

    public function export(){
        Alert::success('Data Successfully Download','Good Job!')->autoclose(3000);
        $data = User::get()->toArray();
        return Excel::create('Export Data Users '.date("Y-m-d"),function($excel) use ($data){
            $excel->sheet('sheet1',function($sheet) use ($data){
            $sheet->fromArray($data);
        });
        })->download("xlsx");
    }

    public function aktif(Request $request, $id){
        $data = User::findOrFail($id);
        $data->status = "Aktif";
        $data->save();
        return redirect()->route('users.index');
    }

    public function nonaktif(Request $request, $id){
        $data = User::findOrFail($id);
        $data->status = "NonAktif";
        $data->save();
        return redirect()->route('users.index');
    }

        
    
}
