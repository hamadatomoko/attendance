{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '管理者専用イベント・/告知登録一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content') 
<div class="container">
        <div class="row">
            <h2> 管理者専用イベント/告知登録一覧</h2><br>
          
        </div>

        <div class="row">
           
            <a href="{{ action('Admin\ScheduleController@add') }}" role="button" class="btn btn-primary">新規登録</a><br>
        </div>       
        <div class="row">
            <div class="list-schedule col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="25%">タイトル</th>
                                <th width="25%">予定タイプ</th>
                                <th width="25%">開始日時</th>
                                <th width="25%">終了日時</th>
                                <th width="25%">備考</th>
                                <th width="25%"></th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $schedule)
                                <tr>
                                    <td>{{ $schedule->title}}</td>
                                    @if ($schedule->schedule_type==1)
                                        <td>イベント</td>
                                    @elseif ($schedule->schedule_type==2)
                                        <td>お知らせ</td>
                                    @endif
                                    <td>{{ $schedule->start_time}}</td>
                                    <td>{{ $schedule->end_time }}</td>
                                    <td>{{ \Str::limit($schedule->memo, 50) }}</td>
                                    
                                    
                                     <td>
                                        <div>
                                            <a class="btn btn-primary"  role="button" href="{{ action('Admin\ScheduleController@edit', ['id' => $schedule ->id]) }}">編集</a >
                                        </div>
                                         <div>
                                            <a class="btn btn-primary"  role="button" href="{{ action('Admin\ScheduleController@delete', ['id' => $schedule ->id]) }}">削除</a >
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
