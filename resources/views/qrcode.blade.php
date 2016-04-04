@extends('layouts.mobile')

@section('content')
    <article class="weui_article">
        <div class="page_title">
            <img src="{{ URL::asset('images/gqt_logo_s.png') }}" alt="">
            <h1>关注我们参加考试赢大礼 </h1>
        </div>
        <div class="center">

        <img src="{{$url}}" alt="" width="250px" height="250px">
        </div>
        <div>参加考试必须关注本微信号,请长按上面二维码点击识别图中二维码关注微信号,然后进入微信号通过菜单进入考试.</div>
    </article>

@endsection