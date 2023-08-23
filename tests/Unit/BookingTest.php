<?php

namespace Tests\Unit;

use App\Exceptions\LimitOfParticipantsException;
use App\Exceptions\ProblemWithRoomNumberException;
use Tests\TestCase;
use App\Models\Room;
use App\Models\User;
use App\Models\Booking;
use App\Models\TimeSlot;
use App\Services\BookingService;
use App\Exceptions\ThereIsAnotherBookingException;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_apply_birthday_discount(){

        $user = User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'date_of_birth' => '2023-08-23'
        ]);
        $room = Room::factory()->create();
        $timeSlot = TimeSlot::factory()->create();

        $booking = [
            'number_of_participants' => 2,
            'booking_date' => '2023-10-15',
            'user_id' => $user->id,
            'room_id' => $room->id,
            'time_slot_id' => $timeSlot->id,
            'discount_percentage' => 30
        ];

        $result = (new BookingService)->storeBooking($booking);

        $this->assertEquals($booking["discount_percentage"] + 10 , $result->discount_percentage);

    }


    public function test_reject_double_booking_in_same_time(){

        $user = User::factory()->create();
        $room = Room::factory()->create();
        $timeSlot = TimeSlot::factory()->create();
        $oldBooking = Booking::create([
            'number_of_participants' => 2,
            'booking_date' => '2023-10-15',
            'user_id' => $user->id,
            'room_id' => $room->id,
            'time_slot_id' => $timeSlot->id,
            'discount_percentage' => 30
        ]);
        $booking = [
            'number_of_participants' => 2,
            'booking_date' => '2023-10-15',
            'user_id' => $user->id,
            'room_id' => $room->id,
            'time_slot_id' => $timeSlot->id,
            'discount_percentage' => 30
        ];

        $this->expectException(ThereIsAnotherBookingException::class);
        (new BookingService)->storeBooking($booking);
    }

    public function test_limit_of_participants(){

        $user = User::factory()->create();
        $room = Room::factory()->create();
        $timeSlot = TimeSlot::factory()->create();

        $booking = [
            'number_of_participants' => 15,
            'booking_date' => '2023-10-15',
            'user_id' => $user->id,
            'room_id' => $room->id,
            'time_slot_id' => $timeSlot->id,
            'discount_percentage' => 30
        ];

        $this->expectException(LimitOfParticipantsException::class);

        (new BookingService)->storeBooking($booking);
    }

    public function test_room_id_does_not_same_with_time_slot_room_id(){

        $user = User::factory()->create();
        $room = Room::factory()->create();
        $timeSlot = TimeSlot::factory()->create();

        $booking = [
            'number_of_participants' => 15,
            'booking_date' => '2023-10-15',
            'user_id' => $user->id,
            'room_id' => 2,
            'time_slot_id' => $timeSlot->id,
            'discount_percentage' => 30
        ];

        $this->expectException(ProblemWithRoomNumberException::class);

        (new BookingService)->storeBooking($booking);
    }

}
