<?php

namespace App\Models\admin;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomsWithNumber extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rooms_with_number';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Define the relationship with the rooms table.
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }


    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_room_pivot', 'room_id', 'booking_id')
            ->withPivot(['quantity']);
    }
}
