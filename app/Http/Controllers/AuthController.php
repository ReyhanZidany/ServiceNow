<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        return view('login'); 
    }

    public function processlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return back()->withErrors(['loginError' => 'Invalid username or password.']);
        } 
    }

    public function home()
    {
        return view('home');
    }

    public function createTicket()
    {
        // Fetch users excluding the ones with the role "servicedesk"
        $users = User::where('role', '<>', 'servicedesk')->get();
        return view('add_ticket', compact('users'));
    }

    public function storeTicket(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id', // Add validation for user_id
        ]);

        Ticket::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => $validated['user_id'], // Use selected user ID
            'createdat' => Carbon::now(),
            'solvedat' => null,
            'solutiondesc' => null,
        ]);

        return redirect()->route('tickets')->with('success', 'Ticket created successfully!');
    }

    public function ticketlist()
    {
        return view('tickets', ['data' => Ticket::all()]);
    }

    public function index()
    {
        $totalTickets = Ticket::count();
        return view('home', compact('totalTickets'));
    }

    public function tickethistory()
    {
        return view('history');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
