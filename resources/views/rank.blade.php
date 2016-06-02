@extends('layouts.mobile')

@section('content')
    <article class="weui_article">
        <div class="center"><h4 class="rank-title">考试成绩总排行榜</h4></div>
        <table class="rank-table">
            <tr>
                <th>名次</th>
                <th>头像</th>
                <th>电话号码</th>
                <th>总积分</th>
                <th>总用时</th>
            </tr>
            @foreach($wechatusers as $key => $wechatuser)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><img src="{{$wechatuser->headimgurl}}" height="30px" width="30px"/></td>
                    <td>{{  preg_replace('/(1[34578]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$wechatuser->mobile) }}</td>
                    <td>{{$wechatuser->score}}分</td>
                    <td>{{$wechatuser->second}}秒</td>
                </tr>

            @endforeach
        </table>
    </article>
@endsection