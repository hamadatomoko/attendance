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
    }//
}
