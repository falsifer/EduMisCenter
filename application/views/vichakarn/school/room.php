<div class="box">
    <div class="box-heading">การวางแผนงานวิชาการ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor(site_url('ed-activity-planing'), " การวางแผนงานวิชาการ"); ?></li>
        <li>การกำหนดห้องเรียน</li>
    </ul>
  <div class="box-body">
        <div class="databox">
            <form method="post" id="room-insert-form">
                <div class="row">
                    <?php
                    $data['class'] = 'Y';
                    ?>
                    <?php $this->load->view('layout/my_school_filter', $data); ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label class="control-label">แผนการเรียน</label><span class="star">&#42;</span>
                            <select name="inEdPlan" id="inEdPlan" class="form-control">
                                <?php foreach ($plan as $r): ?>
                                    <option value="<?php echo $r['id']; ?>"><?php echo $r['tb_ed_plan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3"> 
                            <label class="control-label">ห้อง</label><span class="star">&#42;</span>
                            <select name="inClassroomRoom" id="inClassroomRoom" class="form-control">
                                <?php for ($i = 1; $i <= 30; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php }; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">จำนวนนักเรียน(คน)</label><span class="star">&#42;</span>
                            <input type="number" name="inClassroomStudentAmount" id="inClassroomStudentAmount" class="form-control" required />
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top:20px;">
                    <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button>
                        &nbsp;<button type="button" class="btn btn-danger btn-clear"><i class="icon-remove icon-large"></i> ยกเลิก</button>
                    </center>
                </div>
                <input type="hidden" name="id" id="id" />
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered display" id="roomTab">
                <thead>
                    <tr>
                        <th style="width:40px;">ที่</th>
                        <th class="no-sort">ห้อง</th>
                        <th class="no-sort">จำนวนนักเรียน</th>
                        <th style="width:13%;" class="no-sort"></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = 1;
                    $year = '2222';
                    ?>
                    <?php foreach ($roomRS as $r): ?>

                        <?php if ($year != $r['tb_ed_school_register_class_edyear']): ?>
                            <tr>
                                <td>ปีการศึกษา    <?php
                                    echo $r['tb_ed_school_register_class_edyear'];
                                    $year = $r['tb_ed_school_register_class_edyear'];
                                    ?></td>
                                <td style="display: none;">&nbsp;</td>
                                <td style="display: none;">&nbsp;</td>
                                <td style="display: none;width:13%;" class="no-sort"></td>

                            </tr>

                        <?php endif; ?>
                        <?php
                        $rrs = $this->My_model->count_record_where('tb_ed_classroom', array('tb_ed_room_id' => $r['id']));
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $row; ?></td>
                            <td><?php echo $r['tb_ed_school_class_name'] . ' ' . $r['tb_ed_school_class_level'] . '/' . $r['tb_classroom_room']; ?></td>
                            <td><?php echo $rrs . '/' . $r['tb_classroom_student_amount']; ?></td>

                            <td style="text-align:center;">
                                <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>" eYear="<?php echo $r['tb_ed_school_register_class_edyear']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                            </td>

                        </tr>

                        <?php $row++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="box-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8">
                <?php echo img("images/kmk_logo.png"); ?>
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 1.0</span></span>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("vichakarn/modals/ed_room_modal"); ?>

<script>


    $("#roomTab").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        var eyear = $(this).attr('eYear');

        $.ajax({
            url: "<?php echo site_url('school/Vichakarn/room_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {

                $("#id").val(data.id);
                $("#MyEdYear").val(eyear);
                $("#MyEdYear").change();
                $("#inClassroomRoom").val(data.tb_classroom_room);
                $("#inClassroomStudentAmount").val(data.tb_classroom_student_amount);
                $("#inEdPlan").val(data.tb_ed_plan_id);
                setTimeout(function () {
                    $('#MyClass').val(data.tb_ed_school_register_class_id);
                }, 300);


            }
        });
    });

    $("#roomTab").on("click", ".btn-delete", function () {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        var uid = $(this).attr('id');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('school/Vichakarn/room_delete'); ?>",
                method: "post",
                data: {id: uid},
                success: function (data) {
                    alert('ลบข้อมูลสำเร็จ !');
                    location.reload();
                }
            });
        }
    });

    $("#room-insert-form").on("click", ".btn-clear", function () {
        $("#room-insert-form")[0].reset();
    });

    $("#room-insert-form").on("submit", function (e) {
        e.preventDefault();

        //
        $.ajax({
            url: "<?php echo site_url('school/Vichakarn/room_add'); ?>",
            method: "post",
            data: $("#room-insert-form").serialize(),
            success: function (data) {
                $("#room-insert-form")[0].reset();
                location.href = "<?php echo site_url('ed-room/'); ?>";
            }

        });
    });

    $('#roomTab').DataTable({
        "responsive": true,
        "pageLengh": 100,
        "stateSave": true,
        "bSort": false,
        "ordering": false,
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

    $('.sorting_asc').removeClass('sorting_asc');
    //
    var status = "<?php //echo $this->session->userdata("status");                               ?>";
//    $("div#roomTab_length.dataTables_length").append("&nbsp;<button class='btn btn-default btn-insert' data-toggle='modal' data-target='#ed-room-modal'><i class='icon-print icon-large'></i> พิมพ์ข้อมูล</button>");
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css("overflow", "auto");
    });



</script>