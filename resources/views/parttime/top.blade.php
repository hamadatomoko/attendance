{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.top')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'トップ画面')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<a class="btn btn-primary"  role="button" href="{{ action('parttime\AttendanceController@index') }}">バイト勤怠一覧</a>
<div id='calendar'></div>
   
@endsection

@section('events')
{!! $events !!}
@endsection