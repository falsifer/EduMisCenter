<div class="box">
    <div class="box-heading">บันทึกคะแนนความประพฤติ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('icare'), " ระบบดูแลช่วยเหลือนักเรียน/เยี่ยมบ้านนักเรียน"); ?></li>
        <li>บันทึกคะแนนความประพฤติ</li>
    </ul>
    <div class="box-body">

        <?php
        $data['edyear'] = 'Y';
        $data['class'] = 'Y';
        $data['room'] = 'Y';
        $this->load->view('layout/my_school_filter', $data);
        ?>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <!--<div class="table-responsive">-->
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:40px;">ที่</th>
                            <th class="no-sort">ชื่อ-นามสกุล</th>
                            <th class="no-sort">ระดับชั้น</th>
                            <th class="no-sort">คะแนนรวม</th>
                            <?php // if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                            <?php // endif; ?>
                        </tr>
                    </thead>
                    <tbody id="StdTbody">
                    </tbody>
                </table>
                <!--</div>-->
            </div>
        </div>
    </div>
    <?php $this->load->view("layout/my_school_footer") ?>
</div>
<script>
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

    function MyStdFilter() {
        $.ajax({
            url: '<?php echo site_url('School_administrator/get_std_tbody_list'); ?>',
            method: 'post',
            data: {RoomId: RmId, ClassId: ClsId, EdYear: EdYear},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                $("#StdTbody").html(data);
//                Myreload();
            }
        });
    }
</script>
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

    // input score 
    $("#example").on("click", ".btn-show", function () {
        var uid = $(this).attr('id');

        $.ajax({
            url: "<?php echo site_url('School_administrator/get_std_adm_score'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                $('#MySchoolAreaId').val("AdmPrintArea");
                $('#AdmBody').html(data);

                $('#std-adm-score-modal').modal('show');
            }
        });
    });



</script>

<?php $this->load->view("school_administrator/adm_modal"); ?>