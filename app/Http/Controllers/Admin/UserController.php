<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;

class UserController extends Controller
{
 public function index()
    {
      $users= User::all();
        
      //取得したデータを画面へ渡す
        return view('admin.user.index', ['users' => $users]);
    }
     public function add()
     {$users= User::all();
        
      //取得したデータを画面へ渡す
        return view('admin.user.index', ['users' => $users]);
         
     }
}
