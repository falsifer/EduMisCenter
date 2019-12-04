<div class="box">
    <div class="box-heading">การควบคุมภายในหน่วยงาน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>การควบคุมภายในหน่วยงาน</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">กลุ่มงาน</th>
                        
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน" ): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            
                            <td><button class="btn btn-link btn-detail" id="<?php echo $r['id']; ?>"><?php echo $r['tb_division_name']; ?></button></td>


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
    $('.sorting_asc').removeClass('sorting_asc');

    // append insert button
    var status = "<?php echo $this->session->userdata('status'); ?>";
    var res = "<?php echo $this->session->userdata('responsible'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
    }
    $(".btn-insert").on("click", function () {
        location.href = "<?php echo site_url('internal-control-insert-view'); ?>";
    });

    // detail
    $("#example").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('internal-control-detail'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                $("#detail").html(data);
                $("h3.modal-title").text("รายละเอียดการควบคุมภายในหน่วยงาน");
                $("#ft-detail-modal").modal("show");
            }
        });
    });

    // edit 
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('internal-control-edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inTbDivisionName").val(data.tb_division_name);
                $("#inTbInternalControlDetail1").val(data.tb_internal_control_detail1);
                $("#inTbInternalControlDetail2").val(data.tb_internal_control_detail2);
                $("#inTbInternalControlDetail3").val(data.tb_internal_control_detail3);
                $("#inTbInternalControlDetail4").val(data.tb_internal_control_detail4);
                $("#inTbInternalControlDetail5").val(data.tb_internal_control_detail5);
                $("#inTbInternalControlDetail6").val(data.tb_internal_control_detail6);

                //------------------------------------------------//
                $("h3.modal-title").text("ปรับปรุงรายละเอียดการควบคุมภายในหน่วยงาน");
                $("#ic-edit-modal").modal("show");
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
                url: '<?php echo site_url('internal-control-delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();

                }
            });
        }
    });
</script>
<?php $this->load->view("internal_control/internal_control_edit_modal"); ?>
<?php $this->load->view("internal_control/internal_control_detail_modal"); ?>