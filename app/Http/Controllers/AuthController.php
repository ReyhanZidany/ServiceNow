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
        $users = User::where('role', '<>', 'servicedesk')->get();
        return view('add_ticket', compact('users'));
    }

    public function storeTicket(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Ticket::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => $validated['user_id'],
            'createdat' => Carbon::now(),
            'solvedat' => null,
            'solutiondesc' => null,
        ]);

        return redirect()->route('tickets')->with('success', 'Ticket created successfully!');
    }

    public function editTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('edit_ticket', compact('ticket'));
    }

    public function updateTicket(Request $request, $id)
    {
        $validated = $request->validate([
            'solution' => 'required|string',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->solutiondesc = $validated['solution'];
        $ticket->solvedat = Carbon::now();
        $ticket->status = 'closed'; // Add a status field to indicate the ticket is closed
        $ticket->save();

        $ticket->delete();

        return redirect()->route('tickets')->with('success', 'Ticket updated and moved to history!');
    }

    public function ticketlist()
    {
        $role = Auth::user()->role;
        if ($role == 'servicedesk'){
            $tickets = Ticket::all();
        } else {
            $tickets = Ticket::where('user_id', Auth::user()->id)->get();
        }
        
        return view('tickets', ['data' => $tickets]);
    }

    public function tickethistory()
    {
        $history = Ticket::onlyTrashed()->get();
        return view('history', ['data' => $history]);
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'servicedesk') {
            $totalTickets = Ticket::count();
        } else {
            $totalTickets = Ticket::where('user_id', $user->id)->count();
        }

        return view('home', compact('totalTickets'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
