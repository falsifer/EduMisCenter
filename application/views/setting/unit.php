<div class="panel panel-primary">
    <div class="panel-heading">หน่วยนับ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('admin-school-base', 'ส่วนการจัดการระบบ'); ?></li>
        <li>หน่วยนับ</li>
    </ul>
    <div class="panel-body">

        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
            <div class="row">
                <div class="col-md-8">
                    <form method="post" id="insert-form">
                        <div class="form-group col-md-4">
                            <label class="control-label">ประเภทหน่วยนับ</label>
                            <select name="inCategoryId" id="inCategoryId" class="form-control" required>
                                <option value="">---เลือกประเภท---</option>
                                <?php foreach ($category as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['unit_category']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">หน่วยนับ</label>
                            <input type="text" name="inUnitName" id="inUnitName" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-2">
                            <br/>
                            <button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort" style="width:30%;">ประเภทหน่วยนับ</th>
                        <th class="no-sort">หน่วยนับ</th>
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
                            <td><?php echo $r['unit_category']; ?></td>
                            <td><?php echo $r['unit_name']; ?></td>
                            <td></td>
                        </tr>
                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
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
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        $.ajax({
            url: '<?php echo site_url('unit-insert'); ?>',
            method: 'post',
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>