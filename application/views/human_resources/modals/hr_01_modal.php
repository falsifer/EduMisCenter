<!-- Modal -->
<div id="hr-01-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                <form method="post" id="insert-form" enctype="multipart/form-data" >
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label">ประเภทบุคลากร</label>
                            <select name="inHrTypeId" id="inHrTypeId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($hr_type as $type): ?>
                                    <option value="<?php echo $type['id']; ?>"><?php echo $type['human_resources_type']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">คำนำหน้า</label><span class="star">&#42;</span>
                            <select name="inHrThaiSymbol" id="inHrThaiSymbol" class="form-control" required>
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
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label">คำนำหน้า (อังกฤษ)</label><span class="star">&#42;</span>
                            <select name="inHrEngSymbol" id="inHrEngSymbol" class="form-control" >
                                <option value="">---เลือกข้อมูล---</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Miss">Miss</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ชื่อ (อังกฤษ)</label>
                            <?php echo form_input(array("type" => "text", "name" => "inHrEngName", "id" => "inHrEngName", "class" => "form-control")); ?>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">นามสกุล (อังกฤษ)</label>
                            <?php echo form_input(array("type" => "text", "name" => "inHrEngLastname", "id" => "inHrEngLastname", "class" => "form-control")); ?>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">เลขที่บัตรประชาชน</label>
                            <?php echo form_input(array("type" => "text", "name" => "inHrIdCard", "id" => "inHrIdCard", "class" => "form-control", "required" => "required")); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">วัน/เดือน/ปี เกิด</label><span class="star">&#42;</span>
                            <div class="form-group">
                                <select name="inHrDayBirthday" id="inHrDayBirthday" class="my-select" style="width:30%;" >
                                    <option value="">---วันที่---</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                                <!-- Month -->
                                <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                                <select name="inHrMonthBirthday" id="inHrMonthBirthday" class="my-select" style="width:30%;" >
                                    <option value="">---เดือน---</option>
                                    <?php foreach ($arr as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select name="inHrYearBirthday" id="inHrYearBirthday" class="my-select" style="width:30%;" >
                                    <option value="">---พ.ศ.---</option>
                                    <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">สัญชาติ</label><span class="star">&#42;</span>
                            <?php echo form_input(array("type" => "text", "name" => "inHrNationality", "id" => "inHrNationality", "class" => "form-control")); ?>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">เชื้อชาติ</label><span class="star">&#42;</span>
                            <?php echo form_input(array("type" => "text", "name" => "inHrOrigin", "id" => "inHrOrigin", "class" => "form-control")); ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ศาสนา</label><span class="star">&#42;</span>
                            <?php echo form_input(array("type" => "text", "name" => "inHrReligion", "id" => "inHrReligion", "class" => "form-control")); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <label class="control-label">กลุ่มเลือด</label>
                            <select name="inHrBloodGroup" id="inHrBloodGroup" class="form-control"  >
                                <option value="">---เลือกข้อมูล---</option>
                                <option value="โอ">โอ</option>
                                <option value="บี">บี</option>
                                <option value="เอ">เอ</option>
                                <option value="เอบี">เอบี</option>
                            </select> 
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">สถานะภาพ</label>
                            <select name="inHrStatus" id="inHrStatus" class="form-control">
                                <option value="">---ข้อมูล---</option>
                                <option value="โสด">โสด</option>
                                <option value="แต่งงาน">แต่งงาน</option>
                                <option value="หย่าร้าง">หย่าร้าง</option>
                                <option value="ไม่ระบุ">ไม่ระบุ</option>
                            </select>
                        </div>
                        <!--                        <div class="col-md-3">
                                                    <label class="control-label">ชื่อ-นามสกุล บิดา</label>
                        <?php echo form_input(array("type" => "text", "name" => "inHrFatherName", "id" => "inHrFatherName", "class" => "form-control")); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label">ชื่อ-นามสกุล มารดา</label>
                        <?php echo form_input(array("type" => "text", "name" => "inHrMotherName", "id" => "inHrMotherName", "class" => "form-control")); ?>
                                                </div>-->
                        <div class="col-md-3 form-group">
                            <label class="control-label">โทรศัพท์มือถือ</label>
                            <input type="text" name="inHrMobile" id="inHrMobile" class="form-control" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">อีเมล์</label>
                            <input type="text" name="inHrEmail" id="inHrEmail" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ระดับ</label>
                            <select name="inHrDegree" id="inHrDegree" class="form-control">
                                <option value="">--ข้อมูล--</option>
                                <?php foreach ($tbHrDegree as $r): ?>
                                    <option value="<?php echo $r['tb_hr_degree_name']; ?>"><?php echo $r['tb_hr_degree_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        

<!--                        <div class="form-group col-md-3">
                            <label class="control-label">ตำแหน่งปัจจุบัน</label>
                            <select name="inHrRank" id="inHrRank" class="form-control">
                                <option value="">--ข้อมูล--</option>
                                <?php foreach ($rank as $r): ?>
                                    <option value="<?php echo $r['rank_name']; ?>"><?php echo $r['rank_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>-->
                        

                        <!--                        <div class="form-group col-md-3">
                                                    <label class="control-label">ระดับ</label>
                                                    <input type="hidden" name="inHrLevel" id="inHrLevel" class="form-control" />
                                                </div>-->
<!--                        <div class="form-group col-md-3">
                            <label class="control-label">ระดับเงินเดือน</label>
                            <input type="number" name="inSalary" id="inSalary" class="form-control" />
                        </div>-->

                    </div>
                    <div class="row">

                        <div class="form-group col-md-3">
                            <label class="control-label">กลุ่มสาระการเรียนรู้</label>
                            <select name="inHrGroupLearning" id="inHrGroupLearning" class="form-control">
                                <option value="">--ข้อมูล--</option>
                                <?php foreach ($tbGroupLearning as $r): ?>
                                    <option value="<?php echo $r['tb_group_learningcol_name']; ?>"><?php echo $r['tb_group_learningcol_name']; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ตำแหน่ง(กลุ่มสาระการเรียนรู้)</label>
                            <select name="inHrGroupLearningClass" id="inHrGroupLearningClass" class="form-control">
                                <option value="">--ข้อมูล--</option>
                                <option value="เจ้าหน้าที่">เจ้าหน้าที่</option>
                                <option value="หัวหน้า">หัวหน้า</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="control-label">ฝ่ายงาน</label>
                            <select name="inHrDivision" id="inHrDivision" class="form-control">
                                <option value="">--ข้อมูล--</option>
                                <?php foreach ($tbDivision as $r): ?>
                                    <option value="<?php echo $r['tb_division_name']; ?>"><?php echo $r['tb_division_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="control-label">ตำแหน่ง(ฝ่ายงาน)</label>
                            <select name="inHrDivisionClass" id="inHrDivisionClass" class="form-control">
                                <option value="">--ข้อมูล--</option>
                                <option value="เจ้าหน้าที่">เจ้าหน้าที่</option>
                                <option value="หัวหน้า">หัวหน้า</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">


                        <!--                        <div class="form-group col-md-3">
                                                    <label class="control-label">หน่วยงาน</label>
                                                    <select name="inHrOffice" id="inHrOffice" class="form-control">
                                                        <option value="">--ข้อมูล--</option>
                        <?php foreach ($school as $sc): ?>
                                                                <option value="<?php echo $sc['sc_thai_name']; ?>"><?php echo $sc['sc_thai_name']; ?></option>
                        <?php endforeach; ?>
                                                        <option value="กอง/สำนัก การศึกษา">กอง/สำนัก การศึกษา</option>
                                                    </select>
                                                </div>-->


<!--                        <div class="form-group col-md-3">
                            <label class="control-label">ภาพบุคลากร</label>
                            <input type="file" name="inHrImage" id="inHrImage" class="filestyle" />
                        </div>-->

                        <div class="col-md-12" id="marry" style="display:none;padding:0px;">
                            <div class="col-md-3 form-group">
                                <label class="control-label">ชื่อคู่สมรส</label>
                                <?php echo form_input(array('type' => 'text', 'name' => 'inHrConsortName', 'id' => 'inHrConsortName', 'class' => 'form-control')); ?>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">จำนวนบุตรชาย</label>
                                <?php echo form_input(array('type' => 'text', 'name' => 'inHrSonAmount', 'id' => 'inHrSonAmount', 'class' => 'form-control')); ?>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">จำนวนบุตรสาว</label>
                                <?php echo form_input(array('type' => 'text', 'name' => 'inHrDaugtherAmount', 'id' => 'inHrDaugtherAmount', 'class' => 'form-control')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <center>
                            <button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button>
                        </center>
                    </div>
                    <p style="color:#666;">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</p>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
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
//        var image = $("#inHrImage").val();
//        var ext = $("#inHrImage").val().split('.').pop().toLowerCase();
//        if (image != "") {
//            if (jQuery.inArray(ext, ['jpg']) == -1) {
//                alert("ไฟล์ภาพบุคลากรจะต้องเป็นชนิด JPG เท่านั้น");
//                $(":file").filestyle("clear");
//                return false;
//            }
//        }
        $.ajax({
            url: "<?php echo site_url("insert-human-resources-part-1"); ?>",
            method: "POST",
            data: new FormData($("#insert-form")[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>