<div class="box">
    <div class="box-heading">งานแผนการสอน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('development-course', "สารสนเทศหลักสูตรการสอน"); ?></li>
        <li>การจัดการแผนการสอน</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="row">
                            <b>เลือกระดับชั้นและวิชา</b>
                            <br></br>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ระดับชั้น</label>
                            <select name="inCourseClass" id="inCourseClass" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                                <option value="อนุบาล">อนุบาล</option>
                                <option value="ประถมศึกษา">ประถมศึกษา</option>
                                <option value="มัธยมศึกษา">มัธยมศึกษา</option>
                            </select>
                        </div>
                        <div class="col-md-1 form-group">
                            <label class="control-label">ชั้นปี</label>
                            <select name="inCourseLev" id="inCourseLev" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">                            
                            <label class="control-label">วิชา</label>
                            <select name="inSubject" id="inSubject" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>          
                            </select>
                        </div>
                    </div>
                    <div class="row">
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
                    </div>
                    <div class="row">
                        <div class="row">
                            <b>ตั้งค่าคะแนนเต็ม</b>
                            <br></br>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">คะแนนระหว่างภาค</label>
                            <input type="text" value=70 name="inCourseMidScore" id="inCourseMidScore" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">คะแนนปลายภาค</label>
                            <input type="text" value=30 name="inCourseFinalScore" id="inCourseFinalScore" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                    </div>

                    <div class="row">
                        <b>แผนการสอนในระบบ</b>
                        <br></br>
                    </div>
                    <table class="table table-hover table-striped table-bordered display" id="example">
                        <thead>
                            <tr>
                                <th style="width:40px;">ที่</th>
                                <th class="sorting">กลุ่มสาระการเรียนรู้</th>
                                <th class="sorting">วิชา/รหัสวิชา</th>
                                <th class="sorting">ระดับชั้น</th>
                                <th class="sorting">ชื่อผู้รับผิดชอบ</th>
                                <th class="no-sort">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $row = 1; ?>
                            <?php foreach ($rscourse as $r): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row; ?></td>
                                    <td style="text-align: center;"><?php echo $r['tb_group_learningcol_name']; ?></td>
                                    <td style="text-align: center;"><?php echo $r['tb_subject_name']; ?> | <?php echo $r['tb_course_code']; ?></td>
                                    <td style="text-align: center;">ชั้น<?php echo $r['tb_course_class']; ?>ปีที่ <?php echo $r['tb_course_lev']; ?></td>
                                    <td style="text-align: center;"><?php echo $r['hr_thai_symbol']; ?><?php echo $r['hr_thai_name']; ?> <?php echo $r['hr_thai_lastname']; ?></td>

                                    <td style="text-align:center;">
                                        <button type="button" class="btn btn-info btn-edit" id="<?php echo $r['aid']; ?>"><i class="icon-gear icon-large"></i> จัดการ</button>
                                    </td>

                                </tr>
                                <?php $row++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<?php $this->load->view("ep/ep_modal"); ?>
<script>

    // edit 
    $("#example").on("click", ".btn-edit", function () {

        var inclss = "ประถมศึกษา";
        var inlev = "1";
        $.ajax({
            url: "<?php echo site_url('Ep/ep_edit'); ?>",
            method: "post",
            data: {clss: inclss, lev: inlev},
            dataType: "json",
            success: function (data) {

                //------------------------------------------------//
                $("h3.modal-title").text("จัดการข้อมูล");
                $("#ep-modal").modal("show");
            }
        });
    });


    $('#inCourseLev').change(function () {
        var clss = $('#inCourseClass').val();
        var lev = $('#inCourseLev').val();
        if (clss != '') {
            $.ajax({
                url: "<?php echo site_url('Ep/subject_member'); ?>",
                method: "post",
                data: {inclss: clss, inlev: lev},
                success: function (data) {
                    $('#inSubject').html(data);
                }
            });
        }
    });

    $('#inCourseClass').change(function () {
        var clss = $('#inCourseClass').val();
        var lev = $('#inCourseLev').val();
        if (clss != '') {
            $.ajax({
                url: "<?php echo site_url('Ep/subject_member'); ?>",
                method: "post",
                data: {inclss: clss, inlev: lev},
                success: function (data) {
                    $('#inSubject').html(data);
                }
            });
        }
    });

    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //

        $.ajax({
            url: "<?php echo site_url('Ep/ep_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });

</script>

