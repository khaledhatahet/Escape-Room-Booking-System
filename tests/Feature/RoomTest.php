<?php

namespace Tests\Feature;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomTest extends TestCase
{
    use RefreshDatabase;


    public function test_list_all_rooms(){

        $response = $this->get('/api/escape-rooms');

        $response->assertStatus(200)
        ->assertJson(['status' => true]);
    }

    public function test_retrieve_a_specific_escape_room_by_id(){

        Room::factory()->count(10)->create();
        $id = rand(1,10);
        $response = $this->get('/api/escape-rooms/' . $id);

        $response->assertStatus(200)
        ->assertJson(['status' => true]);
    }

    public function test_list_available_time_slots_for_a_specific_escape_room(){

        Room::factory()->count(10)->create();
        $id = rand(1,10);
        $response = $this->get('/api/escape-rooms/' . $id . '/time-slots');

        $response->assertStatus(200)
        ->assertJson(['status' => true]);
    }
}
