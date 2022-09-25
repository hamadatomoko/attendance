<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'start_time' => 'required|date',
        'end_time' => 'required|date|date_equals:start_time',
        'memo' => 'max:50',
    );
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
