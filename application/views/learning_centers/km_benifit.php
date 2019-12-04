<div class="panel panel-primary">
    <div class="panel-heading">ประโยชน์ที่คาดจะได้รับจากแหล่งเรียนรู้<?php echo $km_name['km_thai_name']; ?></div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><a href="<?php echo site_url('km-base'); ?>">แหล่งเรียนรู้ภายในท้องถิ่น</a></li>
        <li>รายละเอียด</li>
    </ul>
    <div class="panel-body">
        <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
            <div class="row">
                <div class="col-md-6">
                    <form method="post" id="benifit-form" class="form-horizontal">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="control-label col-md-3">ประโยชน์ที่จะได้รับ</label>
                                <div class="col-md-7">
                                    <input type="text" name="inKmBenifit" id="inKmBenifit" class="form-control" required/>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-default"><i class="icon-save"></i> บันทึก</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id" />
                        <input type="hidden" name="km_base_id" value="<?php echo $this->uri->segment(2); ?>" />
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ประโยชน์ที่จะได้รับ</th>
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
                            <td><?php echo $r['km_benifit']; ?></td>
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
    $("#benifit-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-benifit'); ?>',
            method: 'post',
            data: $('#benifit-form').serialize(),
            success: function () {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#benifit-form')[0].reset();
                location.reload();
            }
        });
    });
    // benifit edit;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url:'<?php echo site_url('update-benifit'); ?>',
            method:'post',
            data:{id:uid},
            dataType:'json',
            success:function(data){
                $('#id').val(data.id);
                $('#inKmBenifit').val(data.km_benifit);
            }
        });
    });

    // benifit delete;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-km-benifit'); ?>',
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