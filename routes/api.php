<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\EscapeRoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('bookings', BookingController::class)->only('index','store','destroy');
Route::resource('escape-rooms', EscapeRoomController::class)->only('index','show');
Route::get('escape-rooms/{id}/time-slots',[EscapeRoomController::class,'timeSlots']);
