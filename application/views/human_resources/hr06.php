<div class="panel panel-primary">
    <div class="panel-heading">ทำเนียบบุคลากร [ ประวัติการสอน ]</div>
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
        <li>ประวัติการสอน</li>
    </ul>
    <div class="panel-body">
        <!--<div class="table-responsive" style="margin-top:30px;">-->
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:45px;">ที่</th>
                        <th class="no-sort">ปีการศึกษา</th>
                        <th class="no-sort">สอนรายวิชา</th>
                        <th class="no-sort">สอนระดับชั้น</th>
                        <th class="no-sort">จำนวนชั่วโมง</th>
                        <th class="no-sort">จำนวนนักเรียน (คน)</th>
                        <th class="no-sort">หมายเหตุ</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:13%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>    
                            <td><?php echo $r['hr06_loanyear']; ?></td>
                            <td><?php echo $r['hr06_subject']; ?></td>
                            <td><?php echo $r['hr06_grade']; ?></td>
                            <td><?php echo $r['hr06_amount']; ?></td>
                            <td><?php echo $r['hr06_student']; ?></td>
                            <td><?php echo $r['hr06_comment']; ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>" data-toggle="tooltip" title="แก้ไขข้อมูล" data-placement="top"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"><i class="icon-trash icon-large"></i> ลบ</button>
                                </td>
                            <?php endif; ?>                        
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
//    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-human-resources-part-06/' . $human['id']); ?>' target='_blank' class='btn btn-default btn-print'><i class='icon-plus icon-large'></i> พิมพ์</a>");
    //
//    var status = "<?php echo $this->session->userdata('status'); ?>";
//    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");
//    }
    // click on btn-insert;
    $('.btn-insert').on('click', function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกประวัติการสอน');
        $('#hr-06-modal').modal('show');
    });
    //
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-part-06'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inHr06LoanYear').val(data.hr06_loanyear);
                $('#inHr06Subject').val(data.hr06_subject);
                $('#inHr06Grade').val(data.hr06_grade);
                $('#inHr06Amount').val(data.hr06_amount);
                $('#inHr06Student').val(data.hr06_student);
                $('#inHr06Comment').val(data.hr06_comment);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลประวัติการสอน');
                $('#hr-06-modal').modal('show');
            }
        });
    });
    //
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-human-resources-part-06'); ?>',
                method: 'post',
                data: {id: uid},
                success: function () {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('human_resources/modals/hr_06_modal'); ?>