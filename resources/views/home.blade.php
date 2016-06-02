
@extends('layouts.mobile')

@section('content')
    <article class="weui_article">
        {!! Form::open(array('url' => 'home/finished','data-ajax'=>"false")) !!}
    <div data-role="page" id="page0">
        <article class="weui_article">

            <div class="page_title">
                <img src="{{ URL::asset('images/jd_logo_s.png') }}" alt="" height="120px" width="120px">

                <h1><span class="small">云浮市团委</span><br />2016云浮市禁毒知识竞赛 </h1>
            </div>
            <section>
                <section>
                    <div><span class="inline_title">活动主办:</span><p>云浮市团委</p></div>
                    <div><span class="inline_title">支持单位:</span><p>汉中易格科技有限公司</p></div>
                    <div><span class="inline_title">活动时间:</span>2016年6月1日-2016年6月10日(共10天)</div>
                    <div><span class="inline_title">官方平台:</span>云浮市共青团市委官方公众号</div>
                </section>
                <section>
                    <div class="inline_title">奖项设置:</div>
                    <ul>
                        <li>一等奖1名,奖品为Iphone6S 16G手机1部</li>
                        <li>二等奖2名,奖品为价值2000元的平衡车1俩</li>
                        <li>三等奖3名,奖品为价值500元的智能手环1个</li>
                        <li>参与奖100名,提供500M手机流量</li>
                    </ul>
                </section>
                <section>
                    <div class="small">
                        注:本次普法大赛奖品仅对云浮市参赛者有效,其它地区参赛者成绩只做参考
                    </div>

                    <div class="center">
                        <a href="http://mp.weixin.qq.com/s?__biz=MzA5NzYzNjcyOA==&mid=405430137&idx=1&sn=5dd49ba0a6347542e7011cd1ada3d12a&scene=1&srcid=0414IRHzWhPddXfP95YBpH3W&from=singlemessage&isappinstalled=0#wechat_redirect" class="blue" rel="external">活动详细规则及常见问题</a>
                    </div>
                </section>
                <section>
                    @if($status=="ok")
                        <a href="#page1" class="weui_btn weui_btn_primary" id="exam_start">开始答题</a>
                    @else
                        <div class="weui_btn weui_btn_default weui_btn_disabled">开始答题</div>
                    @endif
                </section>
            </section>
        </article>
        @if($status!="ok")
        <div class="weui_dialog_alert">
            <div class="weui_mask"></div>
            <div class="weui_dialog">
                <div class="weui_dialog_hd"><strong class="weui_dialog_title">提示</strong></div>
                <div class="weui_dialog_bd">
                    @if($status == "finished")
                        您已经完成了本次考试,不能再重复参与,请保持持续关注,参加下一次考试赢大奖.
                    @elseif($status == "noexam")
                        当前没有开放的考试,请保持对本微信号的持续关注,参加考试赢大奖.
                    @endif
                </div>
                <div class="weui_dialog_ft">
                    <a href="#" class="weui_btn_dialog primary">确定</a>
                </div>
            </div>
        </div>
        @endif
    </div>
    @if($status=="ok")

        @foreach($questions as $key => $question)
        <div data-role="page" id="page{{ $key+1 }}">
            <div data-role="content">
                <div class="center clock"><i class="weui_icon_waiting_circle"></i><span class="time-counter">0</span>秒</div>
                <div class="center exam-info">第{{ $key+1 }}题/共{{ $exam->number_q_s+$exam->number_q_m }}题 | 此题{{ $question->score }}分</div>
                <fieldset data-role="controlgroup">
                    <legend><span class="question-type">[@if($question->choice)多选题@else单选题@endif]</span> {{ $question->title }}?</legend>
                    @foreach($question->answers as $answer)
                        <label for={{$answer->id}}>{{ $answer->title }}</label>
                        <input type="checkbox" name=answers[{{$question->id}}][{{$answer->id}}] id={{$answer->id}} value="1">
                    @endforeach
                </fieldset>
                <section>
                    @if(($key+1) == $exam->number_q_s+$exam->number_q_m)
                        {!! Form::submit('完成考试',array("class" => "weui_btn weui_btn_primary exam_next","id"=>"exam_finished")) !!}
                    @else
                        <div><p><a href="#page{{$key+2}}" class="weui_btn weui_btn_primary main_btn exam_next">下一题</a></p></div>
                    @endif
                </section>
            </div>
        </div>
        @endforeach
        {!! Form::hidden('eid',$exam->id,array('name'=>'eid')) !!}
        {!! Form::hidden('second','',array('name'=>'second')) !!}
        {!! Form::close() !!}
    @endif
    </article>
@endsection