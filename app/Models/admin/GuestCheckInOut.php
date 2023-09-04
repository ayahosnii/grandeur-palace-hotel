<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestCheckInOut extends Model
{
    public function checkInType()
    {
        return $this->belongsTo(CheckInType::class);
    }
}

