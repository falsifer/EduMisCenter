<div class="box">
    <div class="box-heading">ทะเบียนนักเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ทะเบียนนักเรียน</li>
    </ul>
    <div class="box-body"> 
        <?php
        $data['class'] = 'Y';
        $data['room'] = 'Y';
        $data['term'] = 'Y';
        $this->load->view('layout/my_school_filter', $data);
        ?>
        <center> <button class="btn btn-link btn-detail" data-toggle="collapse" data-target="#StudentListBody">ข้อมูลนักเรียน</button></center>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 collapse in" id="StudentListBody">

            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view('student/student_management/student_edit_modal'); ?>
<?php $this->load->view('student/student_management/student_pp1_modal'); ?>
<?php $this->load->view('student/student_management/student_pp6_modal'); ?>
<script>

    function StdPP1(StdId) {
//        $.ajax({
//            url: "<?php echo site_url('Homeroom/absent_record_tbody'); ?>",
//            method: "post",
//            data: {stdid: StdId},
//            success: function (data) {

//                $('#PP1PrintArea').html(data);
        $("h3.modal-title").text("พิมพ์แบบปพ.1");
        $('#MySchoolAreaId').val("PP1PrintArea");
        $('#student-pp1-modal').modal('show');
//            }
//        });
    }

    function StdPP6(StdId) {
//        alert(StdId);
        $.ajax({
            url: "<?php echo site_url('PP6/get_std_pp6'); ?>",
            method: "POST",
            data: {stdid: StdId, term: Term, edyear: EdYear},
            success: function (data) {
                $("h3.modal-title").text("พิมพ์แบบปพ.6");
                $('#MySchoolAreaId').val("PP6PrintArea");
                $('#PP6PrintArea').html(data);
                $('#student-pp6-modal').modal('show');
            }
        });
    }

    var RmId = "";
    var ClsId = "";
    var EdYear = "";
    var Term = "";
    function MyEdTest(e) {
        ClsId = e.value;
        MyStdFilter();
    }

    function MyRoomOnChange(e) {
        RmId = e.value;
        MyStdFilter();
    }

    function MyTermOnChange(e) {
        Term = e.value;
        MyStdFilter();
    }

    function MyEdYearTest(e) {
        EdYear = e.value;
        MyStdFilter();
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
            url: '<?php echo site_url('Student/get_student_management_base_filter'); ?>',
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
</script>
<script>
    function StdEdit(e) {
//        $.ajax({
//            url: "<?php echo site_url('Student/std_detail'); ?>",
//            method: "POST",
//            data: {id: e.id},
//            success: function (data) {
//                $("#detail").html(data);
        $("h3.modal-title").text("ข้อมูลพื้นฐานของนักเรียน");
        $("#student-edit-modal").modal("show");
//            }
//        });
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


</script>
