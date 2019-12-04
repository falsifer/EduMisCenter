<div class="panel panel-primary">
    <div class="panel-heading">ข้อมูลด้านอื่น ๆ [ <?php echo $human['hr_thai_symbol'] . '' . $human['hr_thai_name'] ?><?php echo nbs(2); ?><?php echo $human['hr_thai_lastname']; ?> ]</div>
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
        <li>ข้อมูลด้านอื่น ๆ</li>
    </ul>
    <div class="panel-body">
        <!--<div class="table-responsive">-->
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">วัน/เดือน/ปี</th>
                        <th class="no-sort">รายละเอียด</th>
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
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            <td><?php echo $r['hr14_day']; ?> <?php echo month_num($r['hr14_month']); ?><?php echo nbs(2); ?><?php echo $r['hr14_year'] ?></td>
                            <td><?php echo $r['hr14_detail'] ?></td>
                            <td style="text-align:center;">
                                <?php if (file_exists('upload/' . $r['hr14_document']) && !empty($r['hr14_document'])): ?>
                                    <?php echo anchor(base_url() . 'upload/' . $r['hr14_document'], 'เอกสาร', array('rel' => 'lytebox')); ?>
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
//    $("div#example_length.dataTables_length").append("&nbsp;<a href='<?php echo site_url('print-human-resources-part-14/' . $human['id']); ?>' class='btn btn-default'><i class='icon-print icon-large'></i> พิมพ์</a>");
    
        $("div#example_length.dataTables_length").append("&nbsp;<button class='btn btn-primary btn-insert'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");
   
    //
    $(".btn-insert").click(function () {
        $("#insert-form").trigger("reset");
        $("h3.modal-title").text("บันทึกด้านอื่น ๆ");
        $("#hr-14-modal").modal("show");
    });
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    // edit data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-human-resources-part-14'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inHr14Day').val(data.hr14_day);
                $('#inHr14Month').val(data.hr14_month);
                $('#inHr14Year').val(data.hr14_year);
                $('#inHr14Detail').val(data.hr14_detail);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลด้านอื่น ๆ ');
                $('#hr-14-modal').modal('show');
            }
        });
    });
    //
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url:'<?php echo site_url('delete-human-resources-part-14'); ?>',
                method:'post',
                data:{id:uid},
                success:function(data){
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view('human_resources/modals/hr_14_modal'); ?>
