<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Wage;
use Illuminate\Support\Carbon;

class WageController extends Controller
{
    public function index()
    {
        $wages = Wage::all();
        return view('admin.wage.index', ['posts' => $wages]);
    }
    public function add()
    {
        $users=User::whre("role", 1)->get();
        $user_id_loop=$users::pluck('name', 'id') ;//
        
    

        // key,value ペアに直す

        // ● LaraelのBladeテンプレートにデータを渡す
        return view('admin.wage.add', compact('users_id_loop'));
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
