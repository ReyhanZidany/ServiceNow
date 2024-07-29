<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoodAuthController extends Controller
{
    public function index(Request $request)
    {
        return view('login'); 
    }

    public function processlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['loginError' => 'Invalid username or password.']);
        } 

        return redirect()->route('home');
    }
    
    public function logout()
    {
       
        Auth::logout();
        return redirect()->route('login');
    }
}
