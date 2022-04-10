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
}
