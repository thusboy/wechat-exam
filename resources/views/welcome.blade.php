@extends('layouts.mobile')

@section('content')
    <article class="weui_article">

        <div class="page_title">
            <img src="{{ URL::asset('images/gqt_logo_s.png') }}" alt="">

            <h1>共青团略阳县委2016青少年网上普法知识大赛 </h1>
        </div>
        <section>
            <section>
                <div><span class="inline_title">活动主办:</span><p>略阳县司法局 共青团略阳县委 略阳县普法办</p></div>
                <div><span class="inline_title">活动时间:</span>2016年4月10日-2016年5月4日</div>
                <div><span class="inline_title">赞助单位:</span>略阳县xxx公司</div>
                <div><span class="inline_title">官方平台:</span>共青团略阳县委官方公众号</div>
                <div><span class="inline_title">技术支持:</span>汉中易格科技有限公司</div>
            </section>
            <section>
                <div class="inline_title">奖项设置:</div>
                <ul>
                    <li>一等奖1名:xxx</li>
                    <li>二等奖2名:xxx</li>
                    <li>三等奖3名:xxx</li>
                    <li>纪念奖50名:xxx</li>
                </ul>
            </section>
            <section>
                <div class="center"><a href="" class="blue">活动详细规则及常见问题</a></div>
            </section>
            <section>
                <a href="home" class="weui_btn weui_btn_primary" rel="external">开始答题</a>
            </section>
        </section>
    </article>
    @if(isset($request['status']) || isset($request['status']) ))
        <div class="weui_dialog_alert">
            <div class="weui_mask"></div>
            <div class="weui_dialog">
                <div class="weui_dialog_hd"><strong class="weui_dialog_title">提示</strong></div>
                <div class="weui_dialog_bd">
                    @if($request['status'] == "finished")
                        您已经完成了本次考试,不能再重复参与,请保持持续关注,参加下一次考试赢大奖.
                    @elseif($request['status'] == "noexam")
                        当前没有开放的考试,请保持对本微信号的持续关注,参加考试赢大奖.
                    @endif
                </div>
                <div class="weui_dialog_ft">
                    <a href="#" class="weui_btn_dialog primary">确定</a>
                </div>
            </div>
        </div>
    @endif
@endsection