{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.top')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'バイトユーザー勤怠一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content') 
<div class="container">
        <div class="row">
            <h2> バイトユーザー勤怠一覧</h2>
        </div>
       
        <div class="row">
            <div class="list-schedule col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="25%">日付</th>
                                <th width="25%">出勤</th>
                                <th width="25%">退勤</th>
                                 <th width="25%">備考</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->start_time }}</td>
                                    <td>{{ $post->start_time }}</td>
                                    <td>{{ $post->end_time}}</td>
                                    <td>{{ \Str::limit($post->memo, 250) }}</td>
                                    
                                    
                                     <td>
                                        <div>
                                            <!--a class="btn btn-primary"  role="button" href="{{ action('Admin\DedicationMoneyController@edit', ['id' => $dedication_money->id]) }}">編集</a -->
                                        </div>
                                         <div>
                                            <!--a class="btn btn-primary"  role="button" href="{{ action('Admin\DedicationMoneyController@delete', ['id' => $dedication_money->id]) }}">削除</a -->
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
