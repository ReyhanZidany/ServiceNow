<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\User;
use App\Models\History;
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('ticket_images', 'public');
            $validated['image'] = $path;
        }

        $new = Ticket::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => $validated['user_id'],
            'createdat' => Carbon::now(),
            'solvedat' => null,
            'solutiondesc' => null,
        ]);
       

        History::create([
            'ticket_id' => $new['id'],
            'activity' => sprintf(
                'ticket created by %s on %s with title %s assigned to user id ( %s )',
                Auth::user()->role, 
                Carbon::now(),
                $validated['title'],
                $validated['user_id']
            )
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
        $ticket->status = 'closed'; 
        $ticket->save();

        

       

        History::create([
            'ticket_id' => $ticket['id'],
            'activity' => sprintf(
            'Ticket resolved by %s on %s with solution "%s"',
            Auth::user()->role,
            Carbon::now()->toDateTimeString(),
            $validated['solution']
            ),
        ]);

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
        $data = History::all();
        
        return view('history', compact('data'));
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'servicedesk') {
            $unsolvedTickets = Ticket::whereNull('solvedat')->count();
            $solvedTickets = Ticket::whereNotNull('solvedat')->count();
        } else {
            $unsolvedTickets = Ticket::where('user_id', $user->id)->whereNull('solvedat')->count();
            $solvedTickets = Ticket::where('user_id', $user->id)->whereNotNull('solvedat')->count();
        }

        $totalTickets = $unsolvedTickets + $solvedTickets;

        return view('home', compact('totalTickets','unsolvedTickets', 'solvedTickets'));
    }

    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function uploadProfilePicture(Request $request)
    {
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('profile_picture')) {
        $imageName = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->storeAs('profile_pictures', $imageName, 'public');
        $user->profile_picture = 'profile_pictures/' . $imageName;
    }

    $user->save();

    return back()->with('success', 'Profile picture updated successfully.');
    }
    

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
