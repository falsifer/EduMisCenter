<div class="box">
    <div class="box-heading">กำหนดรายการข้อมูลสำหรับปฏิบัติงาน [ <?php echo $member['member_name'] ?> <?php echo $member['member_lastname']; ?> ] ( <?php echo $member['id']; ?> )</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('admin-school-base', 'ส่วนการจัดการระบบ'); ?></li>
        <li><?php echo anchor('admin-school-base-member', 'ข้อมูลผู้ใช้งานระบบ'); ?></li>
        <li>กำหนดรายการข้อมูลฯ</li>
    </ul>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-hover table-condensed" id="grantTab">
                <thead>
                    <tr>
                        <th class="no-sort">No</th>
                        <th class="no-sort">DATA GROUP</th>
                        <th class="no-sort">DATA ACTIVITIES</th>
                        <th class="no-sort">ID</th>
                        <th class="no-sort">PERMISSION
                            <button class="btn btn-info btn-accept-all">เลือกทั้งหมด</button>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($rs)): ?>
                        <?php $row = 1; ?>
                        <?php foreach ($rs as $r): ?>
                            <tr>

                                <td style="text-align:center;"><?php echo $row; ?></td>
                                <td><?php echo $r['data_group']; ?></td>
                                <td><?php echo $r['data_name']; ?></td>
                                <td><?php echo $r['id']; ?></td>

                                <td>
                                    <?php $chk_permission = $this->My_model->get_where_row('tb_member_activities', array('data_define_id' => $r['id'], 'member_id' => $member['id'])); ?>
                                    <?php echo form_open('Admin_school/insert_member_activities'); ?>
                                    <!--<form method="post" id="grant-insert-form" enctype="multipart/form-data">-->
                                        <?php if (!empty($chk_permission)): ?>
                                            <button type="button" class="btn btn-danger btn-delete" id="<?php echo $chk_permission['id']; ?>">CLEAR</button>
                                            <input type="hidden" name="permission_id" id="permission_id" value="<?php echo $chk_permission['id']; ?>" />
                                        <?php else: ?>
                                            <button type="sumbit" class="btn btn-success btn-accept">ACCEPT</button>
                                        <?php endif; ?>

                                        <?php echo form_hidden('id', $r['id']); ?>
                                        <?php echo form_hidden('row', $row); ?>
                                        <?php echo form_hidden('member_id', $member['id']); ?>
                                        <?php echo form_hidden('define_id', $r['id']); ?>
                                    <!--</form>-->
                                    <?php  echo form_close(); ?>
                                </td>

                            </tr>
                            <?php $row++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<!---------------------------------------------------------------------------->
<script>

    $('.btn-accept').click(function () {

        $.ajax({
            url: '<?php echo site_url('Admin_school/insert_member_activities'); ?>',
            method: 'post',
            data: $("#grant-insert-form").serialize(),
            success: function (data) {
                //location.reload();
            }
        });
    });

    $('.btn-delete').click(function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('delete-member-activities-data'); ?>',
            method: 'post',
            data: {id: uid},
            success: function (data) {
                location.reload();
            }
        });
    });
    
    $('.btn-accept-all').click(function () {
        var uid = <?php echo $member['id']; ?>;
        $.ajax({
            url: '<?php echo site_url('Admin_school/insert_member_activities_all'); ?>',
            method: 'post',
            data: {member_id: uid},
            success: function (data) {
                location.reload();
            }
        });
       });

    $('#grantTab').DataTable({
        "pageLength": 50,
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
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
</script>