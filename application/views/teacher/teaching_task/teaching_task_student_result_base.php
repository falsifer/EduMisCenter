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
    <div class="box-heading">บันทึกผลการพัฒนาคุณภาพผู้เรียนรายวิชา (<?php echo $course['tb_subject_name'] . " - " . $course['tb_course_code'] ?>)</div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('teaching-task-base', "งานครูผู้สอน"); ?></li>
        <!--<li><?php echo anchor('teaching-task-development', "การจัดการวิชา"); ?></li>-->
        <li><?php echo $course['tb_subject_name'] . " - " . $course['tb_course_code'] ?></li>
    </ul>
    <div class="box-body">
        <input type='hidden' id='inMyCourse' name='inMyCourse' value='<?php echo $this->input->get("course_id") ?>'/>
        <input type='hidden' id='inMyRoom' name='inMyRoom' value='<?php echo $this->input->get("room_id") ?>'/>

        <div class='row'>

            <?php
            $this->load->view('layout/my_school_logo');
            ?> 

            <div class='col-md-9'>
                <table class='table table-bordered table-hover' id='MyTable'>
                    <thead>
                        <tr style='background: #eeeeee;'>
                            <th style='width: 10%;text-align: center;' rowspan='3'>จำนวนนักเรียนทั้งหมด</th>  
                            <th style='width: 80%;text-align: center;' colspan='8'>สรุปผลการเรียน</th>
                            <th style='width: 10%;text-align: center;' rowspan='3'>หมายเหตุ</th>  
                        </tr>
                        <tr style='background: #eeeeee;'>
                            <th style='width: 100%;text-align: center;' colspan='8'>จำนวนนักเรียนที่ได้ผลการเรียน</th>
                        </tr>
                        <tr style='background: #eeeeee;'>
                            <th style='text-align: center;width: 10%;'>4</th>
                            <?php for ($i = 1; $i <= 6; $i++) { ?>

                                <th style='text-align: center;width: 10%;'><?php echo 4 - ($i * 0.5) ?></th>
                            <?php } ?>
                            <th style='text-align: center;width: 10%;'>0</th>
                        </tr>
                    </thead> 
                    <tbody id='MyTBody'>
                        <tr >
                            <td style='text-align: center;'>1</td>  
                            <td style='text-align: center;'>1</td>  
                            <td style='text-align: center;'>0</td>  
                            <td style='text-align: center;'>0</td>  
                            <td style='text-align: center;'>0</td>  
                            <td style='text-align: center;'>0</td>  
                            <td style='text-align: center;'>0</td>  
                            <td style='text-align: center;'>0</td> 
                            <td style='text-align: center;'>0</td>  
                            <td style='text-align: center;'></td> 
                        </tr>
                    </tbody> 
                </table> 

                <table class='table table-bordered table-hover' style='margin-top:20px;' id='MyTable'>
                    <thead>
                        <tr style='background: #eeeeee;'>
                            <th style='width: 5%;text-align: center;'>ที่</th>  
                            <th style='width: 15%;text-align: center;'>รหัสนักเรียน</th>
                            <th style='width: 20%;text-align: center;'>ชื่อนามสกุล</th>                            
                            <th style='width: 10%;text-align: center;'>คะแนนระหว่างภาค</th>                            
                            <th style='width: 10%;text-align: center;'>คะแนนสอบปลายภาค</th>
                            <th style='width: 10%;text-align: center;'>ตลอดภาคเรียน</th>                            
                            <th style='width: 10%;text-align: center;'>ผลการเรียนเฉลี่ย</th>
                            <th style='width: 20%;text-align: center;'>สถานะ</th>
                        </tr>
                    </thead> 
                    <tbody id='MyTBody'>
                        <tr >
                            <td style='text-align: center;'>1</td>  
                            <td style='text-align: center;'>44698</td>  
                            <td style='text-align: center;'>นายชัยรัธฐา อ่วมอารีย์</td>  
                            <td style='text-align: center;'>70</td>  
                            <td style='text-align: center;'>30</td>  
                            <td style='text-align: center;'>100</td>  
                            <td style='text-align: center;'>4.0</td>  
                            <td style='text-align: center;'>ผ่าน</td>  
                        </tr>
                    </tbody> 
                </table> 
            </div>
            <div class='col-md-3'>
                <div class="panel panel-primary">
                    <div class="panel-heading"  id='PanelHeader'>
                        <center>
                            เมนูการทำงาน 
                        </center>                       

                    </div>
                    <div class="panel-body">
                        <button type='button' class='btn btn-primary My-btn' id='teaching-task-work-assignment-base' onclick='CoursePortal(this)'>
                            <i class="icon-check icon-large"></i> การติดตามงาน
                        </button>
                        <br/>
                        <button type='button' class='btn btn-primary My-btn' id='pp5-fill-score' onclick='CoursePortal(this)'>
                            <i class="icon-check icon-large"></i> ผลการพัฒนาคุณภาพผู้เรียน
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
                        <button type='button' class='btn btn-primary My-btn' id='teaching-task-stat-print-base' onclick='CoursePortal(this)'>
                            <i class="icon-search icon-large"></i> รายงานและสถิติ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<script>
    function CoursePortal(e) {
        var course_id = $("#inMyCourse").val();
        var room_id = $("#inMyRoom").val();

        switch (e.id) {
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
            case "teaching-task-stat-print-base":
                location.href = '<?php echo site_url('teaching-task-stat-print-base'); ?>?course_id=' + course_id + '&room_id=' + room_id;
                break;
        }

    }
</script>