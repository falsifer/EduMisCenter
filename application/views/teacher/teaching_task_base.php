<div class="box">
    <div class="box-heading">งานครูผู้สอน (<?php echo $this->session->userdata('name') ?>)

    </div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>งานครูผู้สอน</li>
    </ul>
    <style>
        .containerzz{
            margin-left: 10px;
            margin-top: 10px;
        }
        .mycardcontent {

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 100%;
            margin: auto;
            text-align: center;
            font-family: arial;
            /*margin-top: 30px;*/
            padding: 10px;
            /*padding-left: 20px;*/

        }
        .mycardcontent:hover {
            box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
        }

        .head-title{
            margin-bottom: 10px;
        }

        [type="date"] {
            background:#fff url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;
        }
        [type="date"]::-webkit-inner-spin-button {
            display: none;
        }
        [type="date"]::-webkit-calendar-picker-indicator {
            opacity: 0;
        }
        .My-btn{
            width:100%;
            height: 70px; 
            float: left;
            font-size:1.5em;
            margin-bottom: 5px;
        }
    </style>
    <div class="box-body" >
        <!--<div class='container'>-->
        <br/>
        <div class="row">
            <div class='col-md-8' >

                <div class='col-md-12'>
                    <h3><i class='icon icon-calendar'></i> ตารางสอน <?php echo $this->session->userdata('name'); ?></h3>
                    <!--<h4><?php echo $this->session->userdata('department'); ?>(<?php echo $this->session->userdata('hr_id'); ?>)</h4>-->
                    <h4 id="yearly_term"></h4>
                    <!--</div>-->
                    <!--<div class='col-md-5'>-->
                    <?php
//        $data['class'] = 'Y';
                    $data['term'] = 'Y';
                    $this->load->view('layout/my_school_filter', $data);
                    ?>
                </div>



                <table class='  table-bordered display' style='width:100%' >
                    <tbody id='ScheduleBody'>
                    </tbody>
                </table>

            </div>
            <div class='col-md-4'>
                <div class='mycardcontent ' style='height: 100%;width: 100%;margin-bottom: 20px;padding:2px;'>
                    <div style='background-color:darkcyan;height: 150px;width: 100%;text-align: center;vertical-align: middle;color:white;padding-top: 10px;'>
                        <p style='font-size: 1.7em;'>วิชาที่รับผิดชอบ</p>
                        <div class='row '>
                            <div class='col-md-12'>
                                <div class='col-md-3' style='margin-top:10px;font-size:1.2em;'>
                                    รายวิชา
                                </div>
                                <div class='col-md-9' style='margin-top:10px;'>
                                    <select name="inMyCourse" id="inMyCourse" class="form-control" onchange="onMyCourseChange(this)">
                                        <?php
                                        $output = "";

                                        foreach ($rCourse as $r) {
                                            if ($r['id'] == $this->session->userdata('teaching_id')) {
                                                $output .= "<option selected value='" . $r['id'] . "'>" . $r['tb_course_code'] . " - " . $r['tb_subject_name'] . " | " . $r['tb_ed_school_register_class_edyear'] . "/" . $r['tb_course_term'] . " </option>";
                                            } else {
                                                $output .= "<option value='" . $r['id'] . "'>" . $r['tb_course_code'] . " - " . $r['tb_subject_name'] . " | " . $r['tb_ed_school_register_class_edyear'] . "/" . $r['tb_course_term'] . " </option>";
                                            }
                                        }


                                        echo $output
                                        ?>
                                        <!-- <option > ท11101 - ภาษาไทย | 2562/1</option> -->
                                    </select>
                                </div>
                                <div class='col-md-3' style='margin-top:10px;font-size:1.2em;'>
                                    ห้อง
                                </div>
                                <div class='col-md-9' style='margin-top:10px;'>
                                    <select name="inMyRoom" id="inMyRoom" class="form-control" >
                                        <!--<option >แผนทั่วไป ห้อง 1</option>-->
                                    </select>
                                </div>
                            </div>

                        </div>


                    </div>
                    <br/>
                    <button type='button' class='btn btn-primary My-btn' id='course-management' onclick='CoursePortal(this)'>
                        <i class="icon-gear icon-large"></i> การตั้งค่ารายวิชา
                    </button>
                    <br/>
                    <button type='button' class='btn btn-primary My-btn' id='course-student-result-base' onclick='CoursePortal(this)'>
                        <i class="icon-book icon-large"></i> ผลการพัฒนาคุณภาพผู้เรียน
                    </button>
                    <br/>
                    
<!--                    <button type='button' class='btn btn-primary My-btn' id='teaching-task-work-assignment-base' onclick='CoursePortal(this)'>
                        <i class="icon-user icon-large"></i> การติดตามงาน
                    </button>
                    <br/>
                    <button type='button' class='btn btn-primary My-btn' id='pp5-fill-score' onclick='CoursePortal(this)'>
                        <i class="icon-user icon-large"></i> ผลการพัฒนาคุณภาพผู้เรียน
                    </button>
                    <br/>
                    <button type='button' class='btn btn-primary My-btn' id='teaching-task-absent-record' onclick='CoursePortal(this)'>
                        <i class="icon-check icon-large"></i> เวลามาเรียนรายวิชา
                    </button>
                    <br/>
                    <button type='button' class='btn btn-primary My-btn' id='teaching-task-cha' onclick='CoursePortal(this)'>
                        <i class="icon-check icon-large"></i> คะแนนคุณลักษณะ
                    </button>
                    <br/>
                    <button type='button' class='btn btn-primary My-btn' id='teaching-task-rwa' onclick='CoursePortal(this)'>
                        <i class="icon-check icon-large"></i> คะแนนอ่านคิดวิเคราะห์
                    </button>
                    <br/>
                    <button type='button' class='btn btn-info My-btn' id='teaching-task-result-base' onclick='CoursePortal(this)'>
                        <i class="icon-search icon-large"></i> สรุปผล
                    </button>-->







                </div>
            </div>
        </div>
        <!--</div>-->

    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
    <?php // $this->load->view('homeroom/hr_homeroom_absent_record_modal')    ?>
</div>
<?php $this->load->view('teacher/teaching_task/teaching_task_detail_modal'); ?>




<script>
    window.onload = function () {
        $('#inMyCourse').change();
    }
    function CoursePortal(e) {
        var course_id = $("#inMyCourse").val();
        var room_id = $("#inMyRoom").val();

        switch (e.id) {
            case "course-management":
                location.href = '<?php echo site_url('course-management'); ?>?course_id=' + course_id;
                break;
            case "course-work":
                location.href = '<?php echo site_url('teaching-task-course-work-base'); ?>?course_id=' + course_id;
                break;
            case "pp5-fill-score":
                location.href = '<?php echo site_url('pp5-fill-score'); ?>?course_id=' + course_id + '&room_id=' + room_id;
                break;
            case "teaching-task-absent-record":
                location.href = '<?php echo site_url('teaching-task-absent-record'); ?>?course_id=' + course_id + '&room_id=' + room_id;
                break;
            case "teaching-task-cha":
                location.href = '<?php echo site_url('teaching-task-cha'); ?>?course_id=' + course_id + '&room_id=' + room_id;
                break;
            case "teaching-task-rwa":
                location.href = '<?php echo site_url('teaching-task-rwa'); ?>?course_id=' + course_id + '&room_id=' + room_id;
                break;
            case "teaching-task-work-assignment-base":
                location.href = '<?php echo site_url('teaching-task-work-assignment-base'); ?>?course_id=' + course_id + '&room_id=' + room_id;
                break;
            case "teaching-task-result-base":
                location.href = '<?php echo site_url('teaching-task-result-base'); ?>?course_id=' + course_id + '&room_id=' + room_id;
                break;
                case "course-student-result-base":
                location.href = '<?php echo site_url('course-student-result-base'); ?>?course_id=' + course_id + '&room_id=' + room_id;
                break;
        }


    }
</script>
<script>

    function MyTermOnChange(e) {

        var yearly = $('#MyEdYear').val();
        var term = $("#MyTerm :selected").val();
        $('#yearly_term').html('ปีการศึกษา ' + yearly + ' ภาคเรียนที่ ' + term);
        $.ajax({
            url: "<?php echo site_url('Teaching_task/teaching_task_schedule_body'); ?>",
            method: "post",
            data: {yearly: yearly, eterm: term},
            success: function (data) {
//                alert('asdasd');
                $('#ScheduleBody').html(data);
//                MyReload();
            }
        });
    }

    function ScheduleDetail(e) {
//        alert(e.id);
//        $('#teaching-task-detail-modal').modal('show');
        var id = e.id;
        var yearly = $('#MyEdYear').val();
        location.href = '<?php echo site_url('pp5'); ?>?sc_id=' + id + '&EdYear=' + yearly;
    }


    function onMyCourseChange(e) {
        $.ajax({
            url: "<?php echo site_url('Teaching_task/get_room_list_by_course_id'); ?>",
            method: "post",
            data: {id: e.value},
            success: function (data) {
//                alert(data);
                $("#inMyRoom").html(data);
            }
        });
    }
</script>
