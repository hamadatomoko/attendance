@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'イベント告知編集')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
 <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>イベント告知編集</h2>
                 
                <form action="{{ action('Admin\ScheduleController@update') }}" method="post" enctype="multipart/form-data">

 

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                     {{Form::select('schedule_type', [1 => 'イベント', 2 => 'お知らせ' ])}}
                    </div> 
                    <div class="form-group row">
                        <label class="col-md-2" for="title">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $sform->title}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="start_time">開始日時</label>
                        <div class="col-md-10">
                            <input type="datetime-local" class="form-control" name="start_time" value="{{$sform->start_time}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="end_time">終了日時</label>
                        <div class="col-md-10">
                            <input type="datetime-local" class="form-control" name="end_time" value="{{$sform->end_time }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="memo">内容</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="memo" value="{{$sform->memo}}">
                        </div>
                    </div>
                    <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="allday_flag" value="1">終日
                                </label>
                            </div>
            <input type="hidden"  name="status" value="0">
            <input type="hidden"  name="id" value="{{$sform->id}}">
                 <input type="hidden"  name="user_id" value="{{ Auth::user()->id }}">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
   
@endsection
