<div class="box">
    <div class="box-heading">บันทึกเวลามาเรียนรายวิชา (<?php echo $this->session->userdata('name') ?>)

    </div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('teaching-task-base', "งานครูผู้สอน"); ?></li>
        <li><?php echo anchor('course-student-result-base?course_id=' . $this->input->get("course_id") . '&room_id=' . $this->input->get("room_id"), $course['tb_subject_name'] . " - " . $course['tb_course_code']) ?></li>
        <li>บันทึกเวลามาเรียนรายวิชา</li>
    </ul>
    <div class="box-body" >

        <input type='hidden' id='inRoomId' name='inRoomId' value='<?php echo $this->input->get("room_id") ?>'/>
        <input type='hidden' id='inCourseId' name='inCourseId' value='<?php echo $this->input->get("course_id") ?>'/>
        <div class='row'>
            <div class='col-md-12' style='margin-top:25px;overflow: auto;' id="MyBody">
                <!--<div class='col-md-9'>-->
                <table class='table table-bordered table-hover' id='MyTable'>
                    <thead>
                        <tr style='background: #eeeeee;'>
                            <th style='width: 5%;text-align: center;'>ที่</th>  
                            <th style='width: 15%;text-align: center;'>รหัสนักเรียน</th>
                            <th style='width: 20%;text-align: center;' class='hidden-xs'>ชื่อ-นามสกุล</th> 
                            <?php for ($i = 1; $i <= 40; $i++) { ?>
                                <th style='text-align: center;'><?php echo $i ?></th>
                                <?php
                            }
                            ?>
                        </tr>
                    </thead> 
                    <tbody id='MyTBody'>
                        <tr >
                            <td style='text-align: center;'>1</td>  
                            <td style='text-align: center;'>44698</td>  
                            <td style='text-align: center;'>นายชัยรัธฐา อ่วมอารีย์</td>  
                            <?php for ($i = 1; $i <= 40; $i++) { ?>
                                <td >
                                    <select >
                                        <option >-</option>
                                        <option >มา</option>
                                        <option >ขาด</option>
                                        <option >ป่วย</option>
                                        <option >ลากิจ</option>
                                        <option >อื่นๆ</option>
                                    </select>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                    </tbody> 
                </table> 
                <!--</div>-->
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view('teacher/teaching_task/teaching_task_work_assignment_modal'); ?>
<script>

</script>