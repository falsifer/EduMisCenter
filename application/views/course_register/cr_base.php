<div class="box">
    <div class="box-heading">ลงทะเบียนเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ลงทะเบียนเรียน</li>
    </ul>
    <div class="box-body">
        <form method="post" id="register-course-insert-form" enctype="multipart/form-data">
            <?php
            $data['term'] = 'Y';
            $data['class'] = 'Y';
            $data['room'] = 'Y';
            $this->load->view('layout/my_school_filter', $data);
            ?>            
            <br/>
            <div class="row" >
                <div class="col-md-12">
                    <div class="row" id="StudentRegisterBody">

                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<?php $this->load->view("course_register/cr_std_modal"); ?>

<script>

    function CourseClickCheckAll(e) {
        for (i = 0; i < $('#Tab' + e.id).val(); i++) {
            if ($('#Tab' + e.id + "_CourseNum" + i).is(':checked')) {
                $('#Tab' + e.id + "_CourseNum" + i).prop('checked', false);
            } else {
                $('#Tab' + e.id + "_CourseNum" + i).prop('checked', true);
            }
        }
    }
</script>

<script>

    var MyStdBoolean = 0;
    function StdClickCheckAll(e) {
        var ss = "";
        if (MyStdBoolean == 0) {
            for (i = 0; i < $('#StdCount').val(); i++) {
                ss = $('#StdIdArray').val().split(",")[i];
                $('#StdId' + ss).prop('checked', true);
            }
            MyStdBoolean = 1;
        } else {
            for (i = 0; i < $('#StdCount').val(); i++) {
                ss = $('#StdIdArray').val().split(",")[i];
                $('#StdId' + ss).prop('checked', false);
            }
            MyStdBoolean = 0;
        }

    }


    function ClickRegisterCourse(e) {
        $.ajax({
            url: "<?php echo site_url('Course_register/register_course'); ?>",
            method: "post",
            data: new FormData($("#register-course-insert-form")[0]),
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                alert("ลงทะเบียนสำเร็จ");
//                FilterCourse(e);
            }
        });

    }

    var stdid = 0;
    function StdClick(e) {
        stdid = e.id;
        $.ajax({
            url: "<?php echo site_url('Course_register/cr_std_modal'); ?>",
            method: "post",
            data: {id: stdid},
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();

                $("#std-register-course-body").html(data);
                $("h3.modal-title").text("ข้อมูลการลงทะเบียนเรียนรายบุคคล");
                $("#cr-std-modal").modal("show");
            }
        });

    }

    function MyEdTest(e) {
        FilterCourse(e);
    }

    function MyRoomOnChange(e) {
        FilterCourse(e);
    }

    function FilterCourse(e) {
        $.ajax({
            url: "<?php echo site_url('Course_register/course_register_base'); ?>",
            method: "post",
            data: {classid: $("#MyClass").val(), roomid: $("#MyRoom").val(), edyear: $("#MyEdYear").val(), term: $("#MyTerm").val()},
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                $('#StudentRegisterBody').html(data);
            }
        });
    }
</script>

