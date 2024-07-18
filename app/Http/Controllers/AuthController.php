<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Sesuaikan dengan nama view yang Anda gunakan
    }

    public function processlogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if ($credentials['username'] === 'pic'|| $credentials['username'] === 'servicedesk' && $credentials['password'] === '1234') {
            return redirect()->route('home');
        }

        return back()->withErrors(['loginError' => 'Invalid username or password.']);
    }

    public function home()
    {
        return view('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function ticketlist()
    {
        return view('tickets');
    }
}
