<?php

namespace App\Http\Controllers\parttime;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Attendance;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        // ログイン情報を取得
        $id = Auth::id();
        
        // 勤怠データを取得する
        $posts = Attendance::where('user_id', $id)->get();
        
        
        //取得したデータを画面へ渡す
        return view('parttime.attendance.index', ['posts' => $posts]);
    }
    public function add()
    {
        return view('parttime.attendance.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Attendance::$rules);
     
        $attendance= new Attendance;
        $form = $request->all();
      
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        // データベースに保存する
        $attendance->fill($form);
        $attendance->save();
      
        return redirect('/');
    }
    public function edit(Request $request)
    {
        $attendance= Attendance::find($request->id);
  
        $attendance->start_time= Carbon::parse($attendance->start_time)->format('Y-m-d\TH:i');
        $attendance->end_time= Carbon::parse($attendance->end_time)->format('Y-m-d\TH:i');
       
        if (empty($attendance)) {
            abort(404);
        }
        return view('parttime.attendance.edit', ['attendance'=>$attendance]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request, Attendance::$rules);
     
        $attendance= Attendance::find($request->id);
        $form = $request->all();
    
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        $form['start_time']= Carbon::parse($form['start_time'])->format('Y-m-d H:i:s');
        $form['end_time']= Carbon::parse($form['end_time'])->format('Y-m-d H:i:s');
   
        //dd($form);

        // フォームから送信されてきたimageを削除する
        // データベースに保存する
        $attendance->fill($form);
        $attendance->save();
      
        return redirect('parttime/attendance');
    }
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $attendance= Attendance::find($request->id);
        // 削除する
        $attendance->delete();
        return redirect('/parttime/attendance');
    }
}
