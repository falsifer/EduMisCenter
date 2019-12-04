<!------------------------------------------------------------------------------
|  Title      Supervison plan
| ----------------------------------------------------------------------------
| Copyright	Edutech Co.,Ltd.
| Purpose     กำหนดแผนการนิเทศ
| Author	นายบัณฑิต ไชยดี
| Create Date
| Last edit	-
| Comment	-
| --------------------------------------------------------------------------->
<div class="panel panel-primary">
    <div class="panel-heading">กำหนดแผนการนิเทศ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>กำหนดแผนการนิเทศ</li>
    </ul>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">กลุ่มงานสำหรับการนิเทศ</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;border-right: none;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo $r['supervision_name']; ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;border-right:none;">
                                    <button type="button" class="btn btn-default btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-default btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    // 
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-print'><i class='icon-print'></i> พิมพ์ข้อมูล</a>");
    var chk_tbl = "<?php echo count($sp_plan) ?>";
    if (chk_tbl == 0) {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-plan-insert'>บันทึกวัตถุประสงค์</a>");
    } else {
        //
        var status = '<?php echo $this->session->userdata('status'); ?>';
        if (status == 'ผู้ปฏิบัติงาน') {
            $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-insert'><i class='icon-plus'></i> บันทึกข้อมูล</a>");
        }
    }
    // บันทึกข้อมูลแผนการนิเทศ
    $('.btn-plan-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกวัตถุประสงค์ของการนิเทศ');
        $('#supervision-plan-modal').modal('show');
    });
    // แก้ไขข้อมูลทั่วไปแผนการนิเทศ
    $('.btn-plan-edit').on('click', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-supervision-plan'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inSupervisionName').val(data.supervision_name);
                $('#inSupervisionDestination').val(data.supervision_destination);
                $('#inSupervisionPurpose1').val(data.supervision_purpose1);
                $('#inSupervisionPurpose2').val(data.supervision_purpose2);
                $('#inSupervisionPurpose3').val(data.supervision_purpose3);
                $('#inSupervisionPurpose4').val(data.supervision_purpose4);
                $('#inSupervisionPurpose5').val(data.supervision_purpose5);
                $('#inSupervisionPurpose6').val(data.supervision_purpose6);
                $('#inSupervisionPurpose7').val(data.supervision_purpose7);
                $('#inSupervisionPurpose8').val(data.supervision_purpose8);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลแผนการนิเทศ');
                $('#supervision-plan-modal').modal('show');
            }
        });
    });
    // ลบข้อมูลทั่วไปแผนการนิเทศ
    $('.btn-plan-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-supervision-plan'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    // บันทึกข้อมูลแผนการนิเทศ
    $('.btn-insert').on('click', function () {
       $('#insert-form').trigger('reset');
       $('h3.modal-title').text('บันทึกข้อมูลแผนนิเทศ');
       $('#supervision-plan-detail-modal').modal('show');
    });

    // แก้ไขข้อมูลแผนการนิเทศ
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url(''); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);

                //
                $('h3.modal-title').text('');
                $('#-modal').modal('show');
            }
        });
    });
    // ลบข้อมูลแผนการนิเทศ
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url(''); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {

                }
            });
        }
    });
</script>
<!---------------------------------------------------------------------------->
<?php $this->load->view('vichakarn/modals/supervision_plan_modal'); ?>
<?php $this->load->view('vichakarn/modals/supervision_plan_detail_modal');?>