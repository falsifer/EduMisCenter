<div class="box">
    <div class="box-heading">การจัดการตำแหน่งงานบุคลากร
    </div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <!--<li><?php echo anchor('admin-school-base', "ส่วนการจัดการระบบ"); ?></li>-->
        <li>การจัดการตำแหน่งงานบุคลากร</li>
    </ul>
    <div class="box-body"> 
        <div class="row">
            <div class="col-md-10 col-md-offset-1" id="ElectronicLeaveBody">
                <div class="row">
                    <table class="table table-hover table-striped table-bordered display" id="example">                        
                        <thead>
                            <tr>
                                <th style="width:30%; text-align: center"class="no-sort">เลขที่ตำแหน่ง</th>
                                <th style="width:30%; text-align: center"class="no-sort">ชื่อตำแหน่ง</th>
                                <th style="width:10%; text-align: center"class="no-sort">สถานะตำแหน่ง(ปัจจุบัน)</th>
                                <th style="width:30%; text-align: center"class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody id="HrPositionBody">
                            <?php foreach ($rs as $r): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $r['tb_hr_position_code']; ?></td>
                                    <td style="text-align: center;"><?php echo $r['tb_hr_position_name']; ?></td>
                                    <td style="text-align: center;"><?php
                                        if ($r['tb_hr_position_register_date'] != "") {
                                            echo "<font color='green'> มีผู้รับตำแหน่งแล้ว <br/>(" . $r['hr_thai_symbol'] . $r['hr_thai_name'] . $r['hr_thai_lastname'] . ")</font>";
                                        } else {
                                            echo "<font color='red'> ตำแหน่งว่าง</font>";
                                        }
                                        ?>
                                    </td>
                                    <td style="text-align: center;">  
                                        <button type="button" class="btn btn-warning btn-plan" id="<?php echo $r['id']; ?>" onclick="EditModal(this)"><i class="icon-pencil icon-large"></i> แก้ไข</button>                                                                                                                                                                                                                                     
                                        <button type="button" class="btn btn-danger btn-print" id="<?php echo $r['id']; ?>" onclick="Delete(this)"><i class="icon-trash icon-large"></i> ลบ</button>
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
<?php $this->load->view("admin_school/hr_position/hr_position_modal"); ?>
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
        $('#hr-position-modal').modal('show');
    }
    function EditModal(e) {
//        alert(e.id);
        $.ajax({
            url: "<?php echo site_url('Admin_school/hr_position_edit'); ?>",
            method: "POST",
            data: {id: e.id},
            dataType: "json",
            success: function (data) {
                $('#id').val(data.id);

                $('#inHrPositionCode').val(data.tb_hr_position_code);
                $('#inHrPositionName').val(data.tb_hr_position_name);
                $('#inHrPositionUnder').val(data.tb_hr_position_under);
                $('#inHrPositionTier').val(data.tb_hr_position_tier);
                $('#inHrPositionDetail').val(data.tb_hr_position_detail);

                $('#hr-position-modal').modal('show');
            }
        });

    }

    function Delete(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Admin_school/hr_position_delete'); ?>',
                method: 'post',
                data: {id: e.id},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }

</script>
