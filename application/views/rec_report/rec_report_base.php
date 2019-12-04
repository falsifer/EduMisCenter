<div class="box">
    <div class="box-heading">บันทึกรายงานผลการปฏิบัติงาน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>บันทึกรายงานผลการปฏิบัติงาน</li>
    </ul>
    <div class="box-body">
        <!--<div class="table-responsive">-->
        <table class="table table-hover table-striped table-bordered display" id="example">
            <thead>
                <tr>
                    <th style="width:40px;">ที่</th>
                    <th style="text-align:center;" class="no-sort">ชื่อรายงาน</th> 
                    <th style="text-align:center;" class="no-sort">เรียน</th> 
                    <th style="text-align:center;" class="no-sort">วันที่</th>
                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                        <th style="text-align:center;width:13%;" class="no-sort"></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $row = 1; ?>
                <?php foreach ($rs as $r): ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $row; ?></td>
                        <td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['tb_rec_report_topic']; ?></button></td>
                        <td><?php echo $r['tb_rec_report_for']; ?></td>
                        <td><?php echo datethaifull($r['tb_rec_report_date']); ?></td>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") : ?>
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php $row++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!--</div>-->
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
    $('.sorting_asc').removeClass('sorting_asc');

    // append insert button
    var status = "<?php echo $this->session->userdata('status'); ?>";
    var res = "<?php echo $this->session->userdata('responsible'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");

    }

    $(".btn-insert").on("click", function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกรายงานผลการปฏิบัติงาน");
        $("#rec-report-modal").modal("show");
    });



    // detail
    $("#example").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('rec-report-detail'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                $("#data").html(data);
                $("h3.modal-title").text("รายละเอียดบันทึกรายงานผลการปฏิบัติงาน");
                $("#rec-report-detail-modal").modal("show");
            }
        });
    });

    // edit 
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');

        $.ajax({
            url: "<?php echo site_url('rec-report-edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inTbRecReportTopic").val(data.tb_rec_report_topic);
                $("#inTbRecReportFor").val(data.tb_rec_report_for);
                $("#inTbRecReportRefer").val(data.tb_rec_report_refer);
                $("#inTbRecReportAttach").val(data.tb_rec_report_attach);
                $("#inTbRecReportContent").val(data.tb_rec_report_content);
                $("#inTbRecReportConclude").val(data.tb_rec_report_conclude);
                //------------------------------------------------//
                $("h3.modal-title").text("แก้ไขบันทึกรายงานผลการปฏิบัติงาน");
                $("#rec-report-modal").modal("show");
            }
        });
    }
    );

    // delete 
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('rec-report-delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();

                }
            });
        }


    });





</script>
<?php $this->load->view("rec_report/rec_report_modal"); ?>
<?php $this->load->view("rec_report/rec_report_detail_modal"); ?>
