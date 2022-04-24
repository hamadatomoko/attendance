<?php

namespace App\Http\Controllers\parttime;

use Illuminate\Http\Request;
use App\Schedule;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class TopController extends Controller
{
    public function index(Request $request)
    {
        $schedules= Schedule::all();  
        $events =array();
        foreach( $schedules as $schedule)
        {
            $events[] = array(
                'title' => $schedule->user->name,
                'start' => Carbon::parse($schedule->start_time)->format('Y-m-d\TH:i'),
                'end' => Carbon::parse($schedule->end_time)->format('Y-m-d\TH:i'),
                'url' => '/parttime/schedule/edit?id='.$schedule->id,
                'textColor' => 'white',
                'backgroundColor' => $this->setEventColor($schedule),
                'display' => 'block',
            );
       }
       $events = json_encode($events, JSON_PRETTY_PRINT);
       return view('parttime.top', ['events' => $events]);
    }
    
    private function setEventColor ($schedule)//
    {
        $color = '';
        
        if ($schedule->schedule_type == 0) {
            // 予定タイプがシフト
            if ($schedule->status==0){
                $color='red';
            }
            if ($schedule->status==1){
                $color='blue';
            }   
            if ($schedule->status==2){
                $color='yellow';
            }
        } else if ($schedule->schedule_type == 1) {
            // 予定タイプがイベント
            $color='pink';
        } else {
            // 予定タイプがお知らせ
            $color='green';
        }
        return $color;
    }
}
