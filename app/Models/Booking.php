<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_in',
        'check_out',
        'room_id',
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
}
