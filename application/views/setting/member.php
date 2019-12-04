<div class="panel panel-primary">
    <div class="panel-heading">  ข้อมูลผู้ใช้งานระบบ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('admin-school-base', 'ส่วนการจัดการระบบ'); ?></li>
        <li>ข้อมูลผู้ใช้งานระบบ</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ชื่อ-นามสกุล</th>
                        <th class="no-sort">สังกัด</th>
                        <th class="no-sort">Username</th>
                        <th class="no-sort">Password</th>
                        <th class="no-sort">Status</th>
                        <th class="no-sort">Activate</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:18%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <?php if ($r['username'] != 'admin'): ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $row; ?></td>
                                <td><?php echo $r['member_name']; ?> <?php echo $r['member_lastname']; ?></td>
                                <td><?php echo $r['department']; ?></td>
                                <td><?php echo $r['username']; ?></td>
                                <td><?php echo $r['password']; ?></td>
                                <td><?php echo $r['status']; ?></td>
                                <td><?php echo $r['activate'] == "1" ? "Activate" : "Non-Activate"; ?></td>
                                <td style="text-align: center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>">EDIT</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>">DEL</button>
                                    <a href="<?php echo site_url('define-member-activities/'.$r['id']); ?>" class="btn btn-info">PERMISSION</a>
                                </td>
                            </tr>
                        <?php endif; ?>
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
    // Add member
    var status = "<?php echo $this->session->userdata('status'); ?>";
    if (status == "ผู้ปฏิบัติงาน") {
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<a href='<?php echo site_url('print-member-detail'); ?>' class='btn btn-primary' target='_blank'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</a>");
        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> บันทึก</button>");
    }
    // .btn-insert on click
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกผู้ใช้งานระบบ");
        $("#member-modal").modal("show");
    });
    // edit data;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('setting/member_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $("#id").val(data.id);
                $("#inMemberName").val(data.member_name);
                $("#inMemberLastname").val(data.member_lastname);
                $("#inMemberEmail").val(data.member_email);
                $("#inMemberMobile").val(data.member_mobile);
                $("#inUsername").val(data.username);
                $("#inPassword").val(data.password);
                $("#inStatus").val(data.status);
                $("#inActivate").val(data.activate);
                $("#inDepartment").val(data.department);
                //
                $("h3.modal-title").text("แก้ไขข้อมูลผู้ใช้งานระบบ");
                $("#member-modal").modal("show");
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
</script>
<?php $this->load->view("modals/member_modal"); ?>