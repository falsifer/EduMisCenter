<div class="panel panel-primary">
    <div class="panel-heading">กำหนดรายการข้อมูลสำหรับปฏิบัติงาน [ <?php echo $member['member_name'] ?> <?php echo $member['member_lastname']; ?> ] ( <?php echo $member['id']; ?> )</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('member', 'ข้อมูลผู้ใช้งานระบบ'); ?></li>
        <li>กำหนดรายการข้อมูลฯ</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>DATA GROUP</th>
                        <th>DATA ACTIVITIES</th>
                        <th>ID</th>
                        <th>PERMISSION</th>
                        <th></th>
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
                                    <?php echo form_open('insert-member-activities-data'); ?>
                                    <?php if (!empty($chk_permission)): ?>
                                        <button type="button" class="btn btn-danger btn-delete" id="<?php echo $chk_permission['id']; ?>">CLEAR</button>
                                        <input type="hidden" name="permission_id" id="permission_id" value="<?php echo $chk_permission['id']; ?>" />
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-success">ACCEPT</button>
                                    <?php endif; ?>
                                    <?php echo form_hidden('id', $r['id']); ?>
                                    <?php echo form_hidden('row', $row); ?>
                                    <?php echo form_hidden('member_id', $member['id']); ?>
                                    <?php echo form_hidden('define_id', $r['id']); ?>
                                    <?php echo form_close(); ?>
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
</script>