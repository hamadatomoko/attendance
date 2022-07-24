{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.top')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'バイトシフト編集')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
 <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>バイトシフト編集</h2>
    @if( $sform->user_id ==Auth::id())               
                 <h2>名前　{{ Auth::user()->name}}</h2>　
                <form action="{{ action('parttime\ScheduleController@update') }}" method="post" enctype="multipart/form-data">
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
                            <input type="datetime-local" class="form-control" name="start_time" value="{{ $sform->start_time }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="end_time">退勤</label>
                        <div class="col-md-10">
                            <input type="datetime-local" class="form-control" name="end_time" value="{{ $sform->end_time}}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="memo">備考</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="memo" value="{{$sform->memo }}">
                        </div>
                    </div>
        
                   <input type="hidden"  name="id" value="{{ $sform->id }}">
                    {{ csrf_field() }}
                    
                    @if ($sform->status==1)
                        <span>承認済みです</span>
                    @else
                        <input type="submit" class="btn btn-primary" value="更新">
                    @endif
                </form>
                @else
                編集できません
               @endif
            </div>
        </div>
    </div>
   
@endsection
