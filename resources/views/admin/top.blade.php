{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'バイトユーザー管理')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<a class="btn btn-primary"  role="button" href="{{ action('parttime\AttendanceController@index') }}">バイトユーザー勤怠一覧</a>
<div id='calendar'></div>
   
@endsection

@section('events')
{!! $events !!}
@endsection