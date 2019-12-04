<div class="box">
    <div class="box-heading">สรุป/นำเข้าคะแนน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('teaching-task-base', "ตารางสอน"); ?></li>
        <li>สรุป/นำเข้าคะแนน วิชา <?php echo $course['tb_course_code'] . " " . $course['tb_subject_name'] ?></li>
    </ul>
    <div class="box-body">   
        <div class="row">
            <div class='col-md-12'>
                <div class='col-md-12' style='margin-top:20px;' id='StudentBody'>

                    <table class='table table-bordered table-hover' id='StudentTable'>
                        <thead>
                            <tr style='background: #eeeeee;'>
                                <th style='width: 5%;text-align: center;'>ที่</th>
                                <th style='width: 10%;text-align: center;'>รหัสนักเรียน</th>
                                <th style='width: 20%;text-align: center;'>ชื่อ-นามสกุล</th>
                                <th style='width: 10%;text-align: center;'>คะแนน(รายตัวชี้วัด)</th>
                                <th style='width: 15%;text-align: center;'>คะแนนปลายภาค</th>
                                <th style='width: 15%;text-align: center;'>ผลการเรียน</th>
                                <th style='text-align: center;'>&nbsp;</th>
                            </tr>
                        </thead> 
                        <tbody>
                        </tbody> 
                    </table> 

                </div>

            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php // $this->load->view("student_census/student_census_detail_modal"); ?>
<?php $this->load->view("student_score/course_score_import_modal"); ?>
<script>



    function ReloadTable() {

<?php
$tabName = "StudentTable";
$title = "รายงานสรุปคะแนนนักเรียน วิชา " . $course['tb_course_code'] . " " . $course['tb_subject_name'];
$colStr = "0,1,2,3,4,5";
$btExArr = array();
$bt = array(
    'name' => 'export_xls',
    'title' => 'รูปแบบไฟล์ Excel (.xls)',
    'icon' => 'icon-download-alt icon-large',
    'class' => 'btn btn-success btn-excel-export',
    'fn' => 'ExportTemp(this);'
);
array_push($btExArr, $bt);

$bt = array(
    'name' => 'import_xls',
    'title' => 'นำเข้าข้อมูลจากไฟล์ Excel', // (ปถ.๐๕)
    'icon' => 'icon-file icon-large',
    'class' => 'btn btn-success btn-excel-export',
    'fn' => 'ImportTemp(this);'
);
array_push($btExArr, $bt);
load_datatable($tabName, $btExArr, $title, $colStr, null, 100, true);
?>
    }


    function SelectThisStudent(e) {
        $.ajax({
            url: "<?php echo site_url('Student_census/student_census_detail'); ?>",
            method: "POST",
            data: {id: e.id},
            success: function (data) {

                $("#StudentDetailBody").html(data);
                $('#MySchoolAreaId').val("StudentDetail");
                $("h3.modal-title").text("ข้อมูลพื้นฐานของนักเรียน - " + e.id);
                $("#student-census-detail-modal").modal("show");
            }
        });
    }

    window.onload = function () {
        $.ajax({
            url: '<?php echo site_url('StudentScore/get_list'); ?>',
            method: 'post',
            data: {edyear: <?php echo $edyear ?>, edterm: <?php echo $edterm ?>, sc_id:<?php echo $sc_id ?>, id:<?php echo $course['cid'] ?>},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {

                MyEndLoading();
                if (data) {
                    $("#StudentBody").html(data);
                    ReloadTable();
                }

            }
        });
    };



    function ImportTemp(e) {
        $("#inCourseId").val(<?php echo $course['cid']; ?>);
        $("#inEdTerm").val(<?php echo $edterm; ?>);
        $("#course-import-modal").modal("show");
    }

    $('#course-import-modal').on('hide.bs.modal', function () {
        FilterCourse(this);
    });

    function ExportTemp(e) {
        e.preventDefault;

        $.ajax({
            url: '<?php echo site_url('StudentScore/ExportTemplateFull'); ?>',
            method: 'post',

            success: function (data) {
                window.open('<?php echo site_url('StudentScore/ExportTemplateFull'); ?>', '_blank');
            }
        });
    }


    function selectAll() {
//        $.ajax({
//            url: '<?php echo site_url('StudentScore/submit_all_import'); ?>',
//            method: 'post',
//            data: {edyear: <?php echo $edyear ?>,edterm: <?php echo $edterm ?>, sc_id:<?php echo $sc_id ?>, id:<?php echo $course['cid'] ?>},
//            beforeSend: function () {
//                MyStartLoading();
//            },
//            success: function (data) {
//
//                MyEndLoading();
//                location.reload();
//
//            }
//        });
        $.ajax({
            url: '<?php echo site_url('StudentScore/submit_all'); ?>',
            method: 'post',
            data: {edyear: <?php echo $edyear ?>, edterm: <?php echo $edterm ?>, sc_id:<?php echo $sc_id ?>, id:<?php echo $course['cid'] ?>},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {

                MyEndLoading();
                location.reload();

            }
        });
    }

    function select(stid) {
//    alert($('#midscore'+stid).val());
//    alert($('#finalscore'+stid).val());
//        $.ajax({
//            url: '<?php echo site_url('StudentScore/submit_import'); ?>',
//            method: 'post',
//            data: {stdid:stid,edyear: <?php echo $edyear ?>,edterm: <?php echo $edterm ?>, id:<?php echo $course['cid'] ?>},
//            beforeSend: function () {
//                MyStartLoading();
//            },
//            success: function (data) {
//
//                MyEndLoading();
//                location.reload();
//
//            }
//        });


        $.ajax({
            url: '<?php echo site_url('StudentScore/submit'); ?>',
            method: 'post',
            data: {stdid: stid, edyear: <?php echo $edyear ?>, edterm: <?php echo $edterm ?>, id:<?php echo $course['cid'] ?>, midscore: $('#midscore' + stid).val(), finalscore: $('#finalscore' + stid).val()},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {

                MyEndLoading();
                location.reload();

            }
        });
    }

</script>
