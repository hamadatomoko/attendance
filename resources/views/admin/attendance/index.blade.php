{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'バイトユーザー勤怠一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content') 
<div class="container">
        <div class="row">
            <h2> バイトユーザー勤怠一覧</h2><br>
          
        </div>

        <div class="row">
           
            <a href="{{ action('Admin\AttendanceController@add') }}" role="button" class="btn btn-primary">新規登録</a><br>
        </div>       
        <div class="row">
            <div class="list-schedule col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr> 
                               <th width="25%">名前</th>
                                <th width="25%">日付</th>
                                <th width="25%">出勤</th>
                                <th width="25%">退勤</th>
                                 <th width="25%">備考</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->user->name}}</td>
                                    <td>{{ $post->start_time->format('Y/m/d') }}</td>
                                    
                                    <td>{{ $post->start_time->format('H:i:s') }}</td>
                                    <td>{{ $post->end_time->format('H:i:s') }}</td>
                                    <td>{{ \Str::limit($post->memo, 250) }}</td>
                                    
                                    
                                     <td>
                                        <div>
                                            <a class="btn btn-primary"  role="button" href="{{ action('Admin\AttendanceController@edit', ['id' => $post->id]) }}">編集</a >
                                        </div>
                                         <div>
                                            <a class="btn btn-primary"  role="button" href="{{ action('Admin\AttendanceController@delete', ['id' => $post->id]) }}">削除</a >
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
