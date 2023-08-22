<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bookings(){
        return $this->hasMany(Booking::class,'room_id','id');
    }

    public function timeSlots(){
        return $this->hasMany(TimeSlot::class,'room_id','id');
    }
}
