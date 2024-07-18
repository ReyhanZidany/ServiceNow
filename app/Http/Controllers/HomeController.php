<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function division()
    {
        $user = Auth::user();

        if ($credentials['username'] == 'pic') {
            return view('home_pic');
        } elseif ($credentials['username'] == 'servicedesk') {
            return view('home_servicedesk');
        } else {
            
        }
    }

    
}
