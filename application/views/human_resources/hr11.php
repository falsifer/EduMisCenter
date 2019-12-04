<div class="panel panel-primary">
    <div class="panel-heading">ทำเนียบบุคลากร [ ข้อมูลการลาทุกประเภท/การปฏิบัติงาน ]</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <?php
        $hr_id = $this->session->userdata('hr_id');
        $checker = $this->uri->segment(2);

        if ($hr_id != $checker) {
            ?>
            <li><?php echo anchor("human_resources", "ทำเนียบบุคลากร"); ?></li>
        <?php } else { ?>
            <li><?php echo anchor("hr-member-profile", "ข้อมูลผู้ใช้"); ?></li>
        <?php } ?>
        <li>ข้อมูลการลาทุกประเภท/การปฏิบัติงาน</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:45px;">ที่</th>
                        <th class="no-sort">วัน/เดือน/ปี</th>
                        <th class="no-sort">มาสาย</th>
                        <th class="no-sort">ลาป่วย</th>
                        <th class="no-sort">ลากิจ</th>
                        <th class="no-sort">ขาด</th>
                        <th class="no-sort">ไปราชการ</th>
                        <th class="no-sort">ลาพักผ่อน</th>
                        <th class="no-sort">ลาคลอด</th>
                        <th class="no-sort">ลาบวช/ฮัจช์</th>
                        <th class="no-sort">ลาศึกษาต่อ</th>
                        <th class="no-sort">เอกสารประกอบ</th>
                        <?php if ($this->session->userdata("") == ""): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td><?php echo $row; ?></td>
                            <td><?php echo datethai($r['hr11_date']); ?></td>
                            <?php if ($r['hr11_type'] == 'มาสาย'): ?>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr11_type'] == 'ลาป่วย'): ?>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr11_type'] == 'ลากิจ'): ?>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr11_type'] == 'ขาด'): ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr11_type'] == 'ไปราชการ'): ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr11_type'] == 'ลาพักผ่อน'): ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr11_type'] == 'ลาคลอด'): ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                                <td></td>
                            <?php elseif ($r['hr11_type'] == 'ลาบวช/ฮัจช์'): ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                                <td></td>
                            <?php else: ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align:center;"><?php echo img('images/checked.png'); ?></td>
                            <?php endif; ?>
                            <td style="text-align:center;">
                                <?php if (file_exists('upload/' . $r['hr11_file']) && !empty($r['hr11_file'])): ?>
                                    <?php echo anchor(base_url() . 'upload/' . $r['hr11_file'], 'เอกสาร', array('target' => '_blank')); ?>
                                <?php endif; ?>
                            </td>
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                            </td>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8" style="padding-top:8px;">
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><?php echo img("images/footer_logo.png"); ?><?php echo nbs(); ?><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
            </div>
        </div>
    </div>
</div>
<!---------------------------------------------------------------------------->
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
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print_human_resources-part-11-summary/'.$human['id']); ?>' target='_blank' class='btn btn-default btn-print'><i class='icon-print icon-large'></i> สรุปข้อมูล</a>");
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-human-resources-part-11/'.$human['id']); ?>' target='_blank' class='btn btn-default btn-print'><i class='icon-print icon-large'></i> พิมพ์ทั้งหมด</a>");
    //
    var status = '<?php echo $this->session->userdata('status'); ?>';
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-insert'><i class='icon-plus icon-large'></i> บันทึก</a>");
    }
    //
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกการลาทุกประเภท/การปฏิบัติงาน');
        $('#hr-11-modal').modal('show');
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-part-11'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inHr11Date').val(data.hr11_date);
                $('#inHr11Type').val(data.hr11_type);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลการลาทุกประเภท/การปฏิบัติงาน');
                $('#hr-11-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-human-resources-part-11'); ?>',
                method: 'post',
                data: {id: uid},
                dataType: 'json',
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('human_resources/modals/hr_11_modal'); ?>