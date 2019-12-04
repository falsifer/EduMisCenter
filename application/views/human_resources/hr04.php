<div class="panel panel-primary">
    <div class="panel-heading">บันทึกบุคลากร [ ประวัติการทำงาน ] <?php echo $human['hr_thai_symbol']; ?><?php echo $human['hr_thai_name']; ?>&nbsp;&nbsp;<?php echo $human['hr_thai_lastname']; ?></div>
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
        <li>ประวัติการทำงาน</li>
    </ul>
    <div class="panel-body">
        <!--<div class="table-responsive">-->
        <table class="table table-hover table-striped table-bordered display" id="example">
            <thead>
                <tr>
                    <th style="width:40px;">ที่</th>
                    <th class="no-sort">วัน/เดือน/ปี</th>
                    <th class="no-sort">ตำแหน่ง/ปฏิบัติหน้าที่</th>
                    <th class="no-sort">หน่วยงาน</th>
                    <th class="no-sort">ระยะเวลา</th>
                    <th class="no-sort">เอกสารอ้างอิง</th>
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
                        <td><?php echo $r['hr04_day'] ?> <?php echo month_num($r['hr04_month']); ?><?php echo nbs(2); ?><?php echo $r['hr04_year']; ?></td>
                        <td><?php echo $r['hr04_rank']; ?></td>
                        <td><?php echo $r['hr04_operation']; ?></td>
                        <td><?php echo $r['hr04_long']; ?></td>
                        <td>
                            <?php if (file_exists('upload/' . $r['hr04_file']) && !empty($r['hr04_file'])): ?>
                                <?php echo anchor(base_url() . "upload/" . $r['hr04_file'], "เอกสาร", array('rel' => 'lytebox')); ?>
                            <?php endif; ?>
                        </td>
                        <td style="text-align:center;">
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน") : ?>
                                <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>" data-toggle="tooltip" title="แก้ไขข้อมูล" data-placement="top"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"><i class="icon-trash icon-large"></i> ลบ</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $row++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!--</div>-->
    </div>

    <div class="panel-footer" style="padding-top: 0px;">
        <!--        <div class="row">
                    <div class="col-md-8" style="padding-top:8px;">
                    </div>
                    <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                        <span class="pull-right"><?php echo img("images/footer_logo.png"); ?><?php echo nbs(); ?><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
                    </div>
                </div>-->
    </div>
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
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");
    }
//    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-human-resources-part-04/' . $human['id']); ?>' class='btn btn-default btn-print' target='_blank'><i class='icon-print icon-large'></i> พิมพ์</a>");
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกประวัติการทำงาน');
        $('#hr-04-modal').modal('show');
    });
    // edit data;
    $('#example').on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-part-04'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inHr04Day').val(data.hr04_day);
                $('#inHr04Month').val(data.hr04_month);
                $('#inHr04Year').val(data.hr04_year);
                $('#inHr04Rank').val(data.hr04_rank);
                $('#inHr04Operation').val(data.hr04_operation);
                $('#inHr04Organization').val(data.hr04_organization);
                $('#inHr04Long').val(data.hr04_long);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลประวัติการทำงาน');
                $('#hr-04-modal').modal('show');
            }
        });
    });
    //
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-human-resources-part-04'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('human_resources/modals/hr_04_modal'); ?>