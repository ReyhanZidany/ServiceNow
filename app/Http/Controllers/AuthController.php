<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Carbon\Carbon;


class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        // $ticket = Ticket::create([
        //     'title' => 'payaa',
        //     'description' => 'hmmm',
        //     'user_id' => rand(2,3),
        //     'createdat' => Carbon::now(),
        //     'solvedat' => Carbon::now(),
        //     'solutiondesc' => 'tidak ada solusi',
        // ]);
        return view('login'); 
    }

    public function processlogin(Request $request)
    {
      
        $credentials = $request->only('email', 'password');
        
        (Auth::attempt($credentials));
        

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }else {
            return back()->withErrors(['loginError' => 'Invalid username or password.']);
        } 
    
    }

    public function home()
    {
    
        $user = Auth::user();
        $role = Auth::user()->role;


        return view('home');
    }

    public function createTicket()
    {
        return view('add_ticket');
    }

    public function storeTicket(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    Ticket::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'user_id' => Auth::id(), // Assuming you want to associate the ticket with the currently logged-in user
        'createdat' => Carbon::now(),
        'solvedat' => null, // Set this to null or a default value if not applicable
        'solutiondesc' => null, // Set this to null or a default value if not applicable
    ]);

    return redirect()->route('tickets')->with('success', 'Ticket created successfully!');
}

    public function ticketlist()
    {

        $role = Auth::user()->role; 
        // Auth = ambil data yang sudah login
    
        // if ($role == 'servicedesk'){
        //     return (Ticket::all());
        // } else {
        //     return (Ticket::where('user_id', Auth::user()->id)->get());
        // }
       
        // $ticket = Ticket::create([
        //     'title' => 'kungkingkang',
        //     'description' => 'hmmm',
        //     'user_id' => rand(2,3),
        //     'createdat' => Carbon::now(),
        //     'solvedat' => Carbon::now(),
        //     'solutiondesc' => 'tidak ada solusi',
        // ]);

        return view('tickets', ['data' => Ticket::all()]);

        // return view('tickets');
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
