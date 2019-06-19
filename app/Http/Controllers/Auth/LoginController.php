<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Alert;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    
    
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }


}
