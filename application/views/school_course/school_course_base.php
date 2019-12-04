<div class="box">
    <div class="box-heading">โครงสร้างหลักสูตรสถานศึกษา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <!--<li><?php echo anchor('development-course', "สารสนเทศหลักสูตรการสอน"); ?></li>-->
        <li>โครงสร้างหลักสูตรสถานศึกษา</li>
    </ul>

    <div class="box-body">

        <?php
        $data['class'] = 'Y';
        $data['term'] = 'Y';
        $this->load->view('layout/my_school_filter', $data);
        ?>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-striped table-bordered display" id="SchoolCourseTable">                        
                    <thead>
                        <tr>
                            <th style="width:5%; text-align: center">ที่</th>
                            <th style="width:20%; text-align: center">กลุ่มสาระการเรียนรู้</th>
                            <th style="width:10%; text-align: center">รหัสวิชา</th>
                            <th style="width:15%; text-align: center">ชื่อวิชา</th>
                            <th style="width:10%; text-align: center">ระดับชั้น</th>
                            <th style="width:5%; text-align: center">หน่วยกิจ</th>
                            <th style="width:10%; text-align: center">ประเภทวิชา</th>
                            <th style="width:25%; text-align: center"></th>
                        </tr>
                    </thead>
                    <tbody id="SchoolCourseTBody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("school_course/school_course_insert_modal"); ?>
<script>
    $('#SchoolCourseTable').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
        columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
        "language": {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "zeroRecords": "## ไม่มีข้อมูล ##",
            "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "",
            "infoFiltered": "",
            "sSearch": "ระบุคำค้น",
            "sPaginationType": "full_numbers"
        }
    });

    $("div#SchoolCourseTable_length.dataTables_length").append("&nbsp;<button type=\"button\" onclick=\"InsertSchoolCourseModal()\" class=\"btn btn-primary \"><i class=\"icon-plus icon-large\"></i> เพิ่มข้อมูล</button>");

    function InsertSchoolCourseModal() {
          $("#school-course-insert-form")[0].reset();
        $('#inEdYearReadonly').val($('#MyEdYear').val());
        $('#inTermReadonly').val($('#MyTerm').val());
        $('#inClassReadonly').val($('#MyClass').val());
      
        
        $('#school-course-insert-modal').modal('show');
    }
//-------------------------------------


//    $("div#DcTable_length.dataTables_length").append("&nbsp;<button type=\"button\" onclick=\"ExportTemp(this)\" class=\"btn btn-success btn-excel-export\"><i class=\"icon-download-alt icon-large\"></i> รูปแบบasdasdไฟล์ Excel (.xls)</button>");
//    $("div#DcTable_length.dataTables_length").append("&nbsp;<button type=\"button\" onclick=\"ExportTemp(this)\" class=\"btn btn-success btn-excel-export\"><i class=\"icon-download-alt icon-large\"></i> รูปแบบไฟล์ Excel (.xls)</button>");




    var uhead = "";
    var uclss = "";
    var ulev = "";
    var ugl = "";
    var uhour = "";
    var ucredit = 0;
    var ugrouplearningname = "";

//    หน่วย
//    modal
    function unitclick(e) {
        var uid = e.id;
        uhead = $("#head" + uid).val();
        uclss = $("#cls" + uid).val();
        ulev = $("#lev" + uid).val();
        ugl = $("#gl" + uid).val();
        uhour = $("#hour" + uid).val();
        ugrouplearningname = $("#grouplearningname" + uid).val();

        $.ajax({
            url: "<?php echo site_url('Dc/get_unit_list'); ?>",
            method: "post",
            data: {id: uid},
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                $("#insertID").val(uid);
                $("#Cls").val(uclss);
                $("#Lev").val(ulev);
                $("h3.modal-title").text("การจัดการหน่วยการเรียนรู้");
                $("#dc-unit-modal").modal("show");
                $('#UnitListBody').html(data);
                $("#HeadUnit").html("การจัดการหน่วย ประจำวิชา : " + uhead + " | ระดับชั้น" + uclss + " ปีที่ " + ulev);
            }
        });
    }

    var CourseId = 0;
    // จุดประสงค์การเรียนรู้ modal
    function purposeclick(e) {
//        CourseId = e.id;
//        $.ajax({
//            url: "<?php echo site_url('Dc/get_course_purpose_list'); ?>",
//            method: "post",
//            data: {id: CourseId},
//            beforeSend: function () {                MyStartLoading();            },            success: function (data) {                MyEndLoading();
        $("h3.modal-title").text("การจัดการรายละเอียดจุดประสงค์การเรียนรู้");
        $("#dc-purpose-modal").modal("show");
        $('#CoursePurposeListBody').html(data);
        $("#HeadStand").html("การจัดการตัวชี้วัด ประจำวิชา : " + uhead + " | ระดับชั้น" + uclss + " ปีที่ " + ulev);
//            }
//        });
    }
    ;

    // ตัวชี้วัด modal
    function standardclick(e) {
        var uid = e.id;
        uhead = $("#head" + uid).val();
        uclss = $("#cls" + uid).val();
        ulev = $("#lev" + uid).val();
        ugl = $("#gl" + uid).val();

        $.ajax({
            url: "<?php echo site_url('Dc/get_standard_unit'); ?>",
            method: "post",
            data: {id: ugl, cls: uclss, lev: ulev},
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                $("h3.modal-title").text("การจัดการรายละเอียดตัวชี้วัด");
                $("#dc-standard-score-modal").modal("show");
                $('#standard-score').html(data);
                $("#HeadStand").html("การจัดการตัวชี้วัด ประจำวิชา : " + uhead + " | ระดับชั้น" + uclss + " ปีที่ " + ulev);
            }
        });
    }
    ;

    // สรุป modal 
    function resultclick(e) {
        var uid = e.id;

        uhour = $("#hour" + uid).val();


        if (uclss = "ประถมศึกษา") {
            ucredit = uhour / 20
        } else {
            ucredit = uhour / 40
        }

        $.ajax({
            url: "<?php echo site_url('Dc/get_result'); ?>",
            method: "post",
            data: {id: uid},
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                $('#MySchoolAreaId').val("PrintThisResult");
                $("h3.modal-title").text("สรุปโครงสร้างรายวิชา");
                $("#dc-result-modal").modal("show");
                $('#ResultBody').html(data);
                uhead = $("#head" + uid).val();
                uclss = $("#cls" + uid).val();
                ulev = $("#lev" + uid).val();
                ugl = $("#gl" + uid).val();
                $("#HeadResult").html("สรุปโครงสร้างรายวิชา ประจำวิชา : " + uhead + " | ระดับชั้น" + uclss + " ปีที่" + ulev + "<b> เวลาเรียน</b> " + uhour + " ชั่วโมง/ภาคเรียน" + " จำนวน " + ucredit + " หน่วยกิต");
            }
        });
    }
    ;

    function DeleteThisCourse(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Dc/delete_course_by_id'); ?>',
                method: 'post',
                data: {id: e.id},
                success: function (data) {
                    FilterCourse(e);
                }
            });
        }
    }
    function EditThisCourse(e) {
//    alert('NE !')
        $.ajax({
            url: "<?php echo site_url('Dc/edit_course_by_id'); ?>",
            method: "post",
            data: {id: e.id},
            dataType: "json",
            success: function (data) {


                $("#inCourseId").val(data.id);
//                $("#inGroupLearningcolName").val(data.km_name);
//                $("#inSubject").val(data.tb_subject_id);
                $("#inCourseCode").val(data.tb_course_code);
                $("#inCourseHourWeek").val(data.tb_course_hour_week);
                $("#inCourseHourTerm").val(data.tb_course_hour_term);
                $("#inCourseCredit").val(data.tb_course_credit);
                $("#inCourseCreditSp").val(data.tb_course_credit_sp);
                $("#inCourseMidScore").val(data.tb_course_mid_score);
                $("#inCourseFinalScore").val(data.tb_course_final_score);
                //
                $("#course-insert-modal").modal("show");
            }
        });
    }

    function ExportTemp(e) {
        e.preventDefault;
        var tmp = "tb_course";
        $.ajax({
            url: '<?php echo site_url('CourseImport/ExportTemplateFull'); ?>',
            method: 'post',
            data: {'tableName': tmp},
            success: function (data) {
                window.open('<?php echo site_url('CourseImport/ExportTemplateFull'); ?>', '_blank');
            }
        });
    }

    function ImportTemp(e) {

        if ($("#MyClass").val() != "") {
            $("#inStdClass").val($("#MyClass").val());

            $("#course-import-modal").modal("show");
        }
    }

    $('#course-import-modal').on('hide.bs.modal', function () {
        FilterCourse(this);
    });
</script>

