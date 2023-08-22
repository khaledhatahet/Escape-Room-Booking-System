<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number_of_participants' => $this->number_of_participants,
            'booking_date' => $this->booking_date,
            'user' => new UserResource($this->user),
            'room' => new EscapeRoomResource($this->room),
            'time_slot' => new TimeSlotResource($this->timeSlot)
        ];
    }
}
