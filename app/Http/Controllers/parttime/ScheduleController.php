<?php

namespace App\Http\Controllers\parttime;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Schedule;
use App\cevent;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ScheduleCreateRequest;

class ScheduleController extends Controller
{
    public function add($date)
    {
        $start_time  =$date.'T00:00:00';
        $end_time  =$date.'T00:00:00';
        return view('parttime.schedule.create', ['start_time'=>$start_time,'end_time'=>$end_time,]);
    }
    
    public function create(ScheduleCreateRequest $request)
    {
        $schedule= new Schedule;
        $form = $request->all();
      
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        // データベースに保存する
        $schedule->fill($form);
        $schedule->save();
      
        return redirect('/parttime');
    }//
    public function edit(Request $request)
    {
        $schedule= Schedule::find($request->id);
        $schedule->start_time= Carbon::parse($schedule->start_time)->format('Y-m-d\TH:i');
        $schedule->end_time= Carbon::parse($schedule->end_time)->format('Y-m-d\TH:i');
      

        if (empty($schedule)) {
            abort(404);
        }
      
        if ($schedule->user->id != Auth::id()) {
            abort(404);
        }
      
      
        return view('parttime.schedule.edit', ['sform' => $schedule,'memo_form'=>$schedule->memo]);
    }
    public function update(ScheduleCreateRequest $request)
    {
        $schedule= Schedule::find($request->id);
        // 承認済みか確認する
        if ($schedule->status==1) {
            
            // 更新せずリダイレクト
            return redirect('/parttime');
        }
      
        // 送信されてきたフォームデータを格納する
        $form = $request->all();
        unset($form['_token']);

        // 該当するデータを上書きして保存する
        $schedule->fill($form)->save();

        return redirect('/parttime?date='.$schedule->start_time);
    }
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $schedule= Schedule::find($request->id);
        // 削除する
        $schedule->delete();
        return redirect('/parttime');
    }
}
