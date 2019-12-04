<!--
/*
  | ----------------------------------------------------------------------------
  |  Title  HR01 
  | ----------------------------------------------------------------------------
  | Copyright	Edutech Co.,Ltd.
  | Purpose     ข้อมูลทั่วไป (ข้อมูลพื้นฐาน)
  | Author	นายบัณฑิต ไชยดี
  | Create Date November 8, 2018
  | Last edit	-
  | Comment	-
  | ----------------------------------------------------------------------------
 */
-->
<div class="panel panel-primary">
    <div class="panel-heading">บันทึกบุคลากร [ ข้อมูลทั่วไป ]</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <?php
        $hr_id = $this->session->userdata('hr_id');
        $checker = $this->uri->segment(2);

        if ($hr_id != $checker) {
            ?>
            <li><?php echo anchor("human_resources", "ทำเนียบบุคลากร"); ?></li>
        <?php } else { ?>
            <li><?php echo anchor("hr-member-profile", "ข้อมูลผู้ใช้"); ?></li>
        <?php } ?>

        <li>บันทึก</li>
    </ul>
    <div class="panel-body">
        <div class="container">
            <form method="post" id="insert-form" enctype="multipart/form-data" >
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label">คำนำหน้า</label><span class="star">&#42;</span>
                        <select name="inHrSymbol" id="inHrSymbol" class="form-control" required>
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="control-label">ชื่อ (ภาษาไทย)</label><span class="star">&#42;</span>
                        <input type="text" name="inHrThaiName" id="inHrThaiName" class="form-control" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="control-label">นามสกุล (ภาษาไทย)</label><span class="star">&#42;</span>
                        <input type="text" name="inHrThaiLastname" id="inHrThaiLastname" class="form-control" required />
                    </div>
                </div>

                <div class="row" style="margin-top:15px;">
                    <div class="col-md-4 form-group">
                        <label class="control-label">ชื่อ (ภาษาอังกฤษ)</label>
                        <?php echo form_input(array("type" => "text", "name" => "inHrEngName", "id" => "inHrEngName", "class" => "form-control")); ?>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="control-label">นามสกุล (ภาษาอังกฤษ)</label>
                        <?php echo form_input(array("type" => "text", "name" => "inHrEngLastname", "id" => "inHrEngLastname", "class" => "form-control")); ?>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="control-label">เลขที่บัตรประชาชน</label>
                        <?php echo form_input(array("type" => "text", "name" => "inHrIdCard", "id" => "inHrIdCard", "class" => "form-control", "required" => "required")); ?>
                    </div>
                </div>

                <div class="row" style="margin-top:15px;">
                    <div class="form-group col-md-5">
                        <label class="control-label">วัน/เดือน/ปี เกิด</label><span class="star">&#42;</span>
                        <div class="form-group">
                            <select name="inHrDayBirthday" id="inHrDayBirthday" class="my-select" style="width:30%;" required>
                                <option value="">---วันที่---</option>
                                <?php for ($i = 1; $i <= 31; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                            <!-- Month -->
                            <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                            <select name="inHrMonthBirthday" id="inHrMonthBirthday" class="my-select" style="width:30%;" required>
                                <option value="">---เดือน---</option>
                                <?php foreach ($arr as $key => $value): ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <select name="inHrYearBirthday" id="inHrYearBirthday" class="my-select" style="width:30%;" required>
                                <option value="">---พ.ศ.---</option>
                                <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label">สัญชาติ</label><span class="star">&#42;</span>
                        <?php echo form_input(array("type" => "text", "name" => "inHrNationality", "id" => "inHrNamtionlity", "class" => "form-control", "required" => "required")); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="control-label">เชื้อชาติ</label><span class="star">&#42;</span>
                        <?php echo form_input(array("type" => "text", "name" => "inHrOrigin", "id" => "inHrOrigin", "class" => "form-control", "required" => "required")); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="control-label">ศาสนา</label><span class="star">&#42;</span>
                        <?php echo form_input(array("type" => "text", "name" => "inHrReligion", "id" => "inHrReligion", "class" => "form-control", "required" => "required")); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">กลุ่มเลือด</label>
                        <?php echo form_input(array("type" => "text", "name" => "inHrBloodGroup", "id" => "inHrBloodGroup", "class" => "form-control")); ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">ชื่อ-นามสกุล บิดา</label>
                        <?php echo form_input(array("type" => "text", "name" => "inHrFatherName", "id" => "inHrFatherName", "class" => "form-control")); ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">ชื่อ-นามสกุล มารดา</label>
                        <?php echo form_input(array("type" => "text", "name" => "inHrMotherName", "id" => "inHrMotherName", "class" => "form-control")); ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">สถานะภาพ</label>
                        <div>
                            <input class="magic-radio" type="radio" name="inHrStatus" value="โสด" id="r1" required><label for="r1">โสด</label><?php echo nbs(); ?>
                            <input class="magic-radio" type="radio" name="inHrStatus" value="แต่งงาน" id="r2"><label for="r2">แต่งงาน</label>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-12" id="marry" style="display:none;padding:0px;">
                        <div class="col-md-3 form-group">
                            <label class="control-label">ชื่อคู่สมรส</label>
                            <?php echo form_input(array('type' => 'text', 'name' => 'inHrConsortName', 'id' => 'inHrConsortName', 'class' => 'form-control')); ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">นามสกุลคู่สมรส</label>
                            <?php echo form_input(array('type' => 'text', 'name' => 'inHrConsortLastname', 'id' => 'inHrConsortLastname', 'class' => 'form-control')); ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">จำนวนบุตรชาย</label>
                            <?php echo form_input(array('type' => 'text', 'name' => 'inHrSon', 'id' => 'inHrSon', 'class' => 'form-control')); ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">จำนวนบุตรสาว</label>
                            <?php echo form_input(array('type' => 'text', 'name' => 'inHrDaugther', 'id' => 'inHrDaugther', 'class' => 'form-control')); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-5">
                        <label class="control-label">ภาพบุคลากร</label>
                        <input type="file" name="inHrImage" id="inHrImage" class="filestyle" />
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <center>
                        <button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button>
                    </center>
                </div>
                <p style="color:#666;">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</p>
            </form>
        </div>
    </div>
    <div class="panel-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8">
                <?php echo img("images/kmk_logo.png"); ?>
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 4.0 (2018)</span></span>
            </div>
        </div>
    </div>
</div>
<script>
    $('input[type=radio][name=inHrStatus]').change(function () {
        if (this.value == 'แต่งงาน') {
            $("#marry").show(200);
        } else {
            $("#marry").hide(200);
        }
    });
    //
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        var image = $("#inHrImage").val();
        var ext = $("#inHrImage").val().split('.').pop().toLowerCase();
        if (image != "") {
            if (jQuery.inArray(ext, ['jpg']) == -1) {
                alert("ไฟล์ภาพบุคลากรจะต้องเป็นชนิด JPG เท่านั้น");
                $(":file").filestyle("clear");
                return false;
            }
        }
        $.ajax({
            url: "<?php echo site_url('human_resources/hr_01_insert'); ?>",
            method: "POST",
            data: new FormData($("#insert-form")[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                var uid = jQuery.parseJSON(data);
                $("#insert-form")[0].reset();
                location.href = "<?php echo site_url('hr02/'); ?>" + uid.insert_id;
            }
        });
    });
</script>