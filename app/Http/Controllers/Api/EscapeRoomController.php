<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\EscapeRoomResource;
use App\Http\Resources\TimeSlotResource;

class EscapeRoomController extends Controller
{
    /**
     * List all escape rooms.
     */
    public function index()
    {
        try {
            $rooms = Room::paginate(10);
            return EscapeRoomResource::collection($rooms);
        } catch (\Throwable $th) {
            return __('messages.error_when_showing_data');
        }
    }

    /**
     * Retrieve a specific escape room by its ID.
     */
    public function show(Room $id)
    {
        try {
            return new EscapeRoomResource($id);
        } catch (\Throwable $th) {
            return __('messages.error_when_showing_data');
        }
    }

    /**
     * List available time slots for a specific escape room
     */

    public function timeSlots(Room $id){
        try {
            return TimeSlotResource::collection($id->timeSlots);
        } catch (\Throwable $th) {
            return __('messages.error_when_showing_data');
        }
    }


}
