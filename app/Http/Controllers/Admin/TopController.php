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
            if (isset($schedule->user->name)) {
                $events[] = array(
                'title' => $schedule->user->name,
                'start' => Carbon::parse($schedule->start_time)->format('Y-m-d\TH:i'),
                'end' => Carbon::parse($schedule->end_time)->format('Y-m-d\TH:i'),
                'url' => $schedule->schedule_type == 0 ? '/admin/schedule/edit-parttime?id='.$schedule->id : '/admin/schedule/edit?id='.$schedule->id,
                'textColor' => 'white',
                'backgroundColor' => $this->setEventColor($schedule),
                'display' => 'block',
               );
            }
        }
   
        $events = json_encode($events, JSON_PRETTY_PRINT);
        
        return view('admin.top', ['events' => $events]);
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
