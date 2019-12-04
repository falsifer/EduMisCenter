<div class="box">
    <div class="box-heading">ผลการพัฒนาคุณภาพผู้เรียนรายวิชา (<?php echo $course['tb_course_code'] ?>) ครูประจำวิชา <?php echo $this->session->userdata('name') ?>

    </div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('teaching-task-base', "งานครูผู้สอน"); ?></li>
        <li><?php echo anchor('course-student-result-base?course_id=' . $this->input->get("course_id") . '&room_id=' . $this->input->get("room_id"), $course['tb_subject_name'] . " - " . $course['tb_course_code']) ?></li>
        <li>ผลการพัฒนาคุณภาพผู้เรียนรายวิชา</li>
    </ul>
    <div class="box-body" >
        <input type='hidden' id='inRoomId' name='inRoomId' value='<?php echo $this->input->get("room_id") ?>'/>
        <input type='hidden' id='inCourseId' name='inCourseId' value='<?php echo $this->input->get("course_id") ?>'/>
        <div class="row" >

            <div class="col-md-12" style='margin-top:25px;' >
                <div class="col-md-4">
                    <label class="control-label">หน่วยการเรียนรู้</label>
                    <select class='form-control' onchange='OnUnitChange(this)'>
                        <option value=''>---เลือกข้อมูล---</option>
                        <?php echo $unit_learning ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class='form-control' style='margin-top:25px;' onchange='OnObChange(this)' id='inWork' name='inWork'>
                        <option value=''>---เลือกข้อมูล---</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12" style='margin-top:25px;overflow-x:auto;' id='StudentBody'>
            </div>
        </div>

    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view('teacher/teaching_task/teaching_task_detail_modal'); ?>
<script>
    function UnitOnChange(e) {
        $.ajax({
            url: "<?php echo site_url('Teaching_task/teaching_task_course_work_base_by_filter'); ?>",
            method: "POST",
            data: {unit_id: e.value, room_id: '<?php echo $this->input->get('room_id') ?>', course_id: '<?php echo $this->input->get('course_id') ?>'},
            success: function (data) {
                $("#StudentBody").html(data);
            }
        });
    }

    function InsertScore(e) {

        var MyInput = e.id;
        var res = MyInput.split(",");
        var TopicId = res[0];
        var StdId = res[1];
        var Score = e.value;
//        alert(TopicId + "|" + StdId);

        if (Score == "") {
            Score = 0;
        }

        if (Score <= e.name) {
            e.style.color = "blue";
            $.ajax({
                url: "<?php echo site_url('Teaching_task/teaching_task_course_work_insert_score'); ?>",
                method: "POST",
                data: {topicid: TopicId, stdid: StdId, score: Score}, success: function (data) {
//                $.ajax({
//                    url: "<?php echo site_url('Teaching_task/teaching_task_course_work_insert_score_reload'); ?>",
//                    method: "POST",
//                    data: {topicid: TopicId, stdid: StdId}, success: function (data) {
//                        $("#result" + StdId).html(data);
//                    }
//                });
                }
            });
            
        } else {
            e.style.color = "red";
        }
    }



    //--- New boi


    function OnUnitChange(e) {
        $.ajax({
            url: "<?php echo site_url('Teaching_task/get_work_list_by_unit_id'); ?>",
            method: "POST",
            data: {id: e.value},
            success: function (data) {
                $("#inWork").html(data);
            }
        });
    }

    function OnObChange(e) {
        $.ajax({
            url: "<?php echo site_url('Teaching_task/gen_work_kpi_score_by_work_id'); ?>",
            method: "POST",
            data: {id: e.value, course_id: $("#inCourseId").val(), room_id: $("#inRoomId").val()},
            success: function (data) {
                $("#StudentBody").html(data);
            }
        });
    }
</script>