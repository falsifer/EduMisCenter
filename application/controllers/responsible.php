<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">  หน้าที่รับผิดชอบ</div>
        <ul class="breadcrumb">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
            <li><?php echo anchor('administrator', "ส่วนการจัดการระบบ"); ?></li>
            <li>หน้าที่รับผิดชอบ</li>
        </ul>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:40px;">ที่</th>
                            <th class="no-sort">หน้าที่รับผิดชอบ</th>
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
                                <td><?php echo $r['responsible']; ?></td>
                                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
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
    var status = "<?php echo $this->session->userdata('status'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button class='btn btn-primary btn-insert'><i class=icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
    }
    //
    $('.btn-insert').click(function () {

        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกหน้าที่รับผิดชอบ");
        $("#responsible-modal").modal("show");
    });
    // edit data;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('update-responsible'); ?>",
            method: "post",
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $("#id").val(data.id);
                $("#inResponsible").val(data.responsible);
                //
                $("h3.modal-title").text("ปรับปรุงข้อมูลหน้าที่รับผิดชอบ");
                $("#responsible-modal").modal("show");
            }
        });
    });
    //
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr("id");
        var status = confirm("ต้องการลบข้อมูลนี้จริงหรือไม่ ?");
        if (status) {
            $.ajax({
                url: "<?php echo site_url('delete-responsible'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('modals/responsible_modal'); ?>