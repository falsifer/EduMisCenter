<div class="panel panel-primary">
    <div class="panel-heading">ทำเนียบบุคลากร [ ประวัติการเลื่อนตำแหน่ง ]</div>
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
        <li>ประวัติการเลื่อนตำแหน่ง</li>
    </ul>
    <div class="panel-body">
        <!--<div class="table-responsive">-->
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:45px;">ที่</th>
                        <th class="no-sort">วัน/เดือน/ปี</th>
                        <th class="no-sort">ตำแหน่ง</th>
                        <th class="no-sort">ระดับ</th>
                        <th class="no-sort">หน่วยงาน</th>
                        <th class="no-sort">จังหวัด</th>
                        <th class="no-sort">เอกสารประกอบ</th>
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
                            <td><?php echo $row; ?></td>
                            <td><?php echo $r['hr08_day']; ?> <?php echo month_num($r['hr08_month']); ?><?php echo nbs(2); ?><?php echo $r['hr08_year']; ?></td>
                            <td><?php echo $r['hr08_rank']; ?></td>
                            <td><?php echo $r['hr08_level']; ?></td>
                            <td><?php echo $r['hr08_office']; ?></td>
                            <td><?php echo $r['hr08_province']; ?></td>
                            <td style='text-align:center;'>
                                <?php if (file_exists('upload/' . $r['hr08_file']) && !empty($r['hr08_file'])): ?>
                                    <?php echo anchor(base_url() . 'upload/' . $r['hr08_file'], 'เอกสาร', array('rel' => 'lytebox')); ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $r['hr08_comment']; ?></td>
                            <td style="text-align:center;">
                                <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
//    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='<?php echo site_url('print-human-resources-part-08/' . $human['id']); ?>' target='_blank' class='btn btn-default btn-print'><i class='icon-print icon-large'></i> พิมพ์</a>");
    //
  
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");
  
    //
    $('.btn-insert').click(function () {
        $('#insert-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลการเลื่อนตำแหน่ง');
        $('#hr-08-modal').modal('show');
    });
    
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-part-08'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inHr08Day').val(data.hr08_day);
                $('#inHr08Month').val(data.hr08_month);
                $('#inHr08Year').val(data.hr08_year);
                $('#inHr08Rank').val(data.hr08_rank);
                $('#inHr08Level').val(data.hr08_level);
                $('#inHr08Office').val(data.hr08_office);
                $('#inHr08Province').val(data.hr08_province);
                $('#inHr08Comment').val(data.hr08_comment);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลประวัติการเลื่อนตำแหน่ง');
                $('#hr-08-modal').modal('show');
            }
        });
    });
    // edit data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-human-resources-part-08'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('human_resources/modals/hr_08_modal'); ?>