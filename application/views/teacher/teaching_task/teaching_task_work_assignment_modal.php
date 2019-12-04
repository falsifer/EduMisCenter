<!-- Modal -->
<div id="teaching-task-work-assignment-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content" >
            <?php
            $this->load->view('layout/my_school_modal_header');
            ?> 
            <div class="modal-body" style="padding:30px;" >
                <div class="container-fluid">
                    <input type='hidden' id='inWorkId' name='inWorkId' />
                    <div class='row' >
                        <div class='col-md-12'>
                            <div class='col-xs-9'>
                                <label class="control-label">กำหนดวันส่ง</label>
                                <input autocomplete='off' type="text" name="inWorkAssignmentDeadline" id="inWorkAssignmentDeadline" class="form-control datepicker" placeholder="คลิกวันที่..." data-date-format="yyyy-mm-dd" required/>
                            </div>
                            <div class='col-xs-3' style='margin-top:25px;'>
                                <button type="button" class="btn btn-success btn-insert" onclick='InsertThisWork()'><i class="icon-save icon-large"></i> บันทึก</button>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    function InsertThisWork() {
        $.ajax({
            url: "<?php echo site_url('Teaching_task/assign_work_to_student_by_work_id'); ?>",
            method: "post",
            data: {deadline: $("#inWorkAssignmentDeadline").val(), work_id: $("#inWorkId").val(), course_id: $("#inCourseId").val(), room_id: $("#inRoomId").val()},
            success: function (data) {
                alert("บันทึกสำรเร็จ !");
                location.reload();
//                $("#MyBody").html(data);
            }
        });
    }
</script>