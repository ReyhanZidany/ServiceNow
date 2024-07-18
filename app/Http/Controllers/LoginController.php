<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if ($username === 'pic' && $password === '1234') {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')
            ->with('error', 'Username or password is incorrect.');
        }
    }

    public function home()
    {
        return view('home');
    }
}
