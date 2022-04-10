<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Illuminate\Support\Carbon;
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
                'eventColor'=>'red',
               'eventBackgroundColor'=>'red',
                'color'=>'red',
            );
       }
       $events = json_encode($events, JSON_PRETTY_PRINT);
       return view('top.index', ['events' => $events]);
    }
   private function setEventColor ($schedule)//
   {
     
   }
}
