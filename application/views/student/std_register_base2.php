<div class="box">
    <div class="box-heading">การรับนักเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>

        <li>การรับนักเรียน</li>
    </ul>
    <div class="box-body">


        <form method="post" id="student-register-insert-form" enctype="multipart/form-data">
            <?php
            $data['class'] = 'Y';
            $data['room'] = 'Y';
            $data['term'] = 'Y';
            $this->load->view('layout/my_school_filter', $data);
            ?>
            <div class="row" id="StudentRegisterBody">

                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-body" id="StudentWaitingBody">
                            <!--<button type="button" class="btn btn-default btn-register-insert-modal"><i class="icon-plus icon-large"></i> เพิ่มข้อมูล</button>-->
                            &nbsp;&nbsp;
                            <!--<button type="button" class="btn btn-success btn-excel"><i class="icon-file icon-large"></i> นำเข้าข้อมูลจากไฟล์ Excel (.xls)</button>-->
                            <br></br>
                            <table class="table table-hover table-striped table-bordered display" id="StudentList">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">ที่</th>
                                        <th class="no-sort">ชื่อ-นามสกุล</th>
                                        <th class="no-sort">ระดับชั้น</th>
                                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                            <th style="width:13%;" class="no-sort"></th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $row = 1; ?>
                                    <?php foreach ($rs as $r): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $row; ?></td>
                                            <td style="text-align: center;"><?php echo $r['std_titlename']; ?><?php echo $r['std_firstname']; ?> <?php echo $r['std_lastname']; ?></td>
                                            <td style="text-align: center;"><?php echo $r['tb_ed_school_class_name']; ?> ปีที่ <?php echo $r['tb_ed_school_class_level']; ?></td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <input type="hidden" name="inClss<?php echo $r['id']; ?>" id="inClss<?php echo $r['id']; ?>" value="<?php echo $r['ClsId']; ?>" class="form-control"/>
                                    <?php $row++; ?>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-body" id="StudentRegisteredBody">

                            <center><label class="control-label">รายชื่อนักเรียน</label></center>
                            &nbsp;&nbsp;
                            <br></br>
                            <table class="table table-hover table-striped table-bordered display" id="StudentRoom">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">ที่</th>
                                        <th class="no-sort">ชื่อ-นามสกุล</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<?php $this->load->view("student/std_import_modal"); ?>
<?php //$this->load->view("student/std_register_insert_modal"); ?>
<?php $this->load->view("student/std_edit_modal"); ?>
<script>

    function MyReloadLeft() {
        $('#StudentList').DataTable({
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
        $('.sorting_asc').removeClass('sorting_asc');

    }

    function MyReloadRight() {
        $('#StudentRoom').DataTable({
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
        $('.sorting_asc').removeClass('sorting_asc');
    }




    var ClsId = 0;
    var RoomId = 0;

    function MyRoomOnChange(e) {
        RoomId = e.value;
        $.ajax({
            url: '<?php echo site_url('Student/get_std_registered_list'); ?>',
            method: 'post',
            data: {rid: e.value, cid: ClsId},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                $("#StudentRegisteredBody").html(data);
                MyReloadRight();
            }
        });
    }
    
 


    function MyEdTest(e) {
        ClsId = e.value;
        $('#inStdClassM').val(ClsId);
        $.ajax({
            url: '<?php echo site_url('Student/get_std_waiting_list'); ?>',
            method: 'post',
            data: {id: e.value},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                if (data != "") {
                    $("#StudentWaitingBody").html(data);
                    MyReloadLeft();
                }

            }
        });
    }

















    // delete 
    $('#StudentWaitingBody').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('std-delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }
    );


    // update 
    var rid = 0;
    $('#StudentWaitingBody').on('click', '.btn-accept', function () {
        var uid = $(this).attr('id');
        rid = $('#inRoomId').val();
        $.ajax({
            url: '<?php echo site_url('Student/std_register_update'); ?>',
            method: 'post',
            data: {sid: uid, rid: rid},
            success: function (data) {
                $.ajax({
                    url: '<?php echo site_url('Student/get_std_waiting_list'); ?>',
                    method: 'post',
                    data: {id: ClsId},
                    success: function (data) {
                        $("#StudentWaitingBody").html(data);
                    }
                });
                $.ajax({
                    url: '<?php echo site_url('Student/get_std_registered_list'); ?>',
                    method: 'post',
                    data: {rid: RoomId, cid: ClsId},
                    success: function (data) {
                        $("#StudentRegisteredBody").html(data);
                    }
                });

            }
        });
    });

    //---- test import ----//
    //    $("#insert-form").on("submit", function (e) {
    $("#student-register-insert-form").on('click', '.btn-excel', function (e) {
        e.preventDefault();
        $("#std-import-modal").modal("show");
    });
    $("#student-register-insert-form").on('click', '.btn-register-insert-modal', function (e) {
        $("#std-register-insert-modal").modal("show");
    });

$(".btn-excel-export").on("click", function () {
//    alert('222');
    });
//--------
function ExportTemp(e){

    var tmp = "tb_student_base";
        $.ajax({
            url: '<?php echo site_url('StudentImport/ExportTemplate'); ?>',
            method: 'post',
            data: {'tableName':tmp},
            success: function (data) {
                window.open('<?php echo site_url('StudentImport/ExportTemplate'); ?>','_blank');
            }
        });
    }
    
    
    
    function StdEdit(e) {

        $.ajax({
            url: "<?php echo site_url('Student/std_edit'); ?>",
            method: "post",
            data: {id: e.id},
            dataType: "json",
            success: function (data) {
                $("#bid").val(data.StdId);
                $("#inStdTitlename").val(data.std_titlename.trim());
                $("#inStdFirstname").val(data.std_firstname);
                $("#inStdLastname").val(data.std_lastname);
                $("#inStdNickname").val(data.std_nickname);
                $("#inStdIdcard").val(data.std_idcard);
                $("#inStdReligion").val(data.std_religion);
                $("#inStdEthnicity").val(data.std_ethnicity);
                $("#inStdNationality").val(data.std_nationality);
                $("#inStdCode").val(data.std_code);

                //std_birthday
                if (data.std_birthday != null) {
                    var dateOfBirth = data.std_birthday.split("-");
                    $("#inStdBirthday").val(parseInt(dateOfBirth[2]));
                    $("#inStdBirthmonth").val(parseInt(dateOfBirth[1]));
                    $("#inStdBirthyear").val(parseInt(dateOfBirth[0]));
                }
                $("#inStdBirthhospital").val(data.std_birth_hospital);
                $("#inStdBloodtype").val(data.std_bloodtype);
//                $("#inStdAllergic").val(data.std_allergic);
//                $("#inStdCongenitalDisease").val(data.std_congenital_disease);
//
//                $("#inAddNo").val(data.add_no);
//                $("#inAddMoo").val(data.add_moo);
//                $("#inAddVillage").val(data.add_village);
//                $("#inAddRoad").val(data.add_road);
//                $("#inAddTambol").val(data.add_tambol);
//                $("#inAddAmphur").val(data.add_amphur);
//                $("#inAddProvince").val(data.add_province);
//                $("#inAddZipcode").val(data.add_zipcode);
//                $("#inAddType").val(data.add_type);
//
//                $("#inFmTitlename").val(data.fm_titlename);
//                $("#inFmFirstname").val(data.fm_firstname);
//                $("#inFmLastname").val(data.fm_lastname);
//                $("#inFmIdcard").val(data.fm_idcard);
//                $("#inFmReligion").val(data.fm_religion);
//                $("#inFmNationality").val(data.fm_nationality);
//                $("#inFmEthnicity").val(data.fm_ethnicity);
//                $("#inFmAbout").val(data.fm_about);
//                $("#inFmRelationship").val(data.fm_relationship);
//
//                $("#did").val(data.FamId);
//                $("#inFmCareerName").val(data.cr_career_name);
//                $("#inFmCompanyName").val(data.cr_company_name);
//                $("#inFmIncome").val(data.cr_income);

                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงข้อมูลนักเรียน");
                $("#std-edit-modal").modal("show");
            }
        });
    }

    function StdPrint(e) {
        printData();
//        alert(e.id);
    }

    function StdDetail(e) {
        $.ajax({
            url: "<?php echo site_url('Student/std_detail'); ?>",
            method: "POST",
            data: {id: e.id},
            success: function (data) {
                $("#detail").html(data);
                $("h3.modal-title").text("ข้อมูลพื้นฐานของนักเรียน");
                $("#std-detail-modal").modal("show");
            }
        });
    }


//function StdRegisteredDelete(e) {
//        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
//        if (status) {
//            $.ajax({
//                url: '<?php echo site_url('Student/std_registered_delete'); ?>',
//                method: 'post',
//                data: {id: e.id,status : 'W'},
//                success: function (data) {
//                    location.reload();
//                }
//            });
//        }
//    }
    
    function StdDelete(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Student/std_delete'); ?>',
                method: 'post',
                data: {id: e.id,status : 'W'},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }
    
    function StdWDelete(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Student/std_waiting_delete'); ?>',
                method: 'post',
                data: {id: e.id,status : 'W'},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }
    
    
</script>
