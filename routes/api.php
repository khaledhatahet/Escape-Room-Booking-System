<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\EscapeRoomController;
use App\Http\Controllers\Api\AuthenticationController;

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


Route::get('escape-rooms',[EscapeRoomController::class  , 'index']);
Route::get('escape-rooms/{id}',[EscapeRoomController::class  , 'show']);
Route::get('escape-rooms/{id}/time-slots',[EscapeRoomController::class,'timeSlots']);
Route::post('bookings',[BookingController::class , 'store']);
Route::get('bookings',[BookingController::class , 'index'])->middleware('auth:api');
Route::delete('bookings/{id}',[BookingController::class , 'destroy']);

Route::post('registerUser',[AuthenticationController::class,'registerUser']);
Route::post('loginUser',[AuthenticationController::class,'loginUser']);
