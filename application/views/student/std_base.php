<div class="box">
    <div class="box-heading">สำมะโนนักเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>สำมะโนนักเรียน</li>
    </ul>
    <div class="box-body">
        <?php
        $data['class'] = 'Y';
        $data['room'] = 'Y';
        $this->load->view('layout/my_school_filter', $data);
        ?>
        <!-- <center> <button class="btn btn-link btn-detail" data-toggle="collapse" data-target="#StudentListBody">ข้อมูลนักเรียน</button></center> -->
        <div class="row">
            <div class="col-md-12 collapse in" id="StudentListBody">

            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php // $this->load->view("student/std_insert_modal"); ?>
<?php $this->load->view("student/std_edit_modal"); ?>
<?php $this->load->view("student/std_detail_modal"); ?>
<script>

    function StdInsert(e) {
        $("h3.modal-title").text("จัดการข้อมูลนักเรียน");
        $("#std-insert-modal").modal("show");
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
//                $("#inAddLat").val(data.add_lat);
//                $("#inAddLong").val(data.add_long);
//
//                $("#inFmTitlename").val(data.tb_outsider_titlename);
//                $("#inFmFirstname").val(data.tb_outsider_firstname);
//                $("#inFmLastname").val(data.tb_outsider_lastname);
//                $("#inFmIdcard").val(data.tb_outsider_idcard);
//                $("#inFmReligion").val(data.tb_outsider_religion);
//                $("#inFmNationality").val(data.tb_outsider_nationality);
//                $("#inFmEthnicity").val(data.tb_outsider_ethnicity);
//                $("#inFmAbout").val(data.tb_outsider_about);
//                $("#inFmRelationship").val(data.tb_outsider_relationship);
//                $("#inFmStatus").val(data.tb_outsider_status);
//
//
//                $("#did").val(data.FamId);
//                $("#jid").val(data.JobId);
//                $("#addid").val(data.AddId);
//                $("#inFmCareerName").val(data.cr_career_name);
//                $("#inFmCompanyName").val(data.cr_company_name);
//                $("#inFmIncome").val(data.cr_income);

                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงข้อมูลนักเรียน");
                $("#std-edit-modal").modal("show");
            }
        });
    }

//    function StdPrint(e) {
//        printData();
//        alert(e.id);
//    }

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

    function StdDelete(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Student/std_delete'); ?>',
                method: 'post',
                data: {id: e.id},
                success: function (data) {
                    MyStdFilter();
                }
            });
        }
    }

    var RmId = "";
    var ClsId = "";
    var EdYear = "";

    function MyEdTest(e) {
        ClsId = e.value;
        MyStdFilter();
    }

    function MyRoomOnChange(e) {
        RmId = e.value;
        MyStdFilter();
    }

    function MyEdYearTest(e) {
        EdYear = e.value;
//        MyStdFilter();
    }

    function Myreload() {
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
        $('.sorting_asc').removeClass('sorting_asc');
//        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert' onclick='StdInsert(this)'><i class='icon-plus icon-large'></i> บันทึกข้อมูล</button>");

    }

    function MyStdFilter() {
        $.ajax({
            url: '<?php echo site_url('Student/get_std_base_list'); ?>',
            method: 'post',
            data: {rid: RmId, cid: ClsId, edyear: EdYear},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                if (data != "") {
                    $("#StudentListBody").html(data);
                    Myreload();
                }

            }
        });
    }



    $(".btn-insert").on("click", function () {

    });




</script>
