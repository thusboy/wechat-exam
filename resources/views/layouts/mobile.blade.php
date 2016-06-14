<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>{{ isset($page_title)?$page_title:"共青团盐城市亭湖区委员会"}}</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/jquery-mobile/1.4.5/jquery.mobile.min.css"/>
    <link rel="stylesheet" href="{{ URL::asset('/dist/style/weui.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('/css/app.css') }}"/>

</head>
<body>
    @yield("content")
<!-- JavaScripts -->
@if(isset($js))
<script src=" http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript" charset="utf-8">
    wx.config({!! $js->config(array('onMenuShareTimeline','onMenuShareAppMessage') ) !!});
</script>
@endif
<script src="http://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/jquery-mobile/1.4.5/jquery.mobile.min.js"></script>
<script src="{{ URL::asset('/js/mobile.js') }}"></script>
</body>
</html>
