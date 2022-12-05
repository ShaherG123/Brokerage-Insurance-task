<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->type == 'admin') {
                return Redirect::to("users");
            }else{
                return Redirect::to("customers");
            }
        }
        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function logout()
    {
        // Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
