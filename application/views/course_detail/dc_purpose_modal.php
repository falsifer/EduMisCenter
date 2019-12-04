<!-- Modal -->
<div id="dc-purpose-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">


                <div class="row">                                    
                    <b id="HeadUnit"></b>
                    <br>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form id='CoursePurposeForm'>
                            <div class="row">
                                <div class="col-md-8 form-group">
                                    <label class="control-label">ชื่อจุดประสงค์การเรียนรู้</label>
                                    <input type="text" name="inCoursePurposeName" id="inCoursePurposeName" class="form-control" required=""/>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label class="control-label">คะแนนเต็ม</label>
                                    <input type="text" name="inCoursePurposeScore" id="inCoursePurposeScore" class="form-control" maxlength="3" type="number" onkeypress='validate(event)' required=""/>
                                </div>
                                <div class="col-md-2 form-group">            
                                    <button type="button" style='margin-top:25px;' class="btn btn-success btn-insert-purpose" onclick='InsertCoursePurpose(this)'><i class="icon-save icon-large"></i> บันทึกข้อมูล</button>
                                </div>
                            </div>
                            <input type="hidden" name="PurposeId" id="PurposeId"  readonly/>
                        </form>
                    </div>                            
                </div>
                <br/>
                <!--table-->
                <table class="table table-hover table-striped table-bordered display">
                    <thead>
                        <tr style='background: whitesmoke;'>
                            <th style="width:10%; text-align: center;">ที่</th>
                            <th style="width:60%; text-align: center;" class="no-sort">ชื่อจุดประสงค์การเรียนรู้</th>
                            <th style="width:10%; text-align: center;" class="no-sort">คะแนนเต็ม</th>
                            <th style="width:20%; text-align: center;" class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody id="CoursePurposeListBody">

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<script>
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault)
                theEvent.preventDefault();
        }
    }

    function InsertCoursePurpose(e) {

        var topic = $("#inCoursePurposeName").val();
        var score = $("#inCoursePurposeScore").val();
        var recordid = $("#PurposeId").val();

        $.ajax({
            url: "<?php echo site_url('Dc/dc_insert_course_purpose'); ?>",
            method: "post",
            data: {CourseId: CourseId, topic: topic, score: score, recordid: recordid},
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#CoursePurposeForm")[0].reset();
                $.ajax({
                    url: "<?php echo site_url('Dc/get_course_purpose_list'); ?>",
                    method: "post",
                    data: {id: CourseId},
                    success: function (data) {
                        $('#CoursePurposeListBody').html(data);
                    }
                });
            }
        });
    }

    function EditCoursePurpose(e) {
        $.ajax({
            url: "<?php echo site_url('Dc/dc_edit_course_purpose'); ?>",
            method: "post",
            data: {id: e.id},
            dataType: "json",
            success: function (data) {
                $("#PurposeId").val(data.id);
                $("#inCoursePurposeName").val(data.tb_course_purpose_name);
                $("#inCoursePurposeScore").val(data.tb_course_purpose_score);
            }
        });
    }

    function DeleteCoursePurpose(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Dc/dc_delete_course_purpose'); ?>",
                method: "post",
                data: {id: e.id},
                success: function (data) {
                    $.ajax({
                        url: "<?php echo site_url('Dc/get_course_purpose_list'); ?>",
                        method: "post",
                        data: {id: CourseId},
                        success: function (data) {
                            $('#CoursePurposeListBody').html(data);
                        }
                    });
                }
            });
        }
    }


</script>