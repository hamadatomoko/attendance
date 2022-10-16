{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'バイトユーザー時給一覧画面')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content') 
<div class="container">
        <div class="row">
            <h2>バイトユーザー時給一覧画面 </h2><br>
          
        </div>

        <div class="row">
           
            <a href="{{ action('Admin\WageController@add') }}" role="button" class="btn btn-primary">新規登録</a><br>
        </div>       
        <div class="row">
            <div class="list-schedule col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr> 
                               <th width="25%">名前</th>
                                <th width="25%">時給</th>
                                <th width="25%">終了年月</th>
                                <th width="25%">開始年月</th>
                                 
                            
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->user->name}}</td>
                                    <td>{{ $post->wage}}</td>
                                    <td>{{$post->start_day }}</td>
                                    <td>{{ $post->end_day }}</td>
                                    


                                    
                                     <td>
                                        
                                         <div>
                                            <a class="btn btn-primary"  role="button" href="{{ action('Admin\WageController@delete', ['id' => $post->id]) }}">削除</a >
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
