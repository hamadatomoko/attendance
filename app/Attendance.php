<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = array('id');
    public $dates = [
        'start_time' ,
        'end_time' ,
    ];
    public static $rules = array(
         'start_time' => 'required|date',
        'end_time' => 'required|date',
        'memo' => 'max:300',
    );
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
