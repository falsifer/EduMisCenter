<div class="box">
    <div class="box-heading">เลื่อนชั้นแจ้งจบ / แจ้งซ้ำชั้น</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>

        <li>เลื่อนชั้นแจ้งจบ / แจ้งซ้ำชั้น</li>
    </ul>
    <div class="box-body">
        <form method="post" id="class-management-insert-form" enctype="multipart/form-data">

            <?php
            $data['class'] = 'Y';
            $data['room'] = 'Y';
            $this->load->view('layout/my_school_filter', $data);
            ?>

            <div class="row" id="StudentRegisterBody">
            </div>
            <br></br>
        </form>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<script>

    function ClassUpgrade(e) {
//        alert("Upgrade !");
        $.ajax({
            url: "<?php echo site_url('Course_register/cm_insert_class_upgrade'); ?>",
            method: "post",
            data: new FormData($("#class-management-insert-form")[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("เลื่อนชั้นสำเร็จ !");
                FilterCourse();
            }
        });
    }

    function CreateRoom() {
//        alert("Createroom !");
        $.ajax({
            url: "<?php echo site_url('Course_register/cm_insert_room'); ?>",
            method: "post",
            data: {PlanId: $("#inPlanId").val(), RoomNum: $("#inRoomNum").val(), StdAmount: $("#inStdAmount").val(), RegisterId: $("#inRegisterId").val()},
            success: function (data) {
                alert("สร้างห้องสำเร็จ !");
                FilterCourse();
            }
        });
    }

    function ClassGraduate(e) {
        $.ajax({
            url: "<?php echo site_url('Course_register/cm_insert_graduate'); ?>",
            method: "post",
            data: new FormData($("#class-management-insert-form")[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("เลื่อนชั้นซ้ำเสร็จ !");
                FilterCourse();
            }
        });
    }

    function UncheckClick(e) {

        $.ajax({
            url: "<?php echo site_url('Course_register/insert_repeat_class'); ?>",
            method: "post",
            data: {id: e.id, edyear: $("#MyEdYear").val()},
            success: function (data) {
                FilterCourse();
            }
        });

    }

    function CheckClick(e) {

        $.ajax({
            url: "<?php echo site_url('Course_register/clear_repeat_class'); ?>",
            method: "post",
            data: {id: e.id},
            success: function (data) {
                FilterCourse();
            }
        });

    }

//    function MyEdYearTest(e) {
//        FilterCourse(e);
//    }
//
    function MyEdTest(e) {
        $('#StudentRegisterBody').html("");
    }

    function MyRoomOnChange(e) {
        FilterCourse();
    }

    function FilterCourse() {
        $.ajax({
            url: "<?php echo site_url('Course_register/get_std_registered_list'); ?>",
            method: "post",
            data: {classid: $("#MyClass").val(), roomid: $("#MyRoom").val(), edyear: $("#MyEdYear").val()},
            success: function (data) {
                $('#StudentRegisterBody').html(data);
            }
        });
    }
</script>
