<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getActive(){
        return  $this -> is_active  == 0 ?  'غير مفعل'   : 'مفعل' ;
    }

}
