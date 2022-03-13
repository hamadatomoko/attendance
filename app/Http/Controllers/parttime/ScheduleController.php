<?php

namespace App\Http\Controllers\parttime;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Schedule;
class ScheduleController extends Controller
{
    public function add()
    {
        return view('parttime.schedule.create');
        
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
      
      return redirect('/');
  }//
   public function edit(Request $request)
  {
      
      $schedule= Schedule::find($request->id);
      if (empty($schedule)) {
        abort(404);    
      }
      return view('parttime.schedule.edit', ['sform' => $schedule,'memo_form'=>$schedule->memo]);
  }
   public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request,Schedule ::$rules);
      
      $schedule= Schedule::find($request->id); 
      // 送信されてきたフォームデータを格納する
      $form = $request->all();
      unset($form['_token']);

      // 該当するデータを上書きして保存する
      $schedule->fill($form)->save();

      return redirect('/');
  }
}
