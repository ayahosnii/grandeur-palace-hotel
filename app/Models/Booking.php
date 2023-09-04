<?php

namespace App\Models;

use App\Models\admin\BookingRoomPivot;
use App\Models\admin\Room;
use App\Models\admin\RoomsWithNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_in',
        'check_out',
        'booking_code',
        'customer_id',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(RoomsWithNumber::class, 'booking_room_pivot', 'booking_id', 'room_id');
    }



    public function roomsWithNumbers()
    {
        return $this->belongsToMany(RoomsWithNumber::class, 'booking_room_pivot', 'booking_id', 'room_id')
            ->withPivot('quantity');
    }

    public function bookingRoomPivots()
    {
        return $this->hasMany(BookingRoomPivot::class);
    }
}
