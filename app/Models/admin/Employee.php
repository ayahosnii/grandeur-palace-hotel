<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function salaryDetails()
    {
        return $this->hasOne(SalaryDetail::class);
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function punctualities()
    {
        return $this->hasManyThrough(Punctuality::class, Attendance::class, 'employee_id', 'attendance_id');
    }

    public function getImageAttribute($value)
    {
        return asset('assets/admin/images/employees/' . $value);
    }
}
