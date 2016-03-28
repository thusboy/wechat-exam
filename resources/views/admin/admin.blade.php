@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-2">
        <ul class="list-group">
            <li class="list-group-item active">系统概况</li>
            <li class="list-group-item"><a href='{{ action('AdminController@exam') }}'>考试管理</a></li>
            <li class="list-group-item">成绩报表</li>
        </ul>
    </div>
    <div class="col-md-10 content-main">
        @yield('content-main')
    </div>
</div>
@endsection