<?php

namespace App\Http\Dto;

use App\Http\Requests\TicketUpdateRequest;

class TicketUpdateDto
{
    public function __construct(
        public readonly string $solution
    ) {}

    public static function fromAppRequest(TicketUpdateRequest $request)
    {
        return new self(
            solution: $request->validated('solution'),
        );
    }
}
