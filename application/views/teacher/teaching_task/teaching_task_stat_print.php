<div class="box">
    <div class="box-heading">รายงานและสถิติ (<?php echo $this->session->userdata('name') ?>)

    </div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('teaching-task-base', "งานครูผู้สอน"); ?></li>
        <li><?php echo anchor('course-student-result-base?course_id=' . $this->input->get("course_id") . '&room_id=' . $this->input->get("room_id"), $course['tb_subject_name'] . " - " . $course['tb_course_code']) ?></li>
        <li>รายงานและสถิติ</li>
    </ul>
    <div class="box-body" >

        <input type='hidden' id='inRoomId' name='inRoomId' value='<?php echo $this->input->get("room_id") ?>'/>
        <input type='hidden' id='inCourseId' name='inCourseId' value='<?php echo $this->input->get("course_id") ?>'/>
        <div class='row'>
            <div class='col-md-12' style='margin-top:25px;overflow: auto;' id="MyBody">
             
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view('teacher/teaching_task/teaching_task_work_assignment_modal'); ?>
<script>

</script>