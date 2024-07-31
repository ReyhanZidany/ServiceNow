<?php

namespace App\Http\Dto;

use App\Http\Requests\TicketStoreRequest;
use Illuminate\Http\UploadedFile;

class TicketStoreDto
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly string $user_id,
        public readonly ?UploadedFile $image,

    ) {}

    public static function fromAppRequest(TicketStoreRequest $request)
    {
        return new self(
            title: $request->validated('title'),
            description: $request->validated('description'),
            user_id: $request->validated('user_id'),
            image: $request->file('image'),
        );

    }
}
