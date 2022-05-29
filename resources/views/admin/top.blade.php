{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'バイトユーザー管理')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
{{--  @can('admin') --}}
@if(Auth::user()->role==0)
	<p>あなたは管理者です</p>
<a class="btn btn-primary"  role="button" href="{{ action('parttime\AttendanceController@index') }}">バイトユーザー勤怠一覧</a>
<div id='calendar'></div>
@else
	<p>あなたに権限はありません</p>
{{-- @endcan --}}
@endif


@endsection

@section('events')
{!! $events !!}
@endsection