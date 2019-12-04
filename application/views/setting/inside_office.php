<div class="panel panel-primary">
    <div class="panel-heading">  ข้อมูลหน่วยงานภายใน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('administrator', 'ส่วนการจัดการระบบ'); ?></li>
        <li>ข้อมูลหน่วยงานภายใน</li>
    </ul>
    <div class="panel-body">

        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
            <div class="row">
                <div class="col-md-10">
                    <form id="insert-form" method="post" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label class="control-label col-md-3">ชื่อหน่วยงานภายใน</label>
                                <div class="col-md-5">
                                    <input type="text" name="inInsideOffice" id="inInsideOffice" class="form-control" required autofocus/>
                                </div>
                                <button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id" />
                    </form>
                </div>
            </div>
        <?php endif; ?>


        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ชื่อหน่วยงานภายใน (ระดับกอง)</th>
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
                            <td><?php echo $r['inside_office']; ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align: center;">
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
    //
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        $.ajax({
            url: "<?php echo site_url('setting/inside_office_insert'); ?>",
            method: "post",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
    //
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('setting/inside_office_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inInsideOffice").val(data.inside_office);
                $(".btn-insert").removeClass("btn btn-success").addClass("btn btn-primary").text("แก้ไขข้อมูล");
            }
        });
    });

    // delete data;
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('setting/inside_office_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>