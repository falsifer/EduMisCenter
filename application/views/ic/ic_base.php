<div class="box">
    <div class="box-heading">ระบบควบคุมภายใน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ระบบควบคุมภายใน</li>
    </ul>
    <div class="box-body">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="ic-base-insert-form" enctype="multipart/form-data">
                    <table class="table table-hover table-striped table-bordered display" id="example">
                        <thead>
                            <tr>
                                <th style="width:40px;">ที่</th>
                                <th class="sorting">ปีการศึกษา</th>
                                <th class="sorting">งวด/ระยะดำเนินงาน</th>
                                <th class="sorting">จัดการ</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $row = 1; ?>
                            <?php foreach ($rs as $r): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row; ?></td>
                                    <td style="text-align: center;"><?php echo $r['tb_internal_control_edyear']; ?></td>
                                    <td style="text-align: center;"><?php echo $r['tb_internal_control_date']; ?></td>

                                    <td style="text-align:center;">
                                        <button type="button" class="btn btn-warning btn-element-modal" id="<?php echo $r['id']; ?>"><i class="icon-copy icon-large"></i> องค์ประกอบ</button>

                                        <button type="button" class="btn btn-info btn-evaluation-report-modal" id="<?php echo $r['id']; ?>"><i class="icon-file icon-large"></i> รายงานผลการประเมิน</button> 

    <!--<button type="button" class="btn btn-primary btn-element-result" id="<?php echo $r['id']; ?>"><i class="icon-copy icon-large"></i> รายงานผลองค์ประกอบ</button>-->

            <!--<button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>-->
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

    <div class="box-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8">
                <?php echo img("images/kmk_logo.png"); ?>
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 1.0</span></span>
            </div>
        </div>
    </div>
</div>


<!--New-->
<?php $this->load->view("ic/ic_element_modal"); ?>
<?php $this->load->view("ic/ic_evaluation_report_modal"); ?>
<!--Old-->

<script>
    //-------- New
    var status = "<?php echo $this->session->userdata('responsible'); ?>";
    $('#inDivision').on('change', function (e) {
        alert(status);
    });

    $(".btn-element-modal").on("click", function () {
        $("#ic-element-modal").modal("show");
    });
    $(".btn-evaluation-report-modal").on("click", function () {
        $("#ic-evaluation-report-modal").modal("show");
    });










    //-------Old
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
        },
    });
    $('.sorting_asc').removeClass('sorting_asc');
    var IcId = 0;

//    $(".btn-topic").on("click", function () {
//        var uid = $(this).attr('id');
//        IcId = uid;
//        $.ajax({
//            url: "<?php echo site_url('Ic/get_ic_topic'); ?>",
//            method: "POST",
//            data: {id: uid},
//            success: function (data) {
//                $("#TopicBody").html(data);
//                $("h3.modal-title").text("องค์ประกอบของการควบคุม");
//                $("#ic-topic-modal").modal("show");
//            }
//        });
//    });
//
//    $(".btn-element-result").on("click", function () {
//        var uid = $(this).attr('id');
//        IcId = uid;
//        $.ajax({
//            url: "<?php echo site_url('Ic/get_ic_element_result'); ?>",
//            method: "POST",
//            data: {id: uid},
//            success: function (data) {
//                $("#ElementResultBody").html(data);
////                $("h3.modal-title").text("องค์ประกอบของการควบคุม");
//                $("#ic-element-modal").modal("show");
//            }
//        });
//    });
//    $(".btn-division-result").on("click", function () {
////        var uid = $(this).attr('id');
////        IcId = uid;
////        $.ajax({
////            url: "<?php echo site_url('Ic/get_ic_element_result'); ?>",
////            method: "POST",
////            data: {id: uid},
////            success: function (data) {
////                $("#ElementResultBody").html(data);
////                $("h3.modal-title").text("องค์ประกอบของการควบคุม");
//        $("#ic-division-modal").modal("show");
////            }
////        });
//    });
</script>

