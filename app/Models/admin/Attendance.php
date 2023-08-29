<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function punctuality()
    {
        return $this->hasOne(Punctuality::class);
    }

    public function salaryDetails()
    {
        return $this->hasOneThrough(SalaryDetail::class, Employee::class, 'id', 'employee_id');
    }

}
