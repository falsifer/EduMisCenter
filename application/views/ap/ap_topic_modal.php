<!-- Modal -->
<div id="ap-topic-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">

                <div class="container-fluid">
                    <form method="post" id="ap-topic-insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2 form-group" >
                                        <label class="control-label">หัวข้อที่ใช้ประเมิน</label>
                                    </div>  
                                    <div class="col-md-9 form-group" >
                                        <input type="text" id="inTopicContent" name="inTopicContent" class="form-control" required autofocus="">
                                    </div>   
                                    <div class="col-md-1 form-group" >
                                        <button type="button" class="btn btn-info btn-topic-insert" id=""><i class="icon-plus icon-large"></i> เพิ่ม</button>
                                    </div>  
                                </div>
                                <div class="row" id="TopicBody">

                                </div>
                            </div>     
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    
//    $("#inTopicContent").keydown(function () {
//        alert("asd");
//        $("input").css("background-color", "yellow");
//    });
    
    $("#ap-topic-insert-form").on("click", ".btn-topic-insert", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('Ap/topic_insert'); ?>",
            method: "post",
            data: {content: $("#inTopicContent").val()},
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#ap-topic-insert-form")[0].reset();
                $.ajax({
                    url: "<?php echo site_url('Ap/get_ap_topic'); ?>",
                    success: function (data) {
                        $("#TopicBody").html(data);
                    }
                });
            }
        });
    });


















//----- แผนการสอน modal
    $("#UnitListBody").on("click", ".btn-plan", function () {
        var uid = $(this).attr('id');
        uhead = $("#head" + uid).val();
        uclss = $("#cls" + uid).val();
        ulev = $("#lev" + uid).val();
        $.ajax({
            url: "<?php echo site_url('Dc/get_head_plan'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $("#UnitIdforPlan").val(uid);
                $("#Headplan").html("<b>การจัดการแผนการสอน ประจำวิชา : " + uhead + " | ระดับชั้น" + uclss + " ปีที่ " + ulev + "</br>");
                $("#HeadplanSub").html("ชื่อหน่วย : " + data.tb_unit_learning_name + " | จำนวน : " + data.tb_unit_learning_hour + " ชั่วโมง | คะแนนเต็ม : " + data.tb_unit_learning_score + " คะแนน");

                $.ajax({
                    url: "<?php echo site_url('Dc/get_plan_hour_list'); ?>",
                    method: "post",
                    data: {id: uid},
                    success: function (data) {
                        $("#inPlanHour").html(data);
                    }
                });

                $.ajax({
                    url: "<?php echo site_url('Dc/get_plan_kpi_list'); ?>",
                    method: "post",
                    data: {id: uid},
                    success: function (data) {
                        $("#inPlanKpi").html(data);
                    }
                });

                $.ajax({
                    url: "<?php echo site_url('Dc/get_plan_list'); ?>",
                    method: "post",
                    data: {id: uid},
                    success: function (data) {
                        $("#PlanListBody").html(data);
                        $("#dc-unit-modal").modal("hide");
                        $("h3.modal-title").text("การจัดการแผนการสอน");

                        $("#dc-plan-modal").modal("show");
                    }
                });
            }
        });



    });

//----- จัดการตัวชี้วัด modal
    $("#UnitListBody").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        var cls = $("#Cls").val();
        var lev = $("#Lev").val();

        $.ajax({
            url: "<?php echo site_url('Dc/edit_unit_list'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#inName").val(data.tb_unit_learning_name);
                $("#inSequence").val(data.tb_unit_learning_sequence);
                $("#inHour").val(data.tb_unit_learning_hour);
                $("#inScore").val(data.tb_unit_learning_score);
                $("#inContent").val(data.tb_unit_learning_content);
                $("#UnitId").val(data.id);
            }
        });


        $.ajax({
            url: "<?php echo site_url('Dc/get_standard_list'); ?>",
            method: "post",
            data: {id: uid, cls: cls, lev: lev},
            success: function (data) {
                $('#StandardTable').html(data);
            }
        });

    });

//----- ลบหน่วยการเรียนรู้
    $("#UnitListBody").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');

        $.ajax({
            url: "<?php echo site_url('Dc/delete_unit_list'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#unit-modal-insert-form")[0].reset();
                location.reload();
            }
        });

        $.ajax({
            url: "<?php echo site_url('Dc/get_standard_list'); ?>",
            method: "post",
            data: {id: uid, cls: cls, lev: lev},
            success: function (data) {
                $('#StandardTable').html(data);
            }

        });
    });




</script>