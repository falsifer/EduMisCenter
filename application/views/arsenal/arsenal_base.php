<div class="box">
    <div class="box-heading">คลังสื่อ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>คลังสื่อ</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ไฟล์</th>
                        <th class="no-sort">รูป</th>
                        <th class="no-sort">ลิ้งค์</th>
                        <th class="no-sort">ข้อความ</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>

                            <td style="text-align:center;">
                                <?php if (file_exists('upload/' . $r['tb_arsenal_doc']) && !empty($r['tb_arsenal_doc'])): ?>
                                    <?php echo anchor(base_url() . "upload/" . $r['tb_arsenal_doc'], img('images/folder.png'), array("target" => "_blank")); ?>
                                <?php endif; ?>

                            </td>

                            <td style="text-align:center;">
                                <?php if (file_exists('upload/' . $r['tb_arsenal_img']) && !empty($r['tb_arsenal_img'])): ?>
                                    <?php echo anchor(base_url() . "upload/" . $r['tb_arsenal_img'], img("images/camera.png"), array("rel" => "lytebox")); ?>
                                <?php endif; ?>

                            </td>


                            <td><?php echo auto_link($r['tb_arsenal_link'], 'both', true); ?></td> 
                            <td><?php echo $r['tb_arsenal_data']; ?></td>


                            <td>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
<!--                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>-->
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                <?php endif; ?>
                            </td>
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
    //
    // append insert button
    var status = "<?php echo $this->session->userdata('status'); ?>";
    var res = "<?php echo $this->session->userdata('responsible'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");

    }
    $(".btn-insert").on("click", function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกข้อมูลคลังสื่อ");
        $("#arsenal-modal").modal("show");
    });

    // detail
    $("#example").on("click", ".btn-detail", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('bd-base-detail'); ?>",
            method: "POST",
            data: {id: uid},
            success: function (data) {
                $("#detail").html(data);
                $("h3.modal-title").text("รายละเอียด");
                $("#bd-detail-modal").modal("show");
            }
        });
    });

    // edit 
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');

        $.ajax({
            url: "<?php echo site_url('arsenal-edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inTbArsenalLink").val(data.tb_arsenal_link);
                $("#inTbArsenalData").val(data.tb_arsenal_data);

                //------------------------------------------------//
                $("h3.modal-title").text("แก้ไข");
                $("#arsenal-edit-modal").modal("show");
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
                url: '<?php echo site_url('arsenal-delete'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();

                }
            });
        }
    });


</script>
<?php $this->load->view("arsenal/arsenal_modal"); ?>
<?php $this->load->view("arsenal/arsenal_edit_modal"); ?>
