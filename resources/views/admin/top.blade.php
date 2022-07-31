{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'バイトユーザー管理')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
{{--  @can('admin') --}}
@if(Auth::user()->role==0)
	<p>あなたは管理者です</p>
	
  
<div class="table">
    <div class="table-row">
      <p class="table-cell">承認状態</p>
      <p class="table-cell">未承認シフト</p>
      <p class="table-cell">承認済みシフト</p>
       <p class="table-cell">却下</p>
        <p class="table-cell">イベント</p>
         <p class="table-cell">お知らせ</p>
    </div>
    <div class="table-row">
      <p class="table-cell">色</p>
      <p class="table-cell red">●</p>
       <p class="table-cell blue">●</p>
      <p class="table-cell yellow">●</p>
      <p class="table-cell pink">●</p>
      <p class="table-cell green ">●</p>
      
    </div>
  </div>


<div id='calendar'></div>
@else
	<p>あなたに権限はありません</p>
{{-- @endcan --}}
@endif


@endsection

@section('events')
{!! $events !!}
@endsection