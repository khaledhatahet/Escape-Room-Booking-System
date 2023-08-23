<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;


    public function test_validation_error_when_register_user(){

        $data = [
            "name" => fake()->name,
            // "email" => fake()->unique()->email,
            "password" => "test",
            "repassword" => "test",
            "date_of_birth" => fake()->date(),
        ];

        $response = $this->post('/api/registerUser',$data);

        $response->assertStatus(302);
    }

    public function test_validation_error_when_login_user(){

        $data = [
            "email" => "kk@gmail.com",
            "password" => ""
        ];

        $response = $this->post('/api/loginUser',$data);
        $response->assertStatus(302);

    }

    public function test_incorrect_login_data_when_login_user(){

        $data = [
            "email" => "kk@gmail.com",
            "password" => "asdasdad"
        ];

        $response = $this->post('/api/loginUser',$data);
        $response->assertStatus(200)
        ->assertJson(['status' => false , 'msg' => __('messages.incorrectLoginData')]);

    }
}
