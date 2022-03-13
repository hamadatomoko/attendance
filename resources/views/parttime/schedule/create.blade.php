{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.top')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'バイトシフト新規申請')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
 <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>バイトシフト申請新規作成</h2>
                 <h2>名前　{{ Auth::user()->name}}</h2>　
                <form action="{{ action('parttime\ScheduleController@create') }}" method="post" enctype="multipart/form-data">

 

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="start_time">出勤</label>
                        <div class="col-md-10">
                            <input type="datetime-local" class="form-control" name="start_time" value="{{ old('start_time') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="end_time">退勤</label>
                        <div class="col-md-10">
                            <input type="datetime-local" class="form-control" name="end_time" value="{{ old('end_time') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="memo">備考</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="memo" value="{{ old('memo') }}">
                        </div>
                    </div>
            <input type="hidden"  name="status" value="0">
                 <input type="hidden"  name="allday_flag" value="0">  
                  <input type="hidden"  name="schedule_type" value="0"> 
                   <input type="hidden"  name="user_id" value="{{ Auth::user()->id }}">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
   
@endsection
