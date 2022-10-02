<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wage extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'start_day' => 'required|date',
        'end_day' => 'required|date',
        'wage' => 'required',
    );
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    //
}
