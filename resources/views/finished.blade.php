
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
                        {!! Form::label('mobile', '您的手机') !!}
                        {!! Form::text('mobile','',array('name'=>'mobile')) !!}
                     <div class="form-item-desc">注意:请输入您正在使用的手机号码,这是您获取奖品最重要的凭证,不输入手机号码的用户不参与排名和奖品领取的活动.</div>
                        {!! Form::submit('提交',array("class" => "weui_btn weui_btn_primary addmobile",'rel'=>'external')) !!}
                {!! Form::close() !!}
                @else
                    <div class="center"><h4 class="rank-title">本次考试排行榜</h4></div>
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
                                <td><img src="{{$score->wechatuser->headimgurl}}" height="30px" width="30px"/></td>
                                <td>{{  preg_replace('/(1[358]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$score->wechatuser->mobile) }}</td>
                                <td>{{$score->score}}分</td>
                                <td>{{$score->second}}秒</td>
                            </tr>

                        @endforeach
                    </table>
                    <div class="center finished-btns">

                        <a href="rank" class="weui_btn weui_btn_primary" rel="external">查看总排行榜</a>

                    </div>
                @endif
        </div>

    @if($re_submit || $errors->all() )
                <div class="weui_dialog_alert">
                    <div class="weui_mask"></div>
                    <div class="weui_dialog">
                        <div class="weui_dialog_hd"><strong class="weui_dialog_title">提示</strong></div>
                        <div class="weui_dialog_bd">
                            @if($errors->all())
                                @foreach ($errors->all() as $error)
                                    <p class="error-message bg-danger">{{ $error }}</p>
                                @endforeach
                            @else
                            您已经提交过了成绩,通过返回重新修改的答案不生效,您的成绩将以原始提交数据为准
                            @endif
                        </div>
                        <div class="weui_dialog_ft">
                            <a href="#" class="weui_btn_dialog primary">确定</a>
                        </div>
                    </div>
                </div>
    @endif
@endsection