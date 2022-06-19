{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')



{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'バイトユーザ勤怠編集')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
 <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>バイトユーザ勤怠編集</h2>
                　
                <form action="{{ action('Admin\AttendanceController@update') }}" method="post" enctype="multipart/form-data">

 

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="name">名前</label>
                        <div class="col-md-10">
                       {{Form::select('user_id',$users)}}     
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="start_time">出勤</label>
                        <div class="col-md-10">
                            <input type="datetime-local" class="form-control" name="start_time" value="{{$attendance->start_time}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="end_time">退勤</label>
                        <div class="col-md-10">
                            <input type="datetime-local" class="form-control" name="end_time" value="{{$attendance->end_time}}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="memo">備考</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="memo" value="{{$attendance->memo }}">
                        </div>
                    </div>
            <input type="hidden"  name="status" value="0">
             <input type="hidden"  name="id" value="{{$attendance->id}}"> 
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
   
@endsection
