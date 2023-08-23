<?php

namespace App\Http\Controllers\Api;


use App\Models\Booking;
use App\Services\BookingService;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Exceptions\MustLogInException;
use App\Http\Resources\BookingResource;
use App\Http\Requests\StoreBookingRequest;
use App\Exceptions\LimitOfParticipantsException;
use App\Exceptions\ProblemWithRoomNumberException;
use App\Exceptions\ThereIsAnotherBookingException;

class BookingController extends Controller
{
    use GeneralTrait;

    private $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * List all bookings for the authenticated user.
     */
    public function index()
    {
        try {
            $bookings = Booking::get();
            return $this->returnData(BookingResource::collection($bookings));
        } catch (MustLogInException $e) {
            return $e->getMessage();
            return $this->returnError(__('messages.error_when_showing_data'));
        }
    }

    /**
     * Create a new booking
     */
    public function store(StoreBookingRequest $request)
    {

        try {
            $result = $this->bookingService->storeBooking($request->validated());
            if($result){
                return $this->returnSuccessMessage(__('messages.data_added_successfully'));
            }else{
                return $this->returnError(__('messages.error_when_adding_data'));
            }
        } catch (ThereIsAnotherBookingException $e) {
            return $this->returnError($e->getMessage());
        }
          catch (LimitOfParticipantsException $e) {
            return $this->returnError($e->getMessage());
        }
          catch (ProblemWithRoomNumberException $e) {
            return $this->returnError($e->getMessage());
        }
    }


    /**
     * Cancel a specific booking by its ID.
     */
    public function destroy(Booking $id)
    {
        try {
            if($id->delete()){
                return $this->returnSuccessMessage(__('messages.data_deleted_successfully'));
            }else{
                return $this->returnError(__('messages.error_when_deleting_data'));
            }
        } catch (\Throwable $th) {
            return $this->returnError(__('messages.error_when_deleting_data'));
        }
    }
}
