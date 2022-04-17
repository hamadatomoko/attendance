<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = array('id');
      public static $rules = array(
        'start_time' => 'required',
        'end_time' => 'required',
    );
     protected $dates = [
        'start_time',
        'end_time'
    ];
}
