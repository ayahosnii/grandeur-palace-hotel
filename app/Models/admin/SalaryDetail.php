<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'effective_date' => 'date',
    ];

}
