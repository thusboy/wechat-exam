@extends('admin.admin')

@section('content-main')
    <ul class="nav nav-pills nav-justified">
        <li class="{{ isset($rank_active[0])?$rank_active[0]:Null }}"><a href="{{action('AdminController@rank')}}">总排行</a></li>
        @foreach($exams as $exam)
            <li class="{{ isset($rank_active[$exam->id])?$rank_active[$exam->id]:Null }}"><a href="{{action('AdminController@rank',array('eid' => $exam->id))}}">{{$exam->title}}</a></li>
        @endforeach
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">成绩列表</div>
        <div class="panel-body">
            <table class="table">
                @if(isset($wechatusers))
                <tr>
                    <th>名词</th>
                    <th>头像</th>
                    <th>名称</th>
                    <th>电话号码</th>
                    <th>地区</th>
                    <th>总积分</th>
                    <th>总用时</th>
                </tr>
                @foreach( $wechatusers as $key => $wechatuser)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td><img src="{{$wechatuser->headimgurl}}" alt="" width="30px" height="30px"></td>
                        <td>{{$wechatuser->nickname}}</td>
                        <td>{{ $wechatuser->mobile }}</td>
                        <td>{{ $wechatuser->province }} {{$wechatuser->city}}</td>
                        <td>{{ $wechatuser->score}}分</td>
                        <td>{{ $wechatuser->second}}秒</td>
                    </tr>
                @endforeach
                @elseif(isset($ranks))
                    <tr>
                        <th>名词</th>
                        <th>头像</th>
                        <th>名称</th>
                        <th>电话号码</th>
                        <th>地区</th>
                        <th>分数</th>
                        <th>用时</th>
                    </tr>
                    @foreach( $ranks as $key => $rank)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><img src="{{$rank->wechatuser->headimgurl}}" alt="" width="30px" height="30px"></td>
                            <td>{{$rank->wechatuser->nickname}}</td>
                            <td>{{ $rank->wechatuser->mobile }}</td>
                            <td>{{ $rank->wechatuser->province }} {{$rank->wechatuser->city}}</td>
                            <td>{{$rank->score}}分</td>
                            <td>{{$rank->second}}秒</td>
                        </tr>
                    @endforeach
                 @endif
            </table>
        </div>
    </div>
@endsection