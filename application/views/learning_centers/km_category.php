<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-primary">
        <div class="panel-heading">## ประเภทแหล่งเรียนรู้ ##</div>
        <ul class="breadcrumb">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
            <li>รายละเอียด</li>
        </ul>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered display" id="example">
                    <thead>
                        <tr>
                            <th style="width:40px;">ที่</th>
                            <th class="no-sort">ชนิดแหล่งเรียนรู้</th>
                            <th class="no-sort">ประเภทแหล่งเรียนรู้</th>
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
                                <td><?php echo $r['km_type']; ?></td>
                                <td><?php echo$r['km_category_name'] ?></td>
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
    var status = '<?php echo $this->session->userdata('status'); ?>';
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<button type='button' class='btn btn-default btn-insert'><i class='icon-plus'></i> บันทึก</button>");
    }
    //
    $(".btn-insert").click(function () {
        $("#km-category-form").trigger("reset");
        $("h3.modal-title").text("บันทึกข้อมูลประเภทของแหล่งเรียนรู้");
        $("#km-category-modal").modal("show");
    });
    // update data;
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-km-category'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inKmTypeId').val(data.km_type_id);
                $("#inKmCategoryName").val(data.km_category_name);
                //
                $('h3.modal-title').text('ปรับปรุงข้อมูลประเภทแหล่งเรียนรู้');
                $('#km-category-modal').modal('show');
            }
        });
    });
    // delete data;
    $('#example').on('click', '.btn-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-km-category'); ?>',
                method: 'post',
                data: {id: uid},
                success: function () {
                    location.reload();
                }
            });
        }
    });
</script>
<?php $this->load->view("learning_centers/modals/km_category_modal"); ?>