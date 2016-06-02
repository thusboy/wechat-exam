$(function(){


    $('.input-daterange').datepicker({
        language: 'zh-CN',
        todayBtn: 'linked',
        todayHighlight : true,
        format: 'yyyy-mm-dd',
    });
    $('.exam-del').click(function(){
        var id = $(this).parent().parent().attr("for");
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "删除": function() {
                    location.href = burl+"/admin/delete?term=exam&id="+id;
                },
                "取消": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    })
    $('.question-del').click(function(){
        var id = $(this).attr("for1");
        var eid = $(this).attr("for2");
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "删除": function() {
                    location.href = burl+"/admin/delete?term=question&id="+id+"&eid="+eid;
                },
                "取消": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    })
    $('.exam-update').click(function(){
        var id = $(this).parent().parent().attr("for");
        $(".exam-update-panel>.panel-heading").html("编辑考试");
        $("input[name='eid']").val(id);
        $("input[name='title']").val($("#title"+id).html());
        $("input[name='start']").val($("#start"+id).html());
        $("input[name='number_s_s']").val("40");
        $("input[name='number_s_m']").val($("#numberm"+id).html());
        $("input[name='end']").val($("#end"+id).html());
    })
    $('#add-answer').click(function(){
        if($('.answer-table tr a:last').length > 0){
            var last_id = parseInt($('.answer-table tr a:last').attr('id')) + 1;
        }
        else {
            var last_id = 1;
        }
        var content=$('.stand tbody').html();
        $('.answer-table').append(content.replace(/replace/g,last_id));
    })



    $(document).on("click",".answer-remove",function(){

        $("#answer"+$(this).attr('id')).remove();
    })




})