<div class="box">
    <div class="box-heading">การรายงานผลการปฏิบัติงาน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>

        <li>การรายงานผลการปฏิบัติงาน</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <b>การรายงานผลการปฏิบัติงาน</b>
                        <br></br>
                    </div>
                    <table class="table table-hover table-striped table-bordered display" id="example">
                        <thead>
                            <tr>
                                <th style="width:40px;">เลขที่</th>
                                <th style="width:100px;" class="no-sort">ชื่อนาม - สกุล</th>    
                                <?php foreach ($rs as $r): ?>
                                    <th style="width:20px;" class="no-sort"><?php echo $r['tb_standard_learning_code']; ?> <?php echo $r['tb_kpi_standard_learning_level']; ?></th> 
                                <?php endforeach; ?>
                                <th style="width:100px;" class="no-sort"></th>    
                            </tr>
                        </thead>
                        <tbody>

                            <?php $row = 1; ?>
                            <?php foreach ($std as $r): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row; ?></td>
                                    <td style="text-align: center;"><?php echo $r['hr_thai_symbol']; ?><?php echo $r['hr_thai_name']; ?> <?php echo $r['hr_thai_lastname']; ?></td>

                                    <?php foreach ($rs as $rr): ?>
                                        <td style="text-align:center;">
                                            <input type="Checkbox"  size="1" name="inCourseMidScore" id="inCourseMidScore" class="form-control" />
                                        </td>
                                    <?php endforeach; ?>
                                    <td style="text-align: center;"><button type="button" class="btn btn-success btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-plus icon-large"></i> บันทึก</button>
                               </td>
                                </tr>
                                <?php $row++; ?>
                            <?php endforeach; ?>


                        </tbody>
                    </table>

                    <div class="row">
                        <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>



<script>
    $('#example').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": true,
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

    $('#inGroupLearningcolName').change(function () {
        var subject = $('#inGroupLearningcolName').val();
        if (subject != '') {
            $.ajax({
                url: "<?php echo site_url('Dc/member'); ?>",
                method: "post",
                data: {subject: subject},
                success: function (data) {
                    $('#inSubject').html(data);
                }
            });
        }
    });

    //sssssssssssssssssssssssssssssssssssssssssssssssssssssss

    $('#inCourseLev').change(function () {
        var checkgroup = $('#inGroupLearningcolName').val();
        var checksubject = $('#inSubject').val();
        var checkclass = $('#inCourseClass').val();
        var checklev = $('#inCourseLev').val();

        if (checkclass != "" || checklev != "") {

            var s1 = "A";
            var s2 = "B";
            var s3 = "C";
            var s4 = "D";
            var s5 = "E";
            var s6 = "F";


            // start first code 
            var code = $('#inSubject').val();
            if (code != '') {
                $.ajax({
                    url: "<?php echo site_url('Dc/sj_code'); ?>",
                    method: "post",
                    data: {id: code},
                    dataType: "json",
                    success: function (data) {
                        s1 = data.tb_subject_abbreviation;

                    }
                });
            }
            // end first code 

            // start second and third  code 
            var clss = $('#inCourseClass').val();
            var lev = $('#inCourseLev').val();

            if (clss != "มัธยมศึกษา") {
                s2 = "1";
                s3 = $('#inCourseLev').val();
            } else {
                switch (lev) {
                    case "1":
                        s2 = "2";
                        s3 = "1";
                        break;
                    case "2":
                        s2 = "2";
                        s3 = "2";
                        break;
                    case "3":
                        s2 = "2";
                        s3 = "3";
                        break;
                    case "4":
                        s2 = "3";
                        s3 = "1";
                        break;
                    case "5":
                        s2 = "3";
                        s3 = "2";
                        break;
                    case "6":
                        s2 = "3";
                        s3 = "3";
                        break;
                }
            }
            // end second and third code 


            // start fourth code 
            var sjtype = "G";
            var scode = $('#inSubject').val();
            if (scode != '') {
                $.ajax({
                    url: "<?php echo site_url('Dc/sj_code'); ?>",
                    method: "post",
                    data: {id: scode},
                    dataType: "json",
                    success: function (data) {
                        sjtype = data.tb_subject_type;
                        switch (sjtype) {
                            case "พื้นฐาน":
                                s4 = "1";
                                break;
                            case "เพิ่มเติม":
                                s4 = "2";
                                break;
                        }
                    }
                });
            }
            // end fourth code 

            // start fifth and Sixth code 

            var scode = $('#inSubject').val();
            if (scode != '') {
                $.ajax({
                    url: "<?php echo site_url('Dc/sj_count'); ?>",
                    method: "post",
                    data: {id: scode},
                    dataType: "json",
                    success: function (data) {
                        var getint = data + 1;
                        if (getint <= 9) {
                            s5 = "0";
                            s6 = getint;
                            $('#inCourseCode').val(s1 + s2 + s3 + s4 + s5 + s6);
                        } else {
                            alert("9");
                            s5 = getint;
                            $('#inCourseCode').val(s1 + s2 + s3 + s4 + s5);
                        }
                    }
                });
            }
            // end fifth and Sixth code         
        }
    });


    $('#inCourseHourWeek').change(function () {
        var clss = $('#inCourseClass').val();
        var credit = $('#inCourseHourWeek').val();
        if (clss != 'มัธยมศึกษา') {
            inCourseCredit.value = credit;
            inCourseCreditSp.value = credit;
            inCourseHourTerm.value = credit * 20;

        } else {
            inCourseCredit.value = credit / 2;
            inCourseCreditSp.value = credit / 2;
            inCourseHourTerm.value = credit * 20;
        }
    });

    $('#inCourseClass').change(function () {
        var clss = $('#inCourseClass').val();
        var credit = $('#inCourseHourWeek').val();
        if (clss != 'มัธยมศึกษา') {
            inCourseCredit.value = credit;
            inCourseCreditSp.value = credit;
            inCourseHourTerm.value = credit * 20;

        } else {
            inCourseCredit.value = credit / 2;
            inCourseCreditSp.value = credit / 2;
            inCourseHourTerm.value = credit * 20;
        }
    });

    $(".btn-addsubject").on("click", function () {
        $("#dc-modal").modal("show");
    });


    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //

        $.ajax({
            url: "<?php echo site_url('Dc/dc_insert'); ?>",
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
<?php $this->load->view("dc/dc_modal"); ?>