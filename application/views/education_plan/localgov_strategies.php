<div class="panel panel-primary">
    <div class="panel-heading"> <?php echo nbs(); ?> กำหนดแผนยุทธศาสตร์องค์กรปกครองส่วนท้องถิ่น</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('provice-strategies-definetion'), "ยุทธศาสตร์จังหวัด"); ?></li>
        <li>กำหนดแผนยุทธศาสตร์ อปท.</li>
    </ul>
    <div class="panel-body">

        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
            <div class="row">
                <form method="post" id="insert-form" class="col-md-10">
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label class="control-label">ยุทธศาสตร์ที่</label>
                            <input type="text" name="inLocalgovStNo" id="inLocalgovStNo" class="form-control" required/>
                        </div>
                        <div class="col-md-5 form-group">
                            <label class="control-label">ชื่อยุทธศาสตร์</label>
                            <input type="text" name="inLocalgovStName" id="inLocalgovStName" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-2">
                            <br/>
                            <button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ยุทธศาสตร์ที่</th>
                        <th class="no-sort">ชื่อยุทธศาสตร์</th>
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
                            <td style="text-align:center;"><?php echo $r['localgov_st_no']; ?></td>
                            <td><?php echo $r['localgov_st_name']; ?></td>
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
    //
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('insert-localgov-strategies'); ?>",
            method: "POST",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
    // edit data;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('update-localgov-strategies'); ?>",
            method: "post",
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $("#id").val(data.id);
                $("#inLocalgovStNo").val(data.localgov_st_no);
                $("#inLocalgovStName").val(data.localgov_st_name);
                //
            }
        });
    });
    // delete data
    $("#example").on("click",".btn-delete",function(){
    var uid=$(this).attr('id');
    var status=confirm('ต้องการลบข้อมุลนี้จริงหรือไม่ ?');
    if(status){
        $.ajax({
            url:"<?php echo site_url('delete-localgov-strategies'); ?>",
            method:"post",
            data:{id:uid},
            success:function(data){
                location.reload();
            }
        });
    }
    });
    
</script>