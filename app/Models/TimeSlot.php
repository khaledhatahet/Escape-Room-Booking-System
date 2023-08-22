<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function room(){
        return $this->belongsTo(Room::class,'room_id','id');
    }

    public function bookings(){
        return $this->hasMany(Booking::class,'time_slot_id','id');
    }


}
