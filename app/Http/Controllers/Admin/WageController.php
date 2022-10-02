<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Wage;
use Illuminate\Support\Carbon;

class WageController extends Controller
{
    public function index(Request$request)
    {
        $users=User::pluck('name', 'id');
        if ($request->user_id==null) {
            $user=$User::first();
            $id=$user->id;
        } else {
            $id=$request->user_id;
        }
        $wages=Wage::where('user_id', $id)->get();
 

        //dd($posts);
        return view('admin.wage.index', ['user' => $users,'wages'=>$wages]);
    }
    public function add()
    {
        $users=User::pluck('name', 'id') ;//
      
      
      
        return view('admin.attendance.create', ['users'=>$users]);
    }
    
    public function create(AttendanceCreateRequest $request)
    {
        $attendance= new Attendance;
        $form = $request->all();
    
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        $form['start_time']= Carbon::parse($form['start_time'])->format('Y-m-d H:i:s');
        $form['end_time']= Carbon::parse($form['end_time'])->format('Y-m-d H:i:s');
  

        // フォームから送信されてきたimageを削除する
        // データベースに保存する
        $attendance->fill($form);
        $attendance->save();
      
        return redirect('admin/attendance');
    } //
    //
}
