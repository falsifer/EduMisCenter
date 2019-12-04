<div class="box">
    <div class="box-heading">ห้องเรียนออนไลน์ (<?php echo $classroom_online['tb_classroom_online_name']; ?>) - สมาชิกในห้องเรียน</div>
    <ul class="breadcrumb" style="margin-bottom: 0px;">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('edutech-classroom-online?class_room_id=' . $classroom_online['id']), "ห้องเรียนออนไลน์-หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('edutech-classroom-online-room?class_room_id=' . $classroom_online['id']), "ห้องเรียนออนไลน์"); ?></li>
        <li>ห้องเรียนออนไลน์ (<?php echo $classroom_online['tb_classroom_online_name']; ?>) - สมาชิกในห้องเรียน</li>
    </ul>
    <div class="box-body" >
        <!--<div class="container">-->
        <br/>
        <div class='row' >
            <div class='col-md-12'>
                <div class='col-md-5'>
                    <!--<div class="col-md-12">-->
                    <?php
                    $data['class'] = 'Y';
                    $data['room'] = 'Y';
                    $this->load->view('layout/my_school_filter', $data);
                    ?>
                    <table class="table table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th style="width:10%;text-align: center;">ที่</th>
                                <th style="width:20%;text-align: center;">รหัสนักเรียน</th>
                                <th style="width:50%;text-align: center;">ชื่อ-นามสกุล</th>
                                <th style="width:20%;text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody id="ClassOnlineMemberTBody">
                        </tbody>
                    </table>
                    <!--</div>--> 
                </div>
                <div class='col-md-7'>
                    <!--<div class='col-md-12'>-->
                    <table class="table table-striped table-bordered"  id="ClassOnlineMemberTable">
                        <thead>
                            <tr>
                                <th style="width:5%;text-align: center;">ที่</th>
                                <th style="width:30%;text-align: center;">ชื่อ-นามสกุล</th>
                                <!--<th style="width:10%;text-align: center;">ชื่อเรียก</th>-->
                                <th style="width:20%;text-align: center;">ประเภทสมาชิก</th>
                                <!--<th style="width:15%;text-align: center;">สถานะ</th>-->
                                <th style="width:30%;text-align: center;"></th>
                            </tr>
                        </thead>
                        <tbody id='inClassroomMemberTbody'>
                            <?php $i = 1; ?>
                            <?php foreach ($member_list as $r): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $i; ?></td>
                                    <td style="text-align: center;"><?php echo $r['std_fullname']; ?></td>
                                    <!--<td style="text-align: center;"><?php echo $r['tb_classroom_online_member_nickname']; ?></td>-->
                                    <td style="text-align: center;"><?php echo $r['tb_classroom_online_member_type']; ?></td>
                                    <!--<td style="text-align: center;"><?php echo $r['tb_classroom_online_member_status']; ?></td>-->
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
                    <!--</div>-->  
                </div>

            </div>
        </div>

        <!--</div>-->
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view('classroom_online/classroom_online_member_modal'); ?>
<script>
    $('#ClassOnlineMemberTable').DataTable({
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
//    $('div#ClassOnlineMemberTable_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-primary btn-insert' onclick='InsertThis()'><i class='icon-plus icon-large'></i> เพิ่มสมาชิก</a>");
    var Room_id;
    function MyRoomOnChange(e) {
        Room_id = e.value;
        MyReload();
    }
    function MyReload() {
        $.ajax({
            url: '<?php echo site_url('Classroom_online/classroom_online_member_list'); ?>',
            method: 'post',
            data: {id: Room_id},
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                $("#ClassOnlineMemberTBody").html(data);
            }
        });
    }
</script>

<script>
    function InviteThis(id) {
        $.ajax({
            url: "<?php echo site_url('Classroom_online/classroom_online_member_invite'); ?>",
            method: "post",
            data: {classroom_id: '<?php echo $classroom_online['id']; ?>', member_id: id},
            success: function (data) {
//                MyReload();
                $.ajax({
                    url: "<?php echo site_url('Classroom_online/classroom_online_member_invite'); ?>",
                    method: "post",
                    data: {classroom_id: '<?php echo $classroom_online['id']; ?>'},
                    success: function (data) {
                        $('#inClassroomMemberTbody').html();
                    }
                });
            }
        });
    }


    function EditThis(id) {

        $.ajax({
            url: "<?php echo site_url('Classroom_online/classroom_online_member_edit'); ?>",
            method: "post",
            data: {id: id},
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#inClassroomOnlineMemberNickname").val(data.tb_classroom_online_member_nickname);
                $("#inClassroomOnlineMemberType").val(data.tb_classroom_online_member_type);
                $("#inClassroomOnlineWorkStartdate").val(data.tb_classroom_online_member_status);
                //------------------------------------------------//

                $('#classroom-online-member-modal').modal('show');
            }
        });
    }
    function DeleteThis(id) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Classroom_online/classroom_online_member_delete'); ?>',
                method: 'post',
                data: {id: id},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }
</script>