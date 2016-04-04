$(function() {
    timedCount();
    $(".weui_btn_dialog").click(function () {
        $(".weui_dialog_alert").remove();
    });
    $("#exam_finished").click(function(){
        $("input[name='second']").val($(".time-counter").html());
    })

})

function timedCount()
{
    $(".time-counter").html(parseInt($(".time-counter").html())+1);
    setTimeout("timedCount()",1000);
}
