<div class="box">
    <div class="box-heading">  ข้อมูลผู้ใช้งานระบบ(<?php echo $this->session->userdata('department') ?>)
        <button type="button" class="btn btn-success btn-excel" style="float:right;margin-left:5px;"><i class="icon-file icon-large"></i> นำเข้าข้อมูลจากไฟล์ Excel (.xls)</button>
     <button type="button" onclick="ExportTemp(this)" class="btn btn-success btn-excel-export" style="float:right"><i class="icon-download-alt icon-large"></i> ไฟล์ Excel (.xls)</button>
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('admin-school-base', 'ส่วนการจัดการระบบ'); ?></li>
        <li>ข้อมูลผู้ใช้งานระบบ</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:40px;">ที่</th>
                            <th class="no-sort">Username</th>
                            <th class="no-sort">Password</th>
                            <th class="no-sort">Status</th>
                            <th class="no-sort">Activate</th>
                            <th style="width:28%;" class="no-sort">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row = 1; ?>
                        <?php foreach ($rs as $r): ?>
                            <?php if ($r['username'] != 'admin'): ?>
                                <tr>
                                    <td style="text-align:center;"><?php echo $row; ?></td>
                                    <td><?php echo $r['username']; ?></td>
                                    <td><?php echo $r['password']; ?></td>
                                    <td><?php echo $r['status']; ?></td>
                                    <td><?php echo $r['activate'] == "1" ? "Activate" : "Non-Activate"; ?></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                        <button type="button" class="btn btn-danger btn-delete"  id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                        <a href="<?php echo site_url('school-member-permission/' . $r['id']); ?>" class="btn btn-info"><i class="icon-gear icon-large"></i> กำหนดสิทธ์ผู้ใช้</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
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
    // Add member
    var status = "<?php echo $this->session->userdata('status'); ?>";
    //if (status == "ผู้ดูแลระบบ") {
   // $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<a href='<?php echo site_url('print-member-detail'); ?>' class='btn btn-primary' target='_blank'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</a>");
    $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> บันทึก</button>");
    // }
    // .btn-insert on click
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกข้อมูลผู้ใช้งานระบบ");
        $("#member-modal").modal("show");
        $('#inUsername').attr('readonly', false);
    });
    // edit data;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Admin_school/member_hr_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
//                alert(data.hrid);
                $("#id").val(data.id);
                $("#inUsername").val(data.username);
                $("#inPassword").val(data.password);
                $("#inStatus").val(data.status);
                $("#inActivate").val(data.activate);
                $("#inDepartment").val(data.department);
                $("#inHr").val(data.hrid);
                //
                $("h3.modal-title").text("แก้ไขข้อมูลผู้ใช้งานระบบ");
                $("#member-modal").modal("show");

                $('#inUsername').attr('readonly', true);
            }
        });
    });
    // delete data;
    $("#example").on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('setting/member_delete'); ?>",
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // member responsible;
    $("#example").on("click", ".btn-operation", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('push-member-from-table'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                location.href = "<?php echo site_url('set-member-responsible/') ?>" + data.id;
            }
        });
    });
    
    
    
    function ExportTemp(e){

    var tmp = "tb_human_resources_01";
        $.ajax({
            url: '<?php echo site_url('HrImport/ExportTemplateFull'); ?>',
            method: 'post',
            data: {'tableName':tmp},
            success: function (data) {
                window.open('<?php echo site_url('HrImport/ExportTemplateFull'); ?>','_blank');
            }
        });
    }
    
    $(".btn-excel").on("click", function () {

        $("#hr-import-modal").modal("show");
    });
</script>
<?php $this->load->view("admin_school/member_modal"); ?>
<?php $this->load->view("admin_school/hr_import_modal"); ?>