{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.top')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'バイトユーザー勤怠一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content') 
<div class="container">
        <div class="row">
            <h2> バイトユーザー勤怠一覧</h2><br>
          
        </div>

        <div class="row">
           
            <a href="{{ action('parttime\AttendanceController@add') }}" role="button" class="btn btn-primary">新規登録</a><br>
        </div>       
        <div class="row">
            <div class="list-schedule col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>日付</th>
                                <th >出勤</th>
                                <th >退勤</th>
                                 <th >承認状態</th>
                                 <th>備考</th>
                                 <th>最終更新日時</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ \Carbon\Carbon::createFromTimeString($post->start_time)->format('Y/m/d') }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimeString($post->start_time)->format('H:i:s') }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimeString($post->end_time)->format('H:i:s') }}</td>
                                    @if ($post->status === 1)
   　　　　　　                      　　　　　　　 <td>承認</td>
                                    @else
                                     <td>未承認</td>　　　　　　 
　　　                             @endif
    
                                    <td>{{ \Str::limit($post->memo, 25) }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimeString($post->updated_at) }}</td>
                                    
                                     <td>
                                        <div>
                                            @if ($post->status== 1)
                                             @else  
                                            <a class="btn btn-primary"  role="button" href="{{ action('parttime\AttendanceController@edit', ['id' => $post->id]) }}">編集</a >
                                         @endif   
                                        </div>
                                         <div>

                                             @if ($post->status== 1)
                                             @else  
                                              <a class="btn btn-primary"  role="button" href="{{ action('parttime\AttendanceController@delete', ['id' => $post->id]) }}">削除</a >
                                             @endif 
                                            
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
