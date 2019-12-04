<!-- Modal -->
<div id="course-insert-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="course-insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <b>ข้อมูลรายวิชา</b>
                            <br/>
                        </div>
                        <div class="row">
                            <?php
//                            $data['class'] = 'Y';
//                            $data['term'] = 'Y';
//                            $this->load->view('layout/my_school_filter', $data);
                            ?>
                            <!--                            <div class="col-md-4 form-group">
                                                            <label class="control-label">กลุ่มสาระการเรียนรู้</label>
                                                            <select name="inGroupLearningcolName" id="inGroupLearningcolName" class="form-control" onchange="GenSubjectList(this)" required>
                                                                <option value="">---เลือกข้อมูล---</option>
                            <?php foreach ($row as $rs): ?>
                                                                            <option value="<?php echo $rs['id']; ?>"><?php echo $rs['tb_group_learningcol_name']; ?></option>
                            <?php endforeach; ?>  
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 form-group">                            
                                                            <label class="control-label">วิชา</label>
                                                            <button type="button" class="btn btn-link btn-addsubject" id="addsubject">(คลิกเพื่อเพิ่มวิชา....)</button>
                                                            <select name="inSubject" id="inSubject" class="form-control" onchange="GenCode(this)" required>
                                                                <option value="">---เลือกข้อมูล---</option>          
                                                            </select>
                                                        </div>-->


                        </div>


                        <div class="row">
                            <div class="col-md-3 form-group" id="MySubjectCode">
                                <label class="control-label">รหัสวิชา</label>
                                <input type="text" name="inCourseCode" id="inCourseCode" class="form-control" required/>
                            </div>
                            <div class="col-md-3 form-group">
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
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">ชั่วโมงต่อภาคเรียน</label>
                                <input type="text" name="inCourseHourTerm" id="inCourseHourTerm" class="form-control" required/>
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">หน่วยกิต</label>
                                <input type="text" name="inCourseCredit" id="inCourseCredit" class="form-control" required/>
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">หน่วยกิต(ห้องพิเศษ)</label>
                                <input type="text" name="inCourseCreditSp" id="inCourseCreditSp" class="form-control" required/>
                            </div>

                        </div>
                        <!--                    <div class="row">
                                                <div class="row">
                                                    <b>เลือกผู้รับผิดชอบ</b>
                                                    <br></br>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label class="control-label">เลือกผู้รับผิดชอบ</label>
                                                    <button type="button" class="btn btn-link btn-addsubject" id="addsubject">(ดูรายชื่อครูทั้งหมด....)</button>
                                                    <select name="inHrthainame" id="inHrthainame" class="form-control">
                                                        <option value="">---เลือกข้อมูล---</option>
                        <?php foreach ($row as $rs): ?>
                                                                                                                                                                                                                            <option value="<?php echo $rs['id']; ?>"><?php echo $rs['hr_thai_symbol']; ?><?php echo $rs['hr_thai_name']; ?>  <?php echo $rs['hr_thai_lastname']; ?></option>
                        <?php endforeach; ?>  
                                                    </select>
                                                </div>
                                            </div>-->
                        <div class="row">
                            <div class="row">
                                <b>ตั้งค่าคะแนนเต็ม</b>
                                <br></br>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">คะแนนระหว่างภาค</label>
                                <input type="text" value=70 name="inCourseMidScore" id="inCourseMidScore" class="form-control" onchange="myCalScore(this)" required/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">คะแนนปลายภาค</label>
                                <input type="text" value=30 name="inCourseFinalScore" id="inCourseFinalScore" class="form-control" onchange="myCalScore(this)" required/>
                            </div>
                        </div>
                        <input type="hidden" id='inCourseId' name='inCourseId' value=''/>
                        <div class="row">
                            <center><button type="button" onclick='InsertCourse()' class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function InsertCourse() {
        $.ajax({
            url: "<?php echo site_url('Dc/course_insert'); ?>",
            method: "post",
            data: new FormData($("#course-insert-form")[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                FilterCourse();
//                $("#insert-form")[0].reset();
//                location.reload();
            }
        });
    }

</script>