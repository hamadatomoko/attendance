{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'バイトユーザ時給登録画面')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
 <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>バイトユーザ時給登録</h2>
                　
                <form action="{{ action('Admin\WageController@create') }}" method="post" enctype="multipart/form-data">

 

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
                       {{Form::select('user_id',$user_id_loop)}}     
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="start_day">開始年月</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="start_day" value="{{ old('start_day')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="end_day">終了年月</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="end_day" value="{{ old('$end_day') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="memo">時給</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="wage" value="{{ old('memo') }}">
                        </div>
                    </div>
        
               
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
   
@endsection
