<div class="panel panel-primary">
    <div class="panel-heading">ประวัติความเป็นมาของแหล่งเรียนรู้</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="<?php echo site_url('km-base'); ?>">แหล่งเรียนรู้ภายในท้องถิ่น</a></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">
        <?php if (!empty($rs)): ?>
            <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                <form method="post" id="information-form">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label">ประวัติความเป็นมา</label>
                            <textarea name="inKmHistory" id="inKmHistory" class="form-control" style="height:180px;" autofocus><?php echo $rs['km_history'] ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <center>
                                <button type="submit" class="btn btn-default"><i class="icon-save"></i> แก้ไข</button>
                                <button type="button" class="btn btn-default btn-delete" id="<?php echo $rs['id'] ?>"><i class="icon-trash"></i> ลบ</button>
                            </center>
                        </div>
                    </div>
                    <input type="hidden" name="km_base_id" id="km_base_id" value="<?php echo $rs['km_base_id']; ?>" />
                    <input type="hidden" name="status" value="edit" />
                </form>
            <?php else: ?>
                <div class="well">
                    <?php echo $rs['km_history']; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                <form method="post" id="information-form">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label">ประวัติความเป็นมา</label>
                            <textarea name="inKmHistory" id="inKmHistory" class="form-control" style="height:180px;" autofocus></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <center>
                                <button type="submit" class="btn btn-default"><i class="icon-save"></i> บันทึก</button>
                            </center>
                        </div>
                    </div>
                    <input type="hidden" name="km_base_id" id="km_base_id" value="<?php echo $this->uri->segment(2); ?>" />
                </form>
            <?php else: ?>
                <div class="well">
                    <center>## ไม่มีข้อมูล ##</center>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <div class="panel-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8" style="padding-top:8px;padding-right:8px;font-size:15px;color:#666;">
                <img src="<?php echo base_url() . 'images/box_logo.png' ?>" /> สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
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
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    // สร้างปุ่ม
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;");
    $("#information-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-km-information'); ?>',
            method: 'post',
            data: $('#information-form').serialize(),
            success: function () {
                alert('บันทึกข้อมูลเรียบร้อย...');
                location.reload();
            }
        });
    });
    // Delete data
    $('.btn-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-km-information'); ?>',
                method: 'post',
                data: {id: uid},
                success: function () {
                    location.reload();
                }
            });
        }
    });
</script>
<!---------------------------------------------------------------------------->