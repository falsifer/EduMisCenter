<style>
    .My-btn{
        width:100%;
        height: 70px; 
        float: left;
        font-size:1.2em;
        margin-bottom: 5px;
    }
    input[type=radio] {
        border: 0px;
        width: 20%;
        height: 1.5em;
    }
</style>
<div class="box">
    <div class="box-heading">โครงสร้างรายวิชา (<?php echo $course['tb_subject_name'] . " - " . $course['tb_course_code'] ?>)</div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('teaching-task-base', "งานครูผู้สอน"); ?></li>
        <!--<li><?php echo anchor('teaching-task-development', "การจัดการวิชา"); ?></li>-->
        <li><?php echo $course['tb_subject_name'] . " - " . $course['tb_course_code'] ?></li>
    </ul>
    <div class="box-body">
        <input type="hidden" value="<?php echo $course_detail['id'] ?>" id="InCourseDetailId" name="InCourseDetailId"/>
        <div class='row'>

            <?php
            $this->load->view('layout/my_school_logo');
            ?> 

            <div class='col-md-9'>
                <div>

                    <center><h3 class="modal-title" id="" ><b>โครงสร้างรายวิชา</b></h3></center>
                    <center><b id="HeadResult">สรุปโครงสร้างรายวิชา ประจำวิชา : <?php echo $course['tb_subject_name'] . "(" . $course['tb_course_code'] . ")" ?> | ระดับชั้น<?php echo $course['tb_ed_school_class_name'] . "ปีที่ " . $course['tb_ed_school_class_level'] . " เวลาเรียน" . $course['tb_course_hour_term'] . "ชั่วโมง/ภาคเรียน จำนวน " . $course['tb_course_credit'] . " หน่วยกิต" ?></b></center>
                    <br/>
                    <div class='row'>
                        <div class='col-md-12'>


                            <div class='col-xs-12'>
                                <div id='CourseDetail'>
                                    <legend >คำอธิบายรายวิชา <button type='button' class='btn btn-link' onclick="EditCourseDetailModal(this)"><i class='icon-pencil icon-large' style='color:orange'></i> </button></legend>
                                    <?php echo $course_detail['tb_course_detail'] ?>
                                </div>
                                <div id='CourseDetail2'>
                                    <h4>ตัวชี้วัดประจำรายวิชา</h4>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <div class='col-md-3'>
                <div class="panel panel-primary">
                    <div class="panel-heading"  id='PanelHeader'>

                        <?php echo $panel_header ?>
                    </div>
                    <div class="panel-body">
                        <button type='button' class='btn btn-primary My-btn' id='teaching-task-course-unit-base' onclick='CoursePortal(this)'>
                            <i class="icon-book icon-large"></i> หน่วยการเรียนรู้
                        </button>
                        <br/>
                        <button type='button' class='btn btn-primary My-btn' id='course-work' onclick='CoursePortal(this)'>
                            <i class="icon-file icon-large"></i> กำหนดชิ้นงาน/ภาระงาน
                        </button>
                        <br/>
                        <button type='button' class='btn btn-primary My-btn' id='course-todolist' onclick='CoursePortal(this)'>
                            <i class="icon-check icon-large"></i> กำหนดเนื้อหาการสอน
                        </button>
                        <br/>
                        <button type='button' class='btn btn-primary My-btn' id='course-management' onclick='CoursePortal(this)'>
                            <i class="icon-print icon-large"></i> สรุปโครงสร้างรายวิชา
                        </button>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("teacher/teaching_task/teaching_task_course_detail_modal"); ?>

<script>

    function EditCourseDetailModal() {
        $.ajax({
            url: "<?php echo site_url('Teaching_task/get_course_detail_by_id'); ?>",
            method: "post",
            dataType: "json",
            data: {id: $("#InCourseDetailId").val()},
            success: function (data) {
                $("#inCourseDetail").val(data.tb_course_detail);
                //
                $('#teaching-task-course-detail-modal').modal('show');
            }
        });


    }

    function CoursePortal(e) {
        var term = 1;
        var course_detail_id = $("#InCourseDetailId").val();

        if (document.getElementById('inRadioTerm1').checked) {
            term = document.getElementById('inRadioTerm1').value;
        } else {
            term = document.getElementById('inRadioTerm2').value;
        }

        $.ajax({
            url: '<?php echo site_url('Teaching_task/teaching_task_set_session'); ?>',
            method: 'post',
            data: {id: course_detail_id}
        });

        switch (e.id) {
            case "teaching-task-course-unit-base":
                location.href = '<?php echo site_url('teaching-task-course-unit-base'); ?>?course_detail_id=' + course_detail_id + '&term=' + term;
                break;
            case "course-work":
                location.href = '<?php echo site_url('teaching-task-course-work-base'); ?>?course_detail_id=' + course_detail_id + '&term=' + term;
                break;
            case "course-todolist":
                location.href = '<?php echo site_url('course-todolist'); ?>?course_detail_id=' + course_detail_id + '&term=' + term;
                break;


        }

    }

</script>