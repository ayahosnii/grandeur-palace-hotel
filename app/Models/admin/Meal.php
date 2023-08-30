<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    public function getImageAttribute($value)
    {
        return asset('assets/admin/images/meals/' . $value);
    }
}
