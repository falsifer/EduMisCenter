<div class="box">
    <div class="box-heading">ห้องเรียนออนไลน์ (<?php echo $classroom_online['tb_classroom_online_name']; ?>)</div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('edutech-classroom-online?class_room_id=' . $classroom_online['id']), "ห้องเรียนออนไลน์-หน้าแรก"); ?></li>
        <li>ห้องเรียนออนไลน์ (<?php echo $classroom_online['tb_classroom_online_name']; ?>)</li>
    </ul>
    <div class="box-body" >
        <!--<div class="container">-->
        <div class='row'>
            <div class='col-md-12'>
                <div class='col-md-9'>
                    <legend>ข่าวสารในห้องเรียน</legend>
                    <hr/>
                    <legend>กระดานสนทนา</legend>
                </div>
                <div class='col-md-3'>
                    <div class="col-md-12">
                        <a href="<?php echo site_url('edutech-classroom-online-member?class_room_id=' . $classroom_online['id']); ?>" class="btn btn-info" style='width:100%;height: 50px;margin-top: 10px;font-size:1.5em;'><i class='icon-user icon-large'></i> สมาชิก</a>
                    </div>
                    <div class="col-md-12">
                        <a href="<?php echo site_url('edutech-classroom-online-work?class_room_id=' . $classroom_online['id']); ?>" class="btn btn-primary" style='width:100%;height: 50px;margin-top: 10px;font-size:1.3em;'><i class='icon-file icon-large'></i> เตรียมงาน/ภาระงาน</a>
                    </div>
                    <div class="col-md-12">
                        <a href="<?php echo site_url('edutech-classroom-online-assignment?class_room_id=' . $classroom_online['id']); ?>" class="btn btn-success" style='width:100%;height: 50px;margin-top: 10px;font-size:1.2em;'><i class='icon-list icon-large'></i> การมอบหมายงาน/การบ้าน</a>
                    </div>
                </div>
            </div>
        </div>

        <!--</div>-->
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>


<script>
    $('#ClassOnlineTable').DataTable({
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
    $('div#ClassOnlineTable_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert' onclick='InsertThis()'><i class='icon-plus icon-large'></i> เพิ่มข้อมูล</a>");

</script>

<script>
    function InsertThis() {
        alert('asd');
    }
</script>