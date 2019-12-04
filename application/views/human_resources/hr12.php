<div class="panel panel-primary">
    <div class="panel-heading">ข้อมูลการกระทำผิด [ <?php echo $hr['hr_thai_symbol'] . '' . $hr['hr_thai_name'] ?><?php echo nbs(2); ?><?php echo $hr['hr_thai_lastname']; ?> ]</div>
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
        <li>ข้อมูลการกระทำผิด</li>
    </ul>
    <div class="panel-body">
        <!--<div class="table-responsive">-->
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">วัน/เดือน/ปี</th>
                        <th class="no-sort">การกระทำผิด</th>
                        <th class="no-sort">เอกสารอ้างอิง</th>
                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                            <th style="width:15%;" class="no-sort"></th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 1; ?>
                    <?php foreach ($rs as $r): ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $row; ?></td>
                            <td><?php echo $r['hr12_day']; ?> <?php echo month_num($r['hr12_month']); ?><?php echo nbs(2); ?><?php echo $r['hr12_year']; ?></td>
                            <td><?php echo $r['hr12_detail']; ?></td>
                            <td style="text-align:center;">
                                <?php if (file_exists('upload/' . $r['hr12_file']) && !empty($r['hr12_file'])): ?>
                                    <?php echo anchor(base_url() . 'upload/' . $r['hr12_file'], 'เอกสาร', array('target' => '_blank')); ?>
                                <?php endif; ?>
                            </td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
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
            <div class="col-md-8" style="padding-top:3px;padding-right:8px;font-size:15px;color:#666;">
                <img src="<?php echo base_url() . 'images/box_logo.png' ?>" /> สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
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
    //
//        $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<a href='<?php echo site_url('print-human-resources-part-12/'.$hr['id']); ?>' class='btn btn-default' target='_blank'><i class='icon-print icon-large'></i> พิมพ์</a>");
    
        $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
  
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกข้อมูลการกระทำผิด");
        $("#hr-12-modal").modal("show");
    });
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    //
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-part-12'); ?>',
            method: 'POST',
            data: {id: uid},
            dataType: 'JSON',
            success: function (data) {
                $('#id').val(data.id);
                $('#inHr12Day').val(data.hr12_day);
                $('#inHr12Month').val(data.hr12_month);
                $('#inHr12Year').val(data.hr12_year);
                $('#inHr12Detail').val(data.hr12_detail);
                $('h3.modal-title').text('แก้ไขข้อมูลการทำผิด');
                $('#hr-12-modal').modal('show');
            }
        });
    });

    // delete data;
    $('#example').on("click", ".btn-delete", function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-human-resources-part-12'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('human_resources/modals/hr_12_modal'); ?>
