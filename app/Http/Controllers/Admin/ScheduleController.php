<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Schedule;
use App\cevent;
use Illuminate\Support\Carbon;

class ScheduleController extends Controller
{
    public function add()
    {
        return view('admin.schedule.create');
    }
    
    public function index()
    {
        // DBからデータを取ってきて$eventsに代入
        $events = Schedule::whereIn('schedule_type', [1,2])->get();
       
        
        // 表示するviewを指定し、上記で取ってきた、予定データを渡す
        return view('admin.schedule.index', ['events'=>$events]);
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Schedule::$rules);
     
        $schedule= new Schedule;
        $form = $request->all();
      
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        // データベースに保存する
        $schedule->fill($form);
        $schedule->save();
      
        return redirect('/admin/schedule');
    }//
    public function edit(Request $request)
    {
        $schedule= Schedule::find($request->id);
        $schedule->start_time= Carbon::parse($schedule->start_time)->format('Y-m-d\TH:i');
        $schedule->end_time= Carbon::parse($schedule->end_time)->format('Y-m-d\TH:i');
      

        if (empty($schedule)) {
            abort(404);
        }
        return view('admin.schedule.edit', ['sform' => $schedule,'memo_form'=>$schedule->memo]);
    }
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Schedule ::$rules);
      
        $schedule= Schedule::find($request->id);
      
        // 送信されてきたフォームデータを格納する
        $form = $request->all();
        unset($form['_token']);

        // 該当するデータを上書きして保存する
        $schedule->fill($form)->save();

        return redirect('admin/schedule');
    }
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $schedule= Schedule::find($request->id);
        // 削除する
        $schedule->delete();
        return redirect('/admin/schedule');
    }
    public function delete_parttime(Request $request)
    {
        // 該当するNews Modelを取得
        $schedule= Schedule::find($request->id);
        // 削除する
        $schedule->delete();
        return redirect('/admin');
    }
    public function edit_parttime(Request $request)
    {
        $schedule= Schedule::find($request->id);
        $schedule->start_time= Carbon::parse($schedule->start_time)->format('Y-m-d\TH:i');
        $schedule->end_time= Carbon::parse($schedule->end_time)->format('Y-m-d\TH:i');
      

        if (empty($schedule)) {
            abort(404);
        }
        return view('admin.schedule.edit_parttime', ['sform' => $schedule,'memo_form'=>$schedule->memo]);
    }
    public function update_parttime(Request $request)
    {
        // Validationをかける
        $this->validate($request, Schedule ::$rules);
      
        $schedule= Schedule::find($request->id);
      
        // 送信されてきたフォームデータを格納する
        $form = $request->all();
        unset($form['_token']);

        // 該当するデータを上書きして保存する
        $schedule->fill($form)->save();
        
        return redirect('/admin?date='.$schedule->start_time);
    }
}
