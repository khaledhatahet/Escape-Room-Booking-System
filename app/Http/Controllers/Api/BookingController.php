<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;

class BookingController extends Controller
{
    /**
     * List all bookings for the authenticated user.
     */
    public function index()
    {
        //
    }

    /**
     * Create a new booking
     */
    public function store(StoreBookingRequest $request)
    {
        //
    }


    /**
     * Cancel a specific booking by its ID.
     */
    public function destroy(Booking $id)
    {
        //
    }
}
