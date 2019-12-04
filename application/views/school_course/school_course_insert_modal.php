<!-- Modal -->
<div id="school-course-insert-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?>
            <div class="modal-body" style="padding:30px;">

                <form method="post" id="school-course-insert-form" enctype="multipart/form-data">
                    <div class='row'>
                        <div class='col-md-12'>

                            <div class="col-md-2 form-group">
                                <label class="control-label">หลักสูตร</label>
                                <select name="inGroupLearningYear" id="inGroupLearningYear" class="form-control" onchange="GetGroupLearningList(this)">
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="2551">2551</option>
                                    <option value="2561">2561</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">กลุ่มสาระการเรียนรู้</label>
                                <select name="inGroupLearning" id="inGroupLearning" class="form-control" onchange="GenCourseCode(this)" required>
                                    <option value="">---เลือกข้อมูล---</option>
                                    <?php foreach ($row as $rs): ?>
                                        <option value="<?php echo $rs['id']; ?>"><?php echo $rs['tb_group_learning_name']; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                            </div>
                            <div class="col-md-3 form-group">                            
                                <label class="control-label">ชื่อวิชา</label>
                                <input type="text" name="inCourseSubjectName" id="inCourseSubjectName" class="form-control" required/>
                            </div>       
                            <div class="col-md-2 form-group">
                                <label class="control-label">ประเภทวิชา</label>
                                <select name="inCourseSubjectType" id="inCourseSubjectType" class="form-control" onchange="GenCourseCode(this)" required>
                                    <option value="">---เลือกข้อมูล---</option>
                                    <?php
                                    $output = "";
                                    foreach ($SubjectTypeList as $r) {
                                        $output .= "<option value='" . $r['tb_subject_type_name'] . "'>" . $r['tb_subject_type_name'] . "</option>";
                                    }
                                    echo $output;
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 form-group" id="MySubjectCode">
                                <label class="control-label">รหัสวิชา</label>
                                <input type="text" name="inCourseCode" id="inCourseCode" class="form-control" required/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">คะแนนเก็บ</label>
                                <input type="text" value=70 name="inCourseMidScore" id="inCourseMidScore" class="form-control" onchange="myCalScore(this)" required/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">คะแนนสอบ</label>
                                <input type="text" value=30 name="inCourseFinalScore" id="inCourseFinalScore" class="form-control" onchange="myCalScore(this)" required/>
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="control-label">กำหนดหน่วยกิต</label>
                                <?php
                                $output = "";
                                foreach ($EdPlanList as $plan) {
                                    $output .= "<div class='col-md-4 form-group' >";
                                    $output .= "<div class='input-group'>";

                                    $output .= "<div class='input-group-btn'>";
                                    $output .= "<button type='buttom' class='btn btn-secondary'>" . $plan['tb_ed_plan'] . "</button>";
                                    $output .= "</div>";
                                    $output .= "<input class='form-control' type='text' value='' />";
                                    $output .= "</div>";
                                    $output .= "</div>";
                                }
                                echo $output;
                                ?> 
                            </div>


                            <!--                            <div class="col-md-3 form-group">
                                                            <label class="control-label">จำนวนชั่วโมงต่อสัปดาห์</label>
                                                            <select name="inCourseHourWeek" id="inCourseHourWeek" class="form-control" required>
                                                                <option value="">---เลือกข้อมูล---</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                            </select>
                                                        </div>-->

                        </div>
                    </div>
                    <input type="text" name="inCourseId" id="inCourseId" readonly/>
                    <input type="text" name='inEdYearReadonly' id='inEdYearReadonly'  readonly/>   
                    <input type="text" name='inTermReadonly' id='inTermReadonly'  readonly/>                      
                    <input type="text" name='inClassReadonly' id='inClassReadonly'   readonly/>                                                       
                    <div class="row">
                        <center><button type="button" onclick='InsertCourse()' class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function GetGroupLearningList(e) {
        $.ajax({
            url: "<?php echo site_url('School_course/get_grouplearning_list'); ?>",
            method: "post",
            data: {year: e.value},
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                $('#inGroupLearning').html(data);
            }
        });
    }

    function GenCourseCode(e) {
        $('#inCourseCode').val("");
//        var sid = $('#inSubject').val();
//        var cid = $('#MyClass').val();


        $.ajax({
            url: "<?php echo site_url('School_course/gen_course_code'); ?>",
            method: "post",
            data: {grouplearning_id: $('#inGroupLearning').val(), class_id: $('#MyClass').val()},
            dataType: "json",
            success: function (data) {
                $('#inCourseCode').val(data);
            }
        });
    }

    function myCalScore(e) {

        if ($('#inCourseMidScore').val() <= 100 && $('#inCourseFinalScore').val() <= 100) {
            if (e.id == "inCourseMidScore") {
                $('#inCourseFinalScore').val(100 - $('#inCourseMidScore').val());
            } else {
                $('#inCourseMidScore').val(100 - $('#inCourseFinalScore').val());
            }
        } else {
            alert("คุณกำหนดคะแนนเกินกว่ากำหนด");
        }
    }

    function InsertCourse() {
        $.ajax({
            url: "<?php echo site_url('School_course/school_course_insert'); ?>",
            method: "post",
            data: new FormData($("#school-course-insert-form")[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
//                FilterCourse();
//                $("#insert-form")[0].reset();
//                location.reload();
            }
        });
    }

</script>