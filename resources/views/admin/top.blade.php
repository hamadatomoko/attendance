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
      <td>未承認シフト</td>
      <td>承認済みシフト</td>
      <td>却下</td>
      <td>イベント</td>
      <td>お知らせ</td>
    </tr>
    <tr>
      <th>色</th>
      <td ><p class="table-cell red">●</p></td></td>
      <td ><p class="table-cell blue">●</p></td></td>
      <td ><p class="table-cell yellow">●</p></td></td>
      <td ><p class="table-cell pink">●</p></td></td>
      <td ><p class="table-cell green">●</p></td></td>
    </tr>
  </table>


<div id='calendar'></div>
@else
	<p>あなたに権限はありません</p>
{{-- @endcan --}}
@endif


@endsection

@section('events')
{!! $events !!}
@endsection