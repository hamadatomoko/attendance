{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'バイトユーザー管理')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
{{--  @can('admin') --}}
@if(Auth::user()->role==0)
	<p>あなたは管理者です</p>
	 <table border="1">
    <tr>
      <th>承認状態</th>
      <th>色</th>
    </tr>
    <tr>
      <td>未承認シフト</td>
      <td bgcolor="red">赤色</td>
    </tr>
    <tr>
      <td>承認済みシフト</td>
      <td bgcolor="blue">青色</td>
    </tr>
 <tr>
      <td>却下</td>
      <td bgcolor="yellow">黄色</td>
    </tr>
     <tr>
      <td>イベント</td>
      <td bgcolor="pink">ピンク</td>
    </tr>
     <tr>
      <td>お知らせ</td>
      <td bgcolor="green">緑</td>
    </tr>
  </table>


<a class="btn btn-primary"  role="button" href="{{ action('Admin\AttendanceController@index') }}">バイトユーザー勤怠一覧</a>
<div id='calendar'></div>
@else
	<p>あなたに権限はありません</p>
{{-- @endcan --}}
@endif


@endsection

@section('events')
{!! $events !!}
@endsection