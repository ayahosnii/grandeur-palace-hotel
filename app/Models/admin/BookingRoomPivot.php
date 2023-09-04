<?php

namespace App\Models\admin;

use App\Models\admin\Room;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;

class BookingRoomPivot extends Model
{
    protected $table = 'booking_room_pivot';

    protected $fillable = [
        'booking_id',
        'room_id',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

}
