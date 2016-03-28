@extends('layouts.mobile')

@section('content')
    <article class="weui_article">

        <div class="page_title">
            <img src="{{ URL::asset('images/gqt_logo_s.png') }}" alt="">

            <h1>共青团略阳县委2016青少年普法考试</h1>
        </div>
        <section>
            <section>
                <div><span class="inline_title">活动主办:</span>共青团略阳县委</div>
                <div><span class="inline_title">活动时间:</span>2016年3月1日-2016年6月1日</div>
                <div><span class="inline_title">赞助单位:</span>略阳县xxx公司</div>
                <div><span class="inline_title">官方平台:</span>共青团略阳县委官方公众号</div>
                <div><span class="inline_title">技术支持:</span>汉中易格科技有限公司</div>
            </section>
            <section>
                <div class="inline_title">奖项设置:</div>
                <ul>
                    <li>一等奖1名,奖品iPhone6s手机1部</li>
                    <li>二等奖2名,奖品价值3000元的平衡车1部</li>
                    <li>3等奖165名,奖品价值200元的话费或者上网流量包</li>
                </ul>
            </section>
            <section>
                <div class="center"><a href="" class="blue">活动详细规则及常见问题</a></div>
            </section>
            <section>
                <a href="#" class="weui_btn weui_btn_primary">开始答题</a>
            </section>
        </section>
    </article>
@endsection