<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use App\Models\History;
use Error;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;

class GoodTicketController extends Controller
{
    public function index()
    {
        return view('tickets', ['data' => Ticket::when(Auth::user()->role != 'servicedesk', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })
        ->paginate(15) ]);
    }


    public function create()
    {
        $users = User::where('role', '<>', 'servicedesk')->get();
        return view('add_ticket', compact('users'));
    }


    public function detail(Ticket $ticket)
    {        
        return view('ticketview', ['ticket' => $ticket]);
    }


    public function store(TicketStoreRequest $request)
    {

        try {
            DB::transaction(function () use($request) {
                if ($request->hasFile('image')) {
                    $path = $request->file('image')->store('ticket_images', 'public');
                    $validated['image'] = $path;
                }
        
                $new = Ticket::create([
                    'title' => $request->validated('title'),
                    'description' =>  $request->validated('description'),
                    'user_id' =>  $request->validated('user_id'),
                    'createdat' => Carbon::now(),
                    'solvedat' => null,
                    'solutiondesc' => null,
                ])
                ->histories()->create([
                    'activity' => sprintf(
                        'ticket created by %s on %s with title %s assigned to user id ( %s )',
                        Auth::user()->role, 
                        Carbon::now(),
                        $request->validated('title'),
                        $request->validated('user_id'),
                    )
                ]);
               
            });
            
            return redirect()->route('tickets.index')->with('success', 'Ticket created successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('tickets.index')->with('success', 'Ticket unsuccessfully! ' . $th->getMessage());
        }

        
    }

    public function edit(Ticket $ticket)
    {
        return view('edit_ticket', ['ticket' => $ticket]);
    }

    public function update(TicketUpdateRequest $request, Ticket $ticket)
    {
        try {
            DB::transaction(function () use($ticket, $request) {
                $ticket->solutiondesc = $request->validated('solution');
                $ticket->solvedat = Carbon::now();
                $ticket->status = 'closed'; 
                $ticket->save();
        
                History::create([
                    'ticket_id' => $ticket['id'],
                    'activity' => sprintf(
                    'Ticket resolved by %s on %s with solution "%s"',
                    Auth::user()->role,
                    Carbon::now()->toDateTimeString(),
                    $request->validated('solution')
                    ),
                ]);
            });
            
        return redirect()->route('tickets.index')->with('success', 'Ticket updated and moved to history!');

        } catch (\Throwable $th) {
            return redirect()->route('tickets.index')->with('success', 'Ticket gagal! ' . $th->getMessage());
        }
        
        
    }


}