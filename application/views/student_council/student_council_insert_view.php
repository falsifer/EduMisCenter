<div class="box">
    <div class="box-heading">เพิ่มกิจกรรมสภานักเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('student-council', "กิจกรรมสภานักเรียน"); ?></li>
        <li>เพิ่มกิจกรรมสภานักเรียน</li>
    </ul>
    <div class="box-body" >
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <label class="control-label">กิจกรรม</label>
                                <input type="text" name="inTbStudentCouncilContent" id="inTbStudentCouncilContent" class="form-control" autofocus  required=""/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">วัน เดือน ปี</label>
                                <input type="text"  autocomplete="off"name="inTbStudentCouncilDate" id="inTbStudentCouncilDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required/>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">รายละเอียดกิจกรรม</label>
                                <textarea id="inTbStudentCouncilDetail" name="inTbStudentCouncilDetail" style="width:100%;height:100px;"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label class="control-label">ภาพกิจกรรม1</label>
                                <input type="file" name="inTbStudentCouncilImg1" id="inTbStudentCouncilImg1" class="filestyle" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">ภาพกิจกรรม2</label>
                                <input type="file" name="inTbStudentCouncilImg2" id="inTbStudentCouncilImg2" class="filestyle" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">ภาพกิจกรรม3</label>
                                <input type="file" name="inTbStudentCouncilImg3" id="inTbStudentCouncilImg3" class="filestyle" />
                            </div>
                        </div>
                    </div>    

                    <div class="row">
                        <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>
                </form>
            </div>
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
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
       

        $.ajax({
            url: "<?php echo site_url('student-council-insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                alert("บันทึกข้อมูลสำเร็จ");
//                $("#insert-form")[0].reset();
//                location.reload();
                location.href = "<?php echo site_url('student-council'); ?>";
            }
        });
    });
</script>
