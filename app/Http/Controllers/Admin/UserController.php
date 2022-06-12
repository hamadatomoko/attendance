<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users= User::where('role', 1)->get();
        
        //取得したデータを画面へ渡す
        return view('admin.user.index', ['users' => $users]);
    }
    
    public function add()
    {
        return view('admin.user.create');
    }
    

    public function create(Request $request)
    {
        $this->validate($request, User::$rules);
     
        $user= new User;
        $form = $request->all();
        $form['role']=1;
        $form['password']=Hash::make("1234678");
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        // データベースに保存する
        $user->fill($form);
        $user->save();
      
        return redirect('/admin/user');
    }
    public function edit(Request $request)
    {
        $user= User::find($request->id);
     
      

        if (empty($user)) {
            abort(404);
        }
        return view('admin.user.edit', ['user' => $user]);
    }
      
    
    

    public function update(Request $request)
    {
        $this->validate($request, User::$rules);
     
        $user=  User::find($request->id);
        $form = $request->all();
       
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        // データベースに保存する
        $user->fill($form);
        $user->save();
      
        return redirect('/admin/user');
    }
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $user= User::find($request->id);
        // 削除する
        $user->schedules()->delete();
        $user->delete();
        return redirect('/admin/user');
    }  //
}
