@extends('layouts.profile')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'profile')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>profile</h2>
             <form action="{{ action('UserController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">name</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">gender</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="gender" value="{{ old('call') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">hobby</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="hobby" value="{{ old('mailadress') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">introduction</label>
                        <div class="col-md-10">
                          <textarea class="form-control" name="introduction" rows="10">{{ old('memo') }}</textarea>   
                            
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            
            
            </div>
        </div>
    </div>
@endsection