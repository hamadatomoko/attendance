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
        $users=User::where("role", 1)->get();
        $user_id_loop=$users->pluck('name', 'id') ;//
        
    

        // key,value ペアに直す

        // ● LaraelのBladeテンプレートにデータを渡す
        return view('admin.wage.create', compact('user_id_loop'));
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Wage::$rules);
        $wage= new Wage;
        $form = $request->all();
    
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
       

        // フォームから送信されてきたimageを削除する
        // データベースに保存する
        $wage->fill($form);
        $wage->save();
      
        return redirect('admin/wage');
    } //
    //
}
