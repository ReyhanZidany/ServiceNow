<?php

namespace App\Http\Controllers;

use App\Http\Dto\TicketStoreDto;
use App\Http\Dto\TicketUpdateDto;
use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;
use App\Http\Services\TicketService;
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
    public function __construct(
        protected TicketService $ticketService
    )
    {

    }
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

    public function edit(Ticket $ticket)
    {
        return view('edit_ticket', ['ticket' => $ticket]);
    }


    public function store(TicketStoreRequest $request)
    {

        try {
            DB::transaction(function () use($request) {
                
             $this->ticketService->store(TicketStoreDto::fromAppRequest($request));  
            });
            
            return redirect()->route('tickets.index')->with('success', 'Ticket created successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('tickets.index')->with('success', 'Ticket unsuccessfully! ' . $th->getMessage());
        }

        
    }
     

    public function update(TicketUpdateRequest $request, Ticket $ticket)
    {
        try {
            DB::transaction(function () use($ticket, $request) {
                $this->ticketService->update(TicketUpdateDto::fromAppRequest($request), $ticket);
        
            });
            
        return redirect()->route('tickets.index')->with('success', 'Ticket updated and moved to history!');

        } catch (\Throwable $th) {
            return redirect()->route('tickets.index')->with('success', 'Ticket gagal! ' . $th->getMessage());
        }
        
        
    }


}