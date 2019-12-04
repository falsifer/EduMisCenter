<div class="box">
    <div class="box-heading">การจัดการงาน และการอนุมัติงาน
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('administrator', "ส่วนการจัดการระบบ"); ?></li>
        <li>การจัดการงาน และการอนุมัติงาน</li>
    </ul>
    <div class="box-body"> 
        <div class="row">
            <div class="col-md-10 col-md-offset-1" id="ElectronicLeaveBody">
                <div class="row">
                    <table class="table table-hover table-striped table-bordered display" id="example">                        
                        <thead>
                            <tr>
                                <th style="width:10%; text-align: center"class="no-sort">ที่</th>
                                <th style="width:20%; text-align: center"class="no-sort">กลุ่มงาน</th>
                                <th style="width:40%; text-align: center"class="no-sort">ชื่องาน</th>
                                <th style="width:30%; text-align: center"class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody id="HrPositionBody">
                            <?php $i = 1; ?>
                            <?php foreach ($rs as $r): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $i; ?></td>
                                    <td style="text-align: center;"><?php echo $r['data_group']; ?></td>
                                    <td style="text-align: left;"><?php echo $r['data_name']; ?></td>

                                    <td style="text-align: center;">  
                                        <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>" onclick="EditModal(this)"><i class="icon-pencil icon-large"></i> แก้ไข</button>                                                                                                                                                                                                                                     
                                        <button type="button" class="btn btn-primary btn-approve" id="<?php echo $r['id']; ?>" onclick="ApproveModal(this)"><i class="icon-check icon-large"></i> กำหนดการอนุมัติ</button>                                                                                                                                                                                                                                     
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("admin_school/data_define_setting/data_define_setting_approve_modal"); ?>
<?php $this->load->view("admin_school/data_define_setting/data_define_setting_edit_modal"); ?>
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

    function InsertModal(e) {
        $("#insert-form")[0].reset();
        $('#hr-position-modal').modal('show');
    }

    function EditModal(e) {
        $.ajax({
            url: "<?php echo site_url('Admin_school/data_define_setting_edit'); ?>",
            method: "POST",
            data: {id: e.id},
//            dataType: "json",
            success: function (data) {
                 $('#insert-form').html(data);
//                $('#id').val(data.id);
//
//                $('#inDataDefineGroup').val(data.data_group);
//                $('#inDataDefineName').val(data.data_name);
//                $('#inDataDefineColor').val(data.data_color);


                $('#data-define-setting-edit-modal').modal('show');
            }
        });

    }

    var DataDefineID = 0;
    
    function ApproveModal(e) {
        DataDefineID = e.id;
        $.ajax({
            url: "<?php echo site_url('Admin_school/data_define_setting_approve'); ?>",
            method: "POST",
            data: {id: DataDefineID},
            success: function (data) {
                $('#ApproveBody').html(data);
                $('#data-define-setting-approve-modal').modal('show');
            }
        });

    }

</script>
