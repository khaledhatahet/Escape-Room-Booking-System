<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\EscapeRoomResource;
use App\Http\Resources\TimeSlotResource;
use App\Http\Traits\GeneralTrait;

class EscapeRoomController extends Controller
{
    use GeneralTrait;

    /**
     * List all escape rooms.
     */
    public function index()
    {
        try {
            $rooms = Room::get();
            return $this->returnData(EscapeRoomResource::collection($rooms));
        } catch (\Throwable $th) {
            return $this->returnError(__('messages.error_when_showing_data'));
        }
    }

    /**
     * Retrieve a specific escape room by its ID.
     */
    public function show(Room $id)
    {
        try {
            return $this->returnData(new EscapeRoomResource($id));
        } catch (\Throwable $th) {
            return $this->returnError(__('messages.error_when_showing_data'));
        }
    }

    /**
     * List available time slots for a specific escape room
     */

    public function timeSlots(Room $id){
        try {
            return $this->returnData( TimeSlotResource::collection($id->timeSlots) );
        } catch (\Throwable $th) {
            return $this->returnError(__('messages.error_when_showing_data'));
        }
    }


}
