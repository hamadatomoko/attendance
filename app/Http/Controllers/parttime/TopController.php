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
        // $schedules= Schedule::where("user_id", Auth::id())->get();
        $schedules= Schedule::all();
        $events =array();
        $date= $request->date;
        if (is_null($date)) {
            $date=now();
        }
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
                'textColor' => $this->setTextColor($schedule),
                'backgroundColor' => $this->setEventColor($schedule),
                'display' => 'block',
            );
        }
        $events = json_encode($events, JSON_PRETTY_PRINT);
        $dt_from = new \Carbon\Carbon();
        $dt_from->startOfMonth();

        $dt_to = new \Carbon\Carbon();
        $dt_to->endOfMonth();

        $reports = Schedule::whereBetween('start_time', [$dt_from, $dt_to])->get();
        return view('parttime.top', ['events' => $events,"date"=>$date]);
    }
    private function setTextColor($schedule)//
    {
        $color = '';
        
        if ($schedule->schedule_type == 0) {
            // 予定タイプがシフト
            if ($schedule->status==0) {
                $color='black';
            }
            if ($schedule->status==1) {
                $color='white';
            }
            if ($schedule->status==2) {
                $color='black';
            }
        } elseif ($schedule->schedule_type == 1) {
            // 予定タイプがイベント
            $color='black';
        } else {
            // 予定タイプがお知らせ
            $color='black';
        }
        return $color;
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
