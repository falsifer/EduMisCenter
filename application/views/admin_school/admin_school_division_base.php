<div class="box">
    <div class="box-heading">การจัดการฝ่ายงานของโรงเรียน
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>

        <?php if ($this->session->userdata('department') == 'กองการศึกษา') {
            ?>

            <li><?php echo anchor('administrator', 'ส่วนการจัดการระบบ'); ?></li>
        <?php } else { ?>

            <li><?php echo anchor('admin-school-base', 'ส่วนการจัดการระบบ'); ?></li>
            <?php
        }
        ?>
        <li>การจัดการฝ่ายงานของโรงเรียน</li>
    </ul>
    <div class="box-body"> 
        <div class="row">
            <div class="col-md-10 col-md-offset-1" id="ElectronicLeaveBody">
                <div class="row">
                    <table class="table table-hover table-striped table-bordered display" id="example">                        
                        <thead>
                            <tr>
                                <th style="width:10%; text-align: center"class="no-sort">ที่</th>
                                <th style="width:70%; text-align: center"class="no-sort">ชื่อฝ่าย</th>
                                <th style="width:20%; text-align: center"class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody id="Tbody">
                            <?php foreach ($divison as $r): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $r['id']; ?></td>
                                    <td style="text-align: center;"><?php echo $r['tb_division_name']; ?></td>
                                    <td style="text-align: center;">  
                                        <button type="button" class="btn btn-warning" id="<?php echo $r['id']; ?>" onclick="EditThis(this)"><i class="icon-pencil icon-large"></i> แก้ไข</button>                                                                                                                                                                                                                                     
                                        <button type="button" class="btn btn-danger" id="<?php echo $r['id']; ?>" onclick="DeleteThis(this)"><i class="icon-trash icon-large"></i> ลบ</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("admin_school/admin_school_division_modal"); ?>
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
    $("div#example_length.dataTables_length").append("&nbsp;&nbsp;<button type='button' class='btn btn-primary btn-insert' onclick='InsertModal(this)'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</button>");

    function InsertModal(e) {
        $("#insert-form")[0].reset();
        $('#admin-school-division-modal').modal('show');
    }
    function EditThis(e) {
        $.ajax({
            url: "<?php echo site_url('Admin_school/admin_school_division_edit'); ?>",
            method: "POST",
            data: {id: e.id},
            dataType: "json",
            success: function (data) {
                $('#id').val(data.id);
                $('#inDivisionName').val(data.tb_division_name);
                $('#admin-school-division-modal').modal('show');
            }
        });

    }

    function DeleteThis(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Admin_school/admin_school_division_delete'); ?>',
                method: 'post',
                data: {id: e.id},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }

</script>
