<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function login(Request $request)
    {
        $user = Auth::user();
        if ($user->role==0) {
            return redirect('/admin');
        } else {
            return  redirect('/parttime');
        }
    }
    public function index(Request $request)
    {
        $schedules= Schedule::all();

        $events =array();
        foreach ($schedules as $schedule) {
            if ($schedule->schedule_type == 0) {
                if (isset($schedule->user->name)) {
                    $title=$schedule->user->name;
                }
            } elseif ($schedule->schedule_type == 1) {
                $title=$schedule->title;
            } elseif ($schedule->schedule_type == 2) {
                $title=$schedule->title;
            }

            $events[] = array(
            'title' => $title,
            'start' => Carbon::parse($schedule->start_time)->format('Y-m-d\TH:i'),
            'end' => Carbon::parse($schedule->end_time)->format('Y-m-d\TH:i'),
            'url' => $schedule->schedule_type == 0 ? '/admin/schedule/edit-parttime?id='.$schedule->id : '/admin/schedule/edit?id='.$schedule->id,
            'textColor' => $this->setTextColor($schedule),
            'backgroundColor' => $this->setEventColor($schedule),
            'display' => 'block',
           );
        }
   
        $events = json_encode($events, JSON_PRETTY_PRINT);
        
        return view('admin.top', ['events' => $events]);
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
    }    //
}
