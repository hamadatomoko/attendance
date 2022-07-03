<?php

namespace App\Http\Controllers\parttime;

use Illuminate\Http\Request;
use App\Schedule;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function index(Request $request)
    {
        $schedules= Schedule::where("user_id", Auth::id())->get();
        $events =array();
        foreach ($schedules as $schedule) {
            
            // スケジュールタイプが0(シフト)だったら
            if ($schedule->schedule_type == 0) {
                $title=$schedule->user->name;
            } elseif ($schedule->schedule_type == 1) {
                $title=$schedule->title;
            } elseif ($schedule->schedule_type == 2) {
                $title=$schedule->title;
            }
//
            
            $events[] = array(
                'title' => $title,
                'start' => Carbon::parse($schedule->start_time)->format('Y-m-d\TH:i'),
                'end' => Carbon::parse($schedule->end_time)->format('Y-m-d\TH:i'),
                'url' => '/parttime/schedule/edit?id='.$schedule->id,
                'textColor' => 'black',
                'backgroundColor' => $this->setEventColor($schedule),
                'display' => 'block',
            );
        }
        $events = json_encode($events, JSON_PRETTY_PRINT);
        return view('parttime.top', ['events' => $events]);
    }
    
    private function setEventColor($schedule)//
    {
        $color = '';
        
        if ($schedule->schedule_type == 0) {
            // 予定タイプがシフト
            if ($schedule->status==0) {
                $color='red';
            }
            if ($schedule->status==1) {
                $color='blue';
            }
            if ($schedule->status==2) {
                $color='yellow';
            }
        } elseif ($schedule->schedule_type == 1) {
            // 予定タイプがイベント
            $color='pink';
        } else {
            // 予定タイプがお知らせ
            $color='green';
        }
        return $color;
    }
}
