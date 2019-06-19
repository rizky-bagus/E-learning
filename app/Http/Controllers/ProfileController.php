<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Alert;

class ProfileController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return view('users.profile');
    }

    public function ubah($id)
    {
        //
        return view('users.profile');
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
            'email' => 'required',
            'password' => 'required',
            'konfirmasi' => 'required',
            'role' => 'required',
            
        ]);
        $data = User::findOrFail(Auth::user()->id);
        $data->role = $request->role;
        $data->email = $request->email;
        $baru=$request->password;
        $confirm = $request->konfirmasi;

            if ($baru == $confirm) {
               $data->password = bcrypt($confirm);
            }elseif ($baru != $confirm) {
               Alert::error('Maaf Password Baru Dan Konfirmasi Tidak Sesuai')->autoclose(3000);
            return redirect()->route('profile.ubah',Auth::user()->id);
            }
            
        
        
        $data->save();
        return redirect()->route('profile.ubah',Auth::user()->id);
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
    }
}
