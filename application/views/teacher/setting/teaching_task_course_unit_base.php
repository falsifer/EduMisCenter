<style>
    .My-btn{
        width:100%;
        height: 70px; 
        float: left;
        font-size:1.2em;
        margin-bottom: 5px;
    }
</style>
<div class="box">
    <div class="box-heading">การจัดการหน่วยการเรียนรู้ (<?php echo $course['tb_subject_name'] . " - " . $course['tb_course_code'] . " ภาคเรียนที่ " . $this->input->get('term'); ?>)</div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('teaching-task-base', "งานครูผู้สอน"); ?></li>
        <!--<li><?php echo anchor('course-management?course_id=' . $course['course_id'], $course['tb_subject_name'] . " - " . $course['tb_course_code']) ?></li>-->
       <!--<li><?php echo anchor('teaching-task-development', "การจัดการวิชา"); ?></li>-->
        <li>การจัดการหน่วยการเรียนรู้</li>


    </ul>
    <div class="box-body">
        <div class='row'>
            <div class='col-md-10 col-md-offset-1'>

                <div class='col-md-12' style='margin-bottom:15px;'>

<!--                    <span style='float:left;margin:5px 5px 0 0;'>
                        <button type='button' class='btn btn-success' onclick="UnitModalShow(this)"><i class='icon-plus icon-large'></i> เพิ่มหน่วย</button>
                    </span>-->

                </div>
                <div class='col-md-8'>
                    <legend >หน่วยการเรียนรู้ประจำวิชา<?php echo $course['tb_subject_name'] . " - " . $course['tb_course_code'] . " ภาคเรียนที่ " . $this->input->get('term'); ?></legend> 
                </div>
                <div class='col-md-4'>
                    <span style='float:left;margin:5px 5px 5px 0;'>
                        <button type='button' class='btn btn-primary' onclick="UnitModalShow(this)"><i class='icon-plus icon-large'></i> เพิ่มหน่วย</button> 
                    </span>

                    <?php
                    $this->load->view('layout/my_school_print');
                    ?> 
                    <script>
                        window.onload = function () {
                            $('#MySchoolAreaId').val("print");
                        };
                    </script>
                </div>




                <div id='print' class='col-md-12' >
                    <table class="table table-hover table-bordered display" id="example">
                        <thead>
                            <tr style='background-color: #eeeeee;'>
                                <th style="width:10%; text-align: center">ลำดับที่</th>
                                <th style="width:20%;text-align: center">ชื่อหน่วยการเรียนรู้</th>
                                <th style="width:30%;text-align: center"><?php echo subject_type_to_head_course($course['tb_subject_type']) ?></th>

                                <th style="width:20%;text-align: center">สาระสำคัญ</th>
                                <th style="width:5%;text-align: center">เวลา(ชั่วโมง)</th>
                                <th style="width:15%;text-align: center">น้ำหนักคะแนน</th>
                                <th style="width:20%;text-align: center;cursor:pointer;" class='no-print'></th>
                            </tr>
                        </thead>
                        <tbody id="ResultBody">
                            <?php echo $tbody; ?>
                        </tbody>
<!--                        <tfoot>
                            <tr style='background-color: #eeeeee;'> 
                                <td colspan='4'style='text-align: center;'><b>สรุปผล</b></td>
                                <td style='text-align: center;'><b>ชั่วโมง</b></td>
                                <td style='text-align: center;'><b>คะแนน</b></td>
                                <td></td>
                            </tr>
                        </tfoot>-->
                    </table>
                </div>
            </div>
            <input type='hidden' id='InCourseId' name='InCourseId' value='<?php echo $course['course_id'] ?>'/>
            <input type="hidden" value="" id="InUnitId" name="InUnitId"/>

        </div>



    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("teacher/setting/teaching_task_course_unit_modal"); ?>
<?php $this->load->view("teacher/setting/teaching_task_course_unit_manage_modal"); ?>
<?php $this->load->view("teacher/setting/teaching_task_course_unit_manage_purpose_modal"); ?>

<script>



    function UnitModalShow(e) {
        $("#unit-modal-insert-form")[0].reset();
        $('#teaching-task-course-unit-modal').modal('show');
    }
    function UnitEdit(e) {

        $.ajax({
            url: "<?php echo site_url('Teacher/edit_course_unit'); ?>",
            method: "post",
            data: {id: e.id},
            dataType: "json",
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                $("#inUnitId").val(data.id);
                $("#inUnitSequence").val(data.tb_unit_learning_sequence);
                $("#inUnitName").val(data.tb_unit_learning_name);
                $("#inUnitContent").val(data.tb_unit_learning_content);
                $("#inUnitHour").val(data.tb_unit_learning_hour);
                $("#inUnitScore").val(data.tb_unit_learning_score);

                //
                $('#teaching-task-course-unit-modal').modal('show');
            }
        });
    }

    function UnitManage(e) {
//        alert(e.id);
        $.ajax({
            url: "<?php echo site_url('Teacher/manage_course_unit'); ?>",
            method: "post",
            data: {id: e.id},
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
//                alert(data);
                $('#InUnitId').val(e.id);
                $("#KpiLearningTBody").html(data);
                $('#teaching-task-course-unit-manage-modal').modal('show');
            }
        });

    }

    function UnitManagePurpose(e) {

        $.ajax({
            url: "<?php echo site_url('Teacher/manage_course_unit_purpose'); ?>",
            method: "post",
            data: {id: e.id},
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                $('#InUnitId').val(e.id);
                $("#PurposeTBody").html(data);
                $('#teaching-task-course-unit-manage-purpose-modal').modal('show');
            }
        });

    }

    function UnitDelete(e) {

        var status = confirm('ต้องการลบหน่วยการเรียนรู้นี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Teacher/delete_course_unit'); ?>',
                method: 'post',
                data: {id: e.id},
                beforeSend: function () {
                    MyStartLoading();
                }, success: function (data) {
                    MyEndLoading();
                    location.reload();
                }
            });
        }
    }

    function KpiDelete(e) {
        var status = confirm('ต้องการลบตัวชี้วัดนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Teacher/delete_course_kpi'); ?>',
                method: 'post',
                data: {id: e.id},
                beforeSend: function () {
                    MyStartLoading();
                }, success: function (data) {
                    MyEndLoading();
                    location.reload();
                }
            });
        }
    }

    function PurposeDelete(e) {
        var status = confirm('ต้องการลบจุดประสงค์นี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Teacher/delete_course_purpose'); ?>',
                method: 'post',
                data: {id: e.id},
                beforeSend: function () {
                    MyStartLoading();
                }, success: function (data) {
                    MyEndLoading();
                    location.reload();
                }
            });
        }
    }

    function PurposeEdit(e) {

        $.ajax({
            url: "<?php echo site_url('Teacher/edit_course_purpose'); ?>",
            method: "post",
            data: {id: e.id},
            dataType: "json",
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                $("#inPurposeId").val(data.id);
                $("#inCoursePurposeName").val(data.tb_course_purpose_name);
                $("#inCoursePurposeScore").val(data.tb_course_purpose_score);

                $('#teaching-task-course-unit-manage-purpose-modal').modal('show');
            }
        });
    }
</script>