<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;

class GoodHistoryController extends Controller
{
    public function tickethistory()
    {
        $data = History::all();
        
        return view('history', compact('data'));
    }
}
