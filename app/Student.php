<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'students';
    protected $fillable = ['festember_id', 'card', 'name', 'roll_no'];
    protected $visible = ['festember_id', 'card', 'name', 'roll_no', 'facebook_id'];
}
