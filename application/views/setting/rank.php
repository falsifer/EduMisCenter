<!------------------------------------------------------------------------------
|  Title    rank
| ----------------------------------------------------------------------------
| Copyright	Edutech Co.,Ltd.
| Purpose       กำหนดตำแหน่ง
| Author	นายบัณฑิต ไชยดี
| Create Date   02-01-2019
| Last edit	-
| Comment	-
| --------------------------------------------------------------------------->
<div class="panel panel-primary">
    <div class="panel-heading">กำหนดตำแหน่ง</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('administrator', 'ส่วนการจัดการระบบ'); ?></li>
        <li>กำหนดตำแหน่ง</li>
    </ul>
    <div class="panel-body">

        <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
            <div class="row">
                <div class="col-md-7">
                    <div class="well">
                        <form method="post" id="insert-form" class="form-horizontal">
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label class="control-label col-md-3">ตำแหน่ง</label>
                                    <div class="col-md-8">
                                        <input type="text" name="inRankName" id="inRankName" class="form-control" autofocus required/>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <button type="submit" class="btn btn-success">บันทึก</button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" id="id" />
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="example">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">กลุ่มงานสำหรับการนิเทศ</th>
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
                            <td><?php echo $r['rank_name']; ?></td>
                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                <td style="text-align:center;border-right:none;">
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
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    //
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-rank'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
    // แก้ไขข้อมูล
    $('#example').on('click', '.btn-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-rank'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $('#id').val(data.id);
                $('#inRankName').val(data.rank_name);
            }
        });
    });
    // Delete rank data;
    $('#example').on('click','.btn-delete',function(){
    var uid=$(this).attr('id');
    var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
    if(status){
        $.ajax({
            url:'<?php echo site_url('delete-rank-data'); ?>',
            method:'post',
            data:{id:uid},
            success:function(data){
                location.reload();
            }
        });
    }
    });
</script>