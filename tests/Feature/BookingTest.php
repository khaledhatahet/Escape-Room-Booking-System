<?php

namespace Tests\Feature;

use App\Models\Booking;
use Tests\TestCase;
use App\Models\Room;
use App\Models\User;
use App\Models\TimeSlot;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_all_bookings_for_authenticated_user(){
        $user = User::factory()->create();

        Passport::actingAs($user);

        $response = $this->get('/api/bookings');

        $response->assertStatus(200)
        ->assertJson(['status' => true]);

    }

    public function test_reject_list_all_bookings_for_unauthenticated_user(){

        $response = $this->get('/api/bookings');

        $response->assertStatus(401)
        ->assertJson(['error' => __('messages.must_login')]);

    }

    public function test_add_new_booking(){

        $user = User::factory()->create();
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

        $response = $this->post('/api/bookings',$booking);

        $response->assertStatus(200)
        ->assertJson(['status' => true]);

    }

    public function test_cancel_a_specific_booking_by_id(){

        $user = User::factory()->create();
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
        Booking::create($booking);

        $response = $this->delete('/api/bookings/1');

        $response->assertStatus(200)
        ->assertJson(['status' => true]);
    }

    public function test_cancel_a_specific_booking_does_not_exists_by_id(){

        $user = User::factory()->create();
        $room = Room::factory()->create();
        $timeSlot = TimeSlot::factory()->create();

        $response = $this->delete('/api/bookings/10');

        $response->assertStatus(404);
    }

    public function test_validation_error_when_add_new_booking(){

        $user = User::factory()->create();
        $room = Room::factory()->create();
        $timeSlot = TimeSlot::factory()->create();

        $booking = [
            'number_of_participants' => 2,
            'booking_date' => '2023-10-15',
            'user_id' => $user->id,
            'room_id' => $room->id,
            // 'time_slot_id' => $timeSlot->id,
            'discount_percentage' => 30
        ];

        $response = $this->post('/api/bookings',$booking);

        $response->assertStatus(302);
    }
}
