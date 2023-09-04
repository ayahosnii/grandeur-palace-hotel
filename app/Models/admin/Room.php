<?php

namespace App\Models\admin;

use App\Models\Service;
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
        'adults',
        'image',
    ];


    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('assets/admin/images/room_images/' . $this->image);
        }

        return null;
    }


    public function services()
    {
        return $this->belongsToMany(Service::class, 'room_service', 'room_id', 'service_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function roomwithnumber()
    {
        return $this->hasMany(RoomsWithNumber::class);
    }

}
