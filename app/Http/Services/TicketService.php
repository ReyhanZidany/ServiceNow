<?php

namespace App\Http\Services;

use App\Http\Dto\TicketStoreDto;
use App\Http\Dto\TicketUpdateDto;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TicketService
{
    public function store(TicketStoreDto $dto)
    {
        // if ($request->hasFile('image')) {
        //     $path = $request->file('image')->store('ticket_images', 'public');
        //     $validated['image'] = $path;
        // }
        $now = Carbon::now();

        Ticket::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'user_id' => $dto->user_id,
            'createdat' => $now,
            'solvedat' => null,
            'solutiondesc' => null,
        ])
            ->histories()->create([
            'activity' => sprintf(
                'ticket created by %s on %s with title %s assigned to user id ( %s )',
                Auth::user()->role,
                $now,
                $dto->title,
                $dto->user_id,
            ),
        ]);
    }

    public function update(TicketUpdateDto $dto, Ticket $ticket)
    {
        $now = Carbon::now();

        $ticket->update([
            'solvedat' => $now,
            'solutiondesc' => $dto->solution,
            'status' => 'closed',
        ]);

        $ticket->histories()->create([
            'ticket_id' => $ticket['id'],
            'activity' => sprintf(
                'Ticket resolved by %s on %s with solution "%s"',
                Auth::user()->role,
                $now->toDateTimeString(),
                $dto->solution,
            ),
        ]);
    }
}
