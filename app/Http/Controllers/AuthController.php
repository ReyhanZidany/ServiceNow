<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function processlogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if ($credentials['username'] === 'pic' && $credentials['password'] === '1234') {
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['message' => 'Invalid credentials']);
    }
}
