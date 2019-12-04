<div class="box">
    <div class="box-heading">การติดตามงาน (<?php echo $this->session->userdata('name') ?>)

    </div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('teaching-task-base', "งานครูผู้สอน"); ?></li>
        <li><?php echo anchor('course-student-result-base?course_id=' . $this->input->get("course_id") . '&room_id=' . $this->input->get("room_id"), $course['tb_subject_name'] . " - " . $course['tb_course_code']) ?></li>
        <li>การติดตามงาน</li>
    </ul>
    <div class="box-body" >

        <input type='hidden' id='inRoomId' name='inRoomId' value='<?php echo $this->input->get("room_id") ?>'/>
        <input type='hidden' id='inCourseId' name='inCourseId' value='<?php echo $this->input->get("course_id") ?>'/>
        <div class='row'>
            <div class='col-md-12' style='margin-top:25px;' id="MyBody">
                <?php echo $table ?>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view('teacher/teaching_task/teaching_task_work_assignment_modal'); ?>
<script>
    function SelectThisUnit(e) {
//        alert(e.value);
        $.ajax({
            url: "<?php echo site_url('Teaching_task/gen_work_assignment_by_unit_id'); ?>",
            method: "post",
            data: {unit_id: e.value, course_id: $("#inCourseId").val(), room_id: $("#inRoomId").val()},
            success: function (data) {
                $("#MyBody").html(data);
            }
        });
    }

    function AsignThisWork(e) {

//alert(e.id);
        $.ajax({
            url: "<?php echo site_url('Teaching_task/get_course_work_by_id'); ?>",
            method: "post",
            dataType: "json",
            data: {id: e.id},
            success: function (data) {
                $("#inWorkId").val(data.id);
                $("#inWorkAssignmentDeadline").val(data.tb_course_work_deadline);
                $("#teaching-task-work-assignment-modal").modal("show");
//                $("#MyBody").html(data);
            }
        });
    }

    function SendStdWork(e) {
        $.ajax({
            url: "<?php echo site_url('Teaching_task/send_student_work'); ?>",
            method: "post",
            data: {id: e.id},
            success: function (data) {
               location.reload();
            }
        });
    }

</script>