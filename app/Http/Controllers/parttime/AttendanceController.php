<?php

namespace App\Http\Controllers\parttime;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        // ログイン情報を取得
        $id = Auth::id();
        
        // 勤怠データを取得する
        $posts = Attendance::where('user_id',$id )->get();
        
        
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
}
