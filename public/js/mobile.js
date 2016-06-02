$(function() {

    $(".weui_btn_dialog").click(function () {
        $(".weui_dialog_alert").remove();
    });

    $("#exam_start").click(function(){
        var second =$(".time-counter").html();
        if (second == "0"){
            timedCount();
        }
    });
    $(".exam_next").click(function(){
        var second =$(".time-counter").html();
        if (second == "0"){
            alert("请不要在考试中点击刷新,系统将强制退出考试,3次以上的恶意刷新将视为作弊系统将取消该用户所有考试成绩.");
            wx.closeWindow();
            return false;
        }
    });
    $("#exam_finished").click(function(){


            $("input[name='second']").val($(".time-counter").html());

    });

})

function timedCount()
{
    $(".time-counter").html(parseInt($(".time-counter").html())+1);
    setTimeout("timedCount()",1000);
}


wx.ready(function(){
    wx.onMenuShareTimeline({
        title: '答题赢Iphone6S-略阳团委2016普法考试', // 分享标题
        link: 'http://pic.qiantucdn.com/58pic/18/48/32/5627ce8c8b959_1024.jpg', // 分享链接
        imgUrl: '', // 分享图标
        success: function () {
            alert("感谢分享");
        },
        cancel: function () {
            alert("分享一下嘛");
        }
    });
    wx.onMenuShareAppMessage({
        title: '答题赢Iphone6S-略阳团委2016普法考试', // 分享标题
        desc: '只要连续十天答题,分数最高者就可获得Iphone6s 16G一部哦,多多分享,让更多人参与进来,分享一样有礼', // 分享描述
        link: '', // 分享链接
        imgUrl: 'http://pic.qiantucdn.com/58pic/18/48/32/5627ce8c8b959_1024.jpg', // 分享图标
        type: '', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        success: function () {
            // 用户确认分享后执行的回调函数
        },
        cancel: function () {
            // 用户取消分享后执行的回调函数
        }
    });


})



