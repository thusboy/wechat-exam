@extends('layouts.mobile')
<script type="text/javascript">

    javascript:window.history.forward(1);//禁用回退（比如：当前在B页面，点击后退会退回到A页面，那么该代码写在A页面，然后在B页面就不会回退到A了）

</script>
@section('content')
    <article class="weui_article">

        <div class="page_title">
            <img src="{{ URL::asset('images/gqt_logo_s.png') }}" alt="" height="80px" width="80px">

            <h1><span class="small">共青团略阳县委</span><br />2016青少年网上普法知识大赛 </h1>
        </div>
        <section>
            <section>
                <div><span class="inline_title">活动主办:</span><p>略阳县司法局 共青团略阳县委 略阳县普法办</p></div>
                <div><span class="inline_title">支持单位:</span><p>汉中易格科技有限公司 汉中移动略阳分公司</p></div>
                <div><span class="inline_title">活动时间:</span>2016年4月18日-2016年4月27日(共10天)</div>
                <div><span class="inline_title">官方平台:</span>共青团略阳县委官方公众号</div>
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
                    注:本次普法大赛奖品仅对汉中市参赛者有效,其它地区参赛者成绩只做参考
                </div>

                <div class="center">
                    <a href="http://mp.weixin.qq.com/s?__biz=MzA5NzYzNjcyOA==&mid=405430137&idx=1&sn=5dd49ba0a6347542e7011cd1ada3d12a&scene=1&srcid=0414IRHzWhPddXfP95YBpH3W&from=singlemessage&isappinstalled=0#wechat_redirect" class="blue" rel="external">活动详细规则及常见问题</a>
                </div>
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