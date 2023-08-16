<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_type',
        'price_per_night',
        'size',
        'capacity',
        'bed_type',
        'services',
        'tv',
        'wifi',
        'air_condition',
        'heater',
        'phone',
        'laundry',
        'adults',
        'image',
    ];


    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('assets/img/room/' . $this->image);
        }

        return null;
    }


}
