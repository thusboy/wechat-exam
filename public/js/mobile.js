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

        var qid = $(this).attr("nik");
        var page="#page"+$(this).attr("page");
        var page2 = "#page"+(parseInt($(this).attr("page"))-1);
        $(".correct-answer"+qid).show();
        $(page2+" input").attr("disabled",true);
        setTimeout('$.mobile.changePage("'+page+'","slidedown", true, true);' ,2000);

    });
    $("#exam_finished").click(function(){


        $("input[name='second']").val($(".time-counter").html());
        var qid = $(this).attr("nik");
        $(".correct-answer"+qid).show();
        $(".exam-page input").attr("disabled",false);
        setTimeout('$("#exam-form").submit()' ,2000);

    });

    $(".sharespace").click(function(){
        $(".sharetips").show();
    })


})

function timedCount()
{
    $(".time-counter").html(parseInt($(".time-counter").html())+1);
    setTimeout("timedCount()",1000);
}



wx.ready(function(){
    wx.onMenuShareTimeline({
        title: '我在2016亭湖区青少年网上禁毒知识竞赛中取得了'+$('.middle_score').html()+'分的好成绩,不服来战!iPad等你拿!', // 分享标题
        link: 'http://pic.qiantucdn.com/58pic/18/48/32/5627ce8c8b959_1024.jpg', // 分享链接
        imgUrl: 'http://img0w.pconline.com.cn/pconline/1412/11/spcgroup/width_640,qua_30/5863197_11.jpg', // 分享图标
        success: function () {
            alert("感谢分享");
        },
        cancel: function () {
            alert("分享一下嘛");
        }
    });
    wx.onMenuShareAppMessage({
        title: '答题赢iPad Air-还有更多丰富奖品', // 分享标题
        desc: '我正在参加2016亭湖区青少年网上禁毒知识竞赛,得了'+$('.middle_score').html()+'分,不服来战!!!!', // 分享描述
        link: '', // 分享链接
        imgUrl: 'http://img0w.pconline.com.cn/pconline/1412/11/spcgroup/width_640,qua_30/5863197_11.jpg', // 分享图标
        type: '', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        success: function () {
            alert("感谢分享");
        },
        cancel: function () {
            alert("分享一下嘛");
        }
    });


})



