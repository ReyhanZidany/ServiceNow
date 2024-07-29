<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

class GoodHomeController extends Controller
{
    public function index()
    {
        
        $user = Auth::user();

        $unsolvedTickets = Ticket::whereNull('solvedat')
            ->when($user->role !== 'servicedesk', function($query) use($user){
                $query->where('user_id', $user->id);
            })
            ->count();
        
        $solvedTickets = Ticket::whereNotNull('solvedat')
            ->when($user->role !== 'servicedesk', function($query) use($user){
                $query->where('user_id', $user->id);
            })
            ->count();
        
        $totalTickets = $unsolvedTickets + $solvedTickets;

        return view('home', compact('totalTickets','unsolvedTickets', 'solvedTickets'));
    }

    
}
