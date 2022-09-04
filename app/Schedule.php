<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        'start_time' => 'required|date',
        'end_time' => 'required|date|date_equals:start_time',
        'memo' => 'max:50',
    );
    public function user()
    {
        return $this->belongsTo('App\User');
    }  //
}
