
@extends('layouts.mobile')

@section('content')
    <article class="weui_article">
        {!! Form::open(array('url' => 'home/finished','id'=>'exam-form','data-ajax'=>"false")) !!}
    <div data-role="page" id="page0">
        <article class="weui_article">

            <div class="page_title">
                <img src="{{ URL::asset('images/jd_logo_s.png') }}" alt="" height="120px" width="120px">

                <h1><span class="small">青春无毒·阳光生活</span><br />2016年亭湖区青少年网上禁毒知识竞赛 </h1>
            </div>
            <section>
                <section>
                    <div><span class="inline_title">活动主办:</span>
                        <p>盐城市亭湖区禁毒办 | 盐城市公安局亭湖分局 | 共青团盐城市亭湖区委员会</p>
                    </div>
                    <div><span class="inline_title">活动时间:</span>2016年6月16日-2016年6月25日(共10天)</div>
                    <div><span class="inline_title">官方平台:</span>青春亭湖微信公众号(tinghugqt)</div>
                </section>
                <section>
                    <div class="inline_title">奖项设置:</div>
                    <ul>
                        <li>一等奖1名,奖品为iPad Air平板电脑一台</li>
                        <li>二等奖2名,奖品为KINDLE电子书1台</li>
                        <li>三等奖7名,奖品为小米手环1个</li>
                        <li>参与奖30名,奖品为定制U盘</li>
                    </ul>
                </section>
                <section>
                    <div class="small">

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
                    @if($status == "noexam")
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
        <div data-role="page" id="page{{ $key+1 }}" class="exam-page">
            <div data-role="content">
                <div class="center clock"><i class="weui_icon_waiting_circle"></i><span class="time-counter">0</span>秒</div>
                <div class="center exam-info">第{{ $key+1 }}题/共{{ $questions->count() }}题 | 此题{{ $question->score }}分</div>
                <fieldset data-role="controlgroup">
                    <legend><span class="question-type">[@if($question->choice==0)单选题@elseif($question->choice==1)多选题@else判断题@endif]</span> {{ $question->title }}?</legend>
                    @if($question->choice==2)
                        <input type="radio" name=answers[{{$question->id}}] value="1" id={{$question->id}}y />
                        <label for={{$question->id}}y>对
                        @if($question->answers[0]->yn)
                                <span class="font-red correct-answer correct-answer{{$question->id}}">√</span>
                        @endif
                        </label>
                        <input type="radio" name=answers[{{$question->id}}] value="0" id={{$question->id}}n />
                        <label for={{$question->id}}n>错
                        @if(!$question->answers[0]->yn)
                            <span class="font-red correct-answer correct-answer{{$question->id}}">√</span>
                        @endif
                        </label>

                    @else
                        @foreach($question->answers as $answer)
                            <label for={{$answer->id}}>{{ $answer->title }}
                                @if($answer->yn)
                                    <span class="font-red correct-answer correct-answer{{$question->id}}">√</span>
                                @endif
                            </label>
                            <input type="checkbox" name=answers[{{$question->id}}][{{$answer->id}}] id={{$answer->id}} value="1">
                        @endforeach
                    @endif
                </fieldset>
                <div class="center small">点击下一题后红色√为正确答案,正确答案持续显示2秒</div>
                <section>
                    @if(($key+1) == $questions->count())
                        <div><p><a href="#" class="weui_btn weui_btn_primary exam_next" id="exam_finished" nik={{$question->id}}>完成考试</a></p></div>
                    @else
                        <div><p><a href="#" class="weui_btn weui_btn_primary main_btn exam_next" nik={{$question->id}} page={{$key+2}}>下一题</a></p></div>
                    @endif
                </section>
            </div>
        </div>
                {!! Form::hidden("question[".$question->id."]",1,array('name'=>"question[".$question->id."]")) !!}
        @endforeach
        {!! Form::hidden('eid',$exam->id,array('name'=>'eid')) !!}
        {!! Form::hidden('second','',array('name'=>'second')) !!}
        {!! Form::close() !!}
    @endif
    </article>
@endsection