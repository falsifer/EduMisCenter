<div class="box">
    <div class="box-heading">พัฒนาหลักสูตร</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('development-course', "สารสนเทศหลักสูตรการสอน"); ?></li>
        <li><?php echo anchor('dc-base-setting', "โครงสร้างหลักสูตรสถานศึกษา/แผนการสอน"); ?></li>
        <li>พัฒนาหลักสูตร</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <b>ข้อมูลรายวิชา</b>
                        <br/>
                    </div>
                    <div class="col-md-12 form-group">
                        <?php
                        $data['class'] = 'Y';
                        $data['term'] = 'Y';
                        $this->load->view('layout/my_school_filter', $data);
                        ?>
                    </div>

                    <div class="col-md-5 form-group">
                        <label class="control-label">กลุ่มสาระการเรียนรู้</label>
                        <select name="inGroupLearningName" id="inGroupLearningName" class="form-control" required>
                            <option value="">---เลือกข้อมูล---</option>
                            <?php foreach ($row as $rs): ?>
                                <option value="<?php echo $rs['id']; ?>">หลักสูตร(<?php echo $rs['ed_year']; ?>) - <?php echo $rs['tb_group_learningcol_name']; ?></option>
                            <?php endforeach; ?>  
                        </select>
                    </div>

                    <div class="col-md-4 form-group">                            
                        <label class="control-label">วิชา</label>
                        <!--<button type="button" class="btn btn-link btn-addsubject" id="addsubject">(คลิกเพื่อเพิ่มวิชา....)</button>-->
                        <input type="text" name="inSubjectName" id="inSubjectName" class="form-control" required/>
                    </div>     

                    <div class="col-md-3 form-group" id="MySubjectCode">
                        <label class="control-label">รหัสวิชา</label>
                        <input type="text" name="inCourseCode" id="inCourseCode" class="form-control" required/>
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">ประเภทวิชา</label>
                        <select name="inSubjectType" id="inSubjectType" class="form-control" required="">
                            <option value="">--เลือกข้อมูล--</option>
                            <?php foreach ($sjtype as $r): ?>
                                <option value="<?php echo $r['tb_subject_type_name']; ?>"><?php echo $r['tb_subject_type_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="col-md-3 form-group">
                        <label class="control-label">จำนวนชั่วโมงต่อสัปดาห์</label>
                        <input type="number" name="inCourseHourWeek" id="inCourseHourWeek" class="form-control" required/>
                    </div>




                    <div class="col-md-3 form-group">
                        <label class="control-label">คะแนนระหว่างภาค</label>
                        <input type="number" value=70 name="inCourseMidScore" id="inCourseMidScore" class="form-control" onchange="myCalScore(this)" required/>
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">คะแนนปลายภาค</label>
                        <input type="number" value=30 name="inCourseFinalScore" id="inCourseFinalScore" class="form-control" onchange="myCalScore(this)" required/>
                    </div>
                    <div class="col-md-3 form-group">
                        <!--<label class="control-label">จำนวนชั่วโมงต่อภาคเรียน</label>-->
                        <input type="hidden" name="inCourseHourTerm" id="inCourseHourTerm" class="form-control" required/>
                    </div>
                    <div class="col-md-3 form-group">
                        <!--<label class="control-label">จำนวนหน่วยกิต</label>-->
                        <input type="hidden" name="inCourseCredit" id="inCourseCredit" class="form-control" required/>
                    </div>
                    <div class="col-md-3 form-group">
                        <!--<label class="control-label">จำนวนหน่วยกิต(ห้องพิเศษ)</label>-->
                        <input type="hidden" name="inCourseCreditSp" id="inCourseCreditSp" class="form-control" required/>
                    </div>
                    <div class="col-md-12 form-group">
                        <center><button type="button" onclick='Insert()' class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>



<script>

    function MyEdTest(e) {
        GenCode(e);
        GenTime();
    }


    function GenCode(e) {
//        $('#inCourseCode').val("");
//        var gid = $('#inGroupLearningcolName').val();
//        var cid = $('#MyClass').val();
//        $.ajax({
//            url: "<?php echo site_url('Dc/gen_subject_code'); ?>",
//            method: "post",
//            data: {gid: gid, cid: cid},
//            dataType: "json",
//            success: function (data) {
//
//                $('#inCourseCode').val(data);
//            }
//        });
    }

    function GenTime() {

        var cid = $('#MyClass').val();
        var credit = $('#inCourseHourWeek').val();
        $.ajax({
            url: "<?php echo site_url('Dc/get_class_id'); ?>",
            method: "post",
            data: {id: cid},
            dataType: "json",
            success: function (data) {
                if (data.tb_ed_school_class_name != 'มัธยมศึกษา') {
                    inCourseCredit.value = credit;
                    inCourseCreditSp.value = credit;
                    inCourseHourTerm.value = credit * 20;

                } else {
                    inCourseCredit.value = credit / 2;
                    inCourseCreditSp.value = credit / 2;
                    inCourseHourTerm.value = credit * 20;
                }
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

    $('#inCourseHourWeek').change(function () {
        GenTime();
    });


    $(".btn-addsubject").on("click", function () {
        $("#inGroupLearningName").val($("#inGroupLearningcolName").val());
        GlCode();
        $("#dc-modal").modal("show");
    });


    function Insert() {
//        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('Dc/dc_insert'); ?>",
            method: "post",
            data: new FormData($("#insert-form")[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
//                $("#insert-form")[0].reset();
//                location.reload();
            }
        });
    }





</script>
<?php $this->load->view("dc/dc_modal"); ?>