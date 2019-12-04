<div class="box">
    <div class="box-heading">ห้องเรียนออนไลน์ (<?php echo $classroom_online['tb_classroom_online_name']; ?>) - เตรียมภาระงาน</div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('edutech-classroom-online?class_room_id=' . $classroom_online['id']), "ห้องเรียนออนไลน์-หน้าแรก"); ?></li>        
        <li><?php echo anchor(site_url('edutech-classroom-online-room?class_room_id=' . $classroom_online['id']), "ห้องเรียนออนไลน์"); ?></li>
        <li>ห้องเรียนออนไลน์ (<?php echo $classroom_online['tb_classroom_online_name']; ?>) - เตรียมภาระงาน</li>
    </ul>
    <div class="box-body" >
        <!--<div class="container">-->
        <div class='row' >
            <div class='col-md-12'>
                <table class="table table-striped table-bordered"  id="ClassOnlineHomeWorkTable">
                    <thead>
                        <tr>
                            <th style="width:5%;text-align: center;">ที่</th>

                            <th style="width:15%;text-align: center;">ชื่อภาระงาน</th>
                            <th style="width:20%;text-align: center;">รายละเอียด</th>
                            <th style="width:15%;text-align: center;">เอกสารแนบ</th>
                            <th style="width:10%;text-align: center;">ประเภท</th>
                            <th style="width:10%;text-align: center;">ขอบเขต</th>
                            <th style="width:10%;text-align: center;">สถานะ</th>
                            <th style="width:30%;text-align: center;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($work_list as $r): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $i; ?></td>

                                <td style="text-align: center;"><?php echo $r['tb_classroom_online_work_name']; ?></td>
                                <td style="text-align: center;"><?php echo $r['tb_classroom_online_work_detail']; ?></td>
                                <td style="text-align: center;"><?php echo $r['tb_classroom_online_work_file']; ?></td>
                                <td style="text-align: center;"><?php echo $r['tb_classroom_online_work_type']; ?></td>
                                <td style="text-align: center;">ภายใน <?php echo $r['tb_classroom_online_work_startdate']; ?> จนถึง <?php echo $r['tb_classroom_online_work_enddate']; ?></td>
                                <td style="text-align: center;">ยังไม่ถูกใช้งาน</td>
                                <td style="text-align: center;">
                                    <button type='button' class='btn btn-warning' onclick='EditThis(<?php echo $r['id'] ?>)'><i class='icon-pencil icon-large'></i> แก้ไข</button>
                                    &nbsp;
                                    <button type='button' class='btn btn-danger' onclick='DeleteThis(<?php echo $r['id'] ?>)'><i class='icon-trash icon-large'></i> ลบ</button>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--</div>-->
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view('classroom_online/classroom_online_work_modal'); ?>
<script>
    $('#ClassOnlineHomeWorkTable').DataTable({
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
        },
    });
    $('div#ClassOnlineHomeWorkTable_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert' onclick='InsertThis()'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");

</script>

<script>
    function InsertThis() {
        $("#insert-form")[0].reset();
        $('#classroom-online-work-modal').modal('show');
    }
    function EditThis(id) {

        $.ajax({
            url: "<?php echo site_url('Classroom_online/classroom_online_work_edit'); ?>",
            method: "post",
            data: {id: id},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inClassroomOnlineWorkName").val(data.tb_classroom_online_work_name);
                $("#inClassroomOnlineWorkType").val(data.tb_classroom_online_work_type);
                $("#inClassroomOnlineWorkStartdate").val(data.tb_classroom_online_work_startdate);
                $("#inClassroomOnlineWorkEnddate").val(data.tb_classroom_online_work_enddate);
                $("#inClassroomOnlineWorkDetail").val(data.tb_classroom_online_work_detail);
                //------------------------------------------------//

                $('#classroom-online-work-modal').modal('show');
            }
        });
    }
    function DeleteThis(id) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Classroom_online/classroom_online_work_delete'); ?>',
                method: 'post',
                data: {id: id},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }
</script>