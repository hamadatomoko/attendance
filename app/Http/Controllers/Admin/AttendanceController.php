<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Attendance;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $posts = Attendance::all();
        //dd($posts);
        
        //取得したデータを画面へ渡す
        return view('admin.attendance.index', ['posts' => $posts]);
    }
    public function add()
    {
        $users=User::pluck('name', 'id') ;//
      
      
      
        return view('admin.attendance.create', ['users'=>$users]);
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Attendance::$rules);
     
        $attendance= new Attendance;
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
      
        return redirect('admin/attendance');
    } //
    public function edit(Request $request)
    {
        $users=User::pluck('name', 'id') ;//
      
        $attendance= Attendance::find($request->id);
  
        $attendance->start_time= Carbon::parse($attendance->start_time)->format('Y-m-d\TH:i');
        $attendance->end_time= Carbon::parse($attendance->end_time)->format('Y-m-d\TH:i');
       
        if (empty($attendance)) {
            abort(404);
        }
        return view('admin.attendance.edit', ['users'=>$users,'attendance'=>$attendance]);
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
   
        // dd($form);

        // フォームから送信されてきたimageを削除する
        // データベースに保存する
        $attendance->fill($form);
        $attendance->save();
      
        return redirect('admin/attendance');
    }
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $attendance= Attendance::find($request->id);
        // 削除する
        $attendance->delete();
        return redirect('/admin/attendance');
    }  //
}
