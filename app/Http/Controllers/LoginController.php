<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view('login');
    }

    public function login_user(Request $request)
    {
        if(Auth::attempt([
            'email' =>$request->input('email'),
            'password' =>$request->input('password'),
        ]))
        {
        return response()->json(['success' => 'Successfully Logged In']);
        }
        else
        {
        return response()->json(['error' => 'Something Went Wrong']);

        }
    }
}
