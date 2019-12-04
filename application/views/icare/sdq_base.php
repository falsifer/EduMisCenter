<div class="box">
    <div class="box-heading">แบบประเมิน SDQ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <!--<li><?php echo anchor(site_url('icare'), " ระบบดูแลช่วยเหลือนักเรียน/เยี่ยมบ้านนักเรียน"); ?></li>-->
        <li>แบบประเมิน SDQ</li>
    </ul>
    <div style="padding: 30px;">
        <div class="row"> 
            <div class="col-md-2 tab-menu-active"><i class='icon-edit'></i> การประเมิน SDQ</div>
            <div class="col-md-2 tab-menu"><?php echo anchor(site_url('sdq-type'), "<i class=\"icon-list-alt\"></i> พฤติกรรมแต่ละด้าน"); ?></div>
            <div class="col-md-2 tab-menu"><?php echo anchor(site_url('sdq-topic'), "<i class=\"icon-list\"></i> หัวข้อพฤติกรรม"); ?></div>
            <div class="col-md-2 tab-menu"><?php echo anchor(site_url('sdq-temp-print'), "<i class=\"icon-print\"></i> พิมพ์แบบเปล่า"); ?></div>
        </div>
        <div class="box-body">
            <?php
            $data['class'] = 'Y';
            $data['room'] = 'Y';
            $data['term'] = 'Y';
            $this->load->view('layout/my_school_filter', $data);
            ?>
        <!--<center> <button class="btn btn-link btn-detail" data-toggle="collapse" data-target="#StudentListBody">ข้อมูลนักเรียน</button></center>-->
            <div class="row">
                <div class="col-md-12 collapse in">
                    <table class='table table-hover table-bordered display' id='StudentTable'>
                        <thead>
                            <tr>
                                <th style='width: 10%;text-align: center;'>เลขที่</th>
                                <th style='width: 10%;text-align: center;'>รหัสนักเรียน</th>
                                <th style='width: 40%;text-align: center;'>ชื่อ-นามสกุล</th>
                                <!--<th style='width: 10%;text-align: center;'>ผลการประเมิน</th>-->
                                <th style='text-align: center;'><i class='icon-edit'></i> บันทึกประเมิน / <i class='icon-print'></i> รายงานการประเมิน</th>
                            </tr>
                        </thead>
                        <tbody id='StudentTBody'>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view('homeroom/hr_homeroom_sdq_modal'); ?>

<script>


    var RmId = "";
    var ClsId = "";
    var EdYear = "";
    var Term = "";

    function MyEdTest(e) {
        ClsId = e.value;
        $('#inStdClassM').val(ClsId);
        //MyStdFilter();

    }


    function MyEdYearTest(e) {
        EdYear = e.value;
        $('#inEdYear').val(EdYear);
    }

    function MyRoomOnChange(e) {
        RmId = e.value;
        $('#inStdClassRoomM').val(RmId);
        MyStdFilter();
    }

    function MyTermOnChange(e) {
        Term = e.value;
        MyStdFilter();
    }

    function Myreload() {
        $('#example').DataTable({
            "pageLength": 50,
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


//        $("div#example_length.dataTables_length").append("<br><button type=\"button\" class=\"btn btn-success btn-excel\"><i class=\"icon-file icon-large\"></i> นำเข้าข้อมูลจากไฟล์ Excel (.xls)</button>");
//        $("div#example_length.dataTables_length").append("&nbsp;<button type=\"button\" onclick=\"ExportTemp(this)\" class=\"btn btn-success btn-excel-export\"><i class=\"icon-download-alt icon-large\"></i> รูปแบบไฟล์ Excel (.xls)</button>");

    }

    function MyStdFilter() {
        $.ajax({
            url: '<?php echo site_url('Icare/student_list_by_filter'); ?>',
            method: 'post',
            data: {term: $('#MyTerm').val(), edyear: EdYear, roomid: $('#MyRoom').val()},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                $("#StudentTBody").html(data);
            }
        });
    }



    $(".btn-insert").on("click", function () {

    });


    $(".btn-insert").on("click", function () {
        $("#sdq-insert-modal").modal("show");
    });

    $(".btn-print").on("click", function () {
        $("#sdq-print-modal").modal("show");
    });

    $(".btn-show").on("click", function () {
        $("#sdq-show-modal").modal("show");
    });




    function HrHomeRoomSDQ(e) {
        $.ajax({
            url: '<?php echo site_url('Icare/student_sdq_show'); ?>',
            method: 'post',
            data: {id: e.id, term: $('#MyTerm').val(), edyear: EdYear, Assessor: "Teacher"},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                $('#MySchoolAreaId').val('SDQ');
                MyEndLoading();
                $("#SDQBody").html(data);
                $('#hr-homeroom-sdq-modal').modal('show');
            }
        });
    }

    function StudentSDQ(e) {
        $.ajax({
            url: '<?php echo site_url('Icare/student_sdq_show'); ?>',
            method: 'post',
            data: {id: e.id, term: $('#MyTerm').val(), edyear: EdYear, Assessor: "Student"},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                $('#MySchoolAreaId').val('SDQ');
                MyEndLoading();
                $("#SDQBody").html(data);
//                $('#hr-homeroom-sdq-std-modal').modal('show');
                $('#hr-homeroom-sdq-modal').modal('show');
            }
        });
    }

    function ParentSDQ(e) {
        $.ajax({
            url: '<?php echo site_url('Icare/student_sdq_show'); ?>',
            method: 'post',
            data: {id: e.id, term: $('#MyTerm').val(), edyear: EdYear, Assessor: "Parent"},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                $('#MySchoolAreaId').val('SDQ');
                MyEndLoading();
                $("#SDQBody").html(data);
                $('#hr-homeroom-sdq-modal').modal('show');
            }
        });
    }

</script>

<?php // $this->load->view('icare/modals/sdq_base_modal'); ?>
<?php // $this->load->view('icare/modals/sdq_show_modal'); ?>
<?php // $this->load->view('icare/modals/sdq_print_modal'); ?>
