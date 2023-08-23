<?php


namespace App\Services;

use App\Models\Room;
use App\Models\Booking;
use App\Exceptions\LimitOfParticipantsException;
use App\Exceptions\ProblemWithRoomNumberException;
use App\Exceptions\ThereIsAnotherBookingException;
use App\Models\TimeSlot;
use App\Models\User;

class BookingService{

    public function storeBooking($data): Booking {

        $checkTimeSlot = Booking::where('time_slot_id',$data["time_slot_id"])->count();
        if($checkTimeSlot > 0){ // check if there is any booking in same time
            throw new ThereIsAnotherBookingException();
        }

        $timeSlotRoomId = TimeSlot::find($data["time_slot_id"])->room_id;
        if($timeSlotRoomId != $data["room_id"]){ // check if the room_id of time_slot is equal to room_id wich sent with booking request
            throw new ProblemWithRoomNumberException();
         }

        $MaximumNumberOfParticipantsAllowed = Room::find($data["room_id"])->maximum_number_of_participants;
        if($MaximumNumberOfParticipantsAllowed < $data["number_of_participants"]){ // check maximum number of participant allowed
           throw new LimitOfParticipantsException();
        }

        $userBirthDay = User::find($data["user_id"])->date_of_birth;
        $birthdate = \Carbon\Carbon::parse($userBirthDay);
        $formattedDate = $birthdate->format('m-d');
        if($formattedDate == date('m-d')){
            $data["discount_percentage"] = isset($data["discount_percentage"]) ?   $data["discount_percentage"] +10 : 10;
        }

        return Booking::create($data);

    }

}
?>
