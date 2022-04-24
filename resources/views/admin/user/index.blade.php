{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.top')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'バイトユーザー管理')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content') 
<div class="container">
        <div class="row">
            <h2> バイトユーザー管理</h2><br>
          
        </div>

        <div class="row">
           
            <!--<a href="{{ action('Admin\UserController@add') }}" role="button" class="btn btn-primary">新規登録</a><br>-->
        </div>       
        <div class="row">
            <div class="list-schedule col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="25%">名前</th>
                                <th width="25%">メールアドレス</th>
                                <th width="25%">電話番号</th>
                                 <th width="25%">備考</th>
                                 <th width="25%"></th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name}}</td>
                                    
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->call }}</td>
                                    <td>{{ \Str::limit($user->memo, 250) }}</td>
                                    
                                    
                                     <td>
                                        <div>
                                            <a class="btn btn-primary"  role="button" href="{{ action('Admin\UserController@edit', ['id' => $user->id]) }}">編集</a >
                                        </div>
                                         <div>
                                            <a class="btn btn-primary"  role="button" href="{{ action('Admin\UserController@delete', ['id' => $user->id]) }}">削除</a >
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
                             
   
@endsection
