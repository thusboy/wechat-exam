
@extends('layouts.mobile')

@section('content')

        <div data-role="page">
            <div data-role="content">
                <div class="ui-grid-a final-score">
                    <div class="ui-block-a">
                        <div class="center">
                            <p><img src="{{ $wechatuser->headimgurl }}" alt=""  width="90px" height="90px"/></p>
                        </div>
                    </div>
                    <div class="ui-block-b">
                        <div class="center">
                            <p>您本次考试的成绩是:</p>
                            <p class="score {{$score_class}}">{{ $score->score }}</p>
                            <p class="using_time clock"><i class="weui_icon_waiting_circle"></i>用时:{{ $score->second }}秒</p>
                        </div>
                    </div>
                </div>
                @if(!$wechatuser->mobile)
                {!! Form::open(array('url' => 'home/addmobile','data-ajax'=>"false")) !!}
                        {!! Form::label('name', '您的姓名') !!}
                         {!! Form::text('name','',array('name'=>'name')) !!}
                        {!! Form::label('mobile', '您的手机') !!}
                        {!! Form::text('mobile','',array('name'=>'mobile')) !!}
                        {!! Form::label('deparment', '您的单位') !!}
                        {!! Form::text('department','',array('name'=>'department')) !!}
                     <div class="form-item-desc">注意:请输入真实完整的信息,这是您获取奖品最重要的凭证,信息输入不完整或者不真实的用户不参与奖品的领取活动.</div>

                    <div class="ui-grid-a">
                        {!! Form::submit('提交领奖信息',array("class" => "weui_btn weui_btn_primary addmobile",'rel'=>'external')) !!}
                        <a href="../" class = "weui_btn weui_btn_warn again" rel='external'>再考一次</a>
                        <a href="#" class =  "weui_btn weui_btn_primary sharespace">分享成绩到朋友圈</a>

                    </div>
                {!! Form::close() !!}
                @else
                    <div class="center"><h4 class="rank-title">考试排行榜</h4></div>
                    <table class="rank-table">
                        <tr>
                            <th>名次</th>
                            <th>头像</th>
                            <th>电话号码</th>
                            <th>成绩</th>
                            <th>用时</th>
                        </tr>
                        @foreach($scores as $key => $score)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><img src="{{$score->headimgurl}}" height="30px" width="30px"/></td>
                                <td>{{  preg_replace('/(1[358]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$score->mobile) }}</td>
                                <td>{{$score->score}}分</td>
                                <td>{{$score->second}}秒</td>
                            </tr>

                        @endforeach
                    </table>
                    <div class="center small">排行成绩以用户历史最高分计算</div>
                    <div class="center finished-btns">

                        <a href="../" class = "weui_btn weui_btn_warn again" rel='external'>再考一次</a>
                        <a href="#" class =  "weui_btn weui_btn_primary sharespace">分享成绩到朋友圈</a>

                    </div>
                @endif
        </div>

    @if($errors->all() )
                <div class="weui_dialog_alert">
                    <div class="weui_mask"></div>
                    <div class="weui_dialog">
                        <div class="weui_dialog_hd"><strong class="weui_dialog_title">提示</strong></div>
                        <div class="weui_dialog_bd">
                            @if($errors->all())
                                @foreach ($errors->all() as $error)
                                    <p class="error-message bg-danger">{{ $error }}</p>
                                @endforeach

                            @endif
                        </div>
                        <div class="weui_dialog_ft">
                            <a href="#" class="weui_btn_dialog primary">确定</a>
                        </div>
                    </div>
                </div>
    @endif
            <div class="weui_dialog_alert sharetips">
                <div class="weui_mask"></div>
                <div class="weui_dialog">
                    <div class="weui_dialog_hd"><strong class="weui_dialog_title">提示</strong></div>
                    <div class="weui_dialog_bd">
                        点击右上角菜单开关打开下方菜单栏使用分享到朋友圈按钮和发送给好友进行分享.
                    </div>
                    <div class="weui_dialog_ft">
                        <a href="#" class="weui_btn_dialog primary">确定</a>
                    </div>
                </div>
            </div>
@endsection