<div class="box">
    <div class="box-heading">ข้อมูลนักเรียน</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('std-base', "ข้อมูลนักเรียน"); ?></li>
        <li>บันทึกข้อมูล</li>
    </ul>
    <div class="box-body" >
        <div class="container-fluid">
            <form method="post" id="insert-form" enctype="multipart/form-data">
                <div class="row">
                    <div class="row">
                        <b>ข้อมูลพื้นฐาน</b>
                        <br></br>
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">คำนำหน้าชื่อ</label>
                        <select name="inStdTitlename" id="inStdTitlename" class="form-control"  autofocus required="" >
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="เด็กชาย">เด็กชาย</option>
                            <option value="เด็กหญิง">เด็กหญิง</option>
                            <option value="นาย">นาย</option>
                            <option value="นางสาว">นางสาว</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">ชื่อจริง</label>
                        <input type="text" name="inStdFirstname" id="inStdFirstname" class="form-control" autofocus  required=""/>
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">นามสกุล</label>
                        <input type="text" name="inStdLastname" id="inStdLastname" class="form-control" autofocus  required=""/>
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">ชื่อเล่น</label>
                        <input type="text" name="inStdNickname" id="inStdNickname" class="form-control" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">รหัสบัตรประชาชน</label>
                        <input type="text" name="inStdIdcard" id="inStdIdcard" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 form-group">
                        <label class="control-label">ศาสนา</label>
                        <select name="inStdReligion" id="inStdReligion" class="form-control"   >
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="พุทธ">พุทธ</option>
                            <option value="คริสต์">คริสต์</option>
                            <option value="อิสลาม">อิสลาม</option>
                            <option value="เอทิส">เอทิส</option>
                        </select>                       
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">สัญชาติ</label>
                        <select name="inStdNationality" id="inStdNationality" class="form-control"   >
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="ไทย">ไทย</option>
                            <option value="ลาว">ลาว</option>
                            <option value="พม่า">พม่า</option>
                            <option value="จีน">จีน</option>
                        </select>                          
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">เชื้อชาติ</label>
                        <select name="inStdEthnicity" id="inStdEthnicity" class="form-control"   >
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="ไทย">ไทย</option>
                            <option value="ลาว">ลาว</option>
                            <option value="พม่า">พม่า</option>
                            <option value="จีน">จีน</option>   
                        </select> 
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">รหัสนักเรียน</label>
                        <input type="text" name="inStdId" id="inStdId" class="form-control" />
                    </div>
                </div>

                <div class="row">
                    <div class="row">
                        <b>ข้อมูลด้านสุขภาพ</b>
                        <br></br>
                    </div>
                    <div class="col-md-5 form-group">
                        <label class="control-label">วันเดือนปีเกิด</label>
                        <div class="form-group">
                            <select name="inStdBirthday" id="inStdBirthday" class="my-select" style="width:30%;" >
                                <option value="">---วันที่---</option>
                                <?php for ($i = 1; $i <= 31; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                            <!-- Month -->
                            <?php $arr = array('1' => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม", "4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน", "7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"); ?>
                            <select name="inStdBirthmonth" id="inStdBirthmonth" class="my-select" style="width:30%;" >
                                <option value="">---เดือน---</option>
                                <?php foreach ($arr as $key => $value): ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <select name="inStdBirthyear" id="inStdBirthyear" class="my-select" style="width:30%;" >
                                <option value="">---พ.ศ.---</option>
                                <?php for ($i = 2450; $i <= (date("Y") + 543); $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 form-group">
                        <label class="control-label">โรงพยาบาลเกิด</label>
                        <input type="text" name="inStdBirthhospital" id="inStdBirthhospital" class="form-control" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">หมู่เลือด</label>
                        <select name="inStdBloodtype" id="inStdBloodtype" class="form-control"  >
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="โอ">โอ</option>
                            <option value="บี">บี</option>
                            <option value="เอ">เอ</option>
                            <option value="เอบี">เอบี</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">ความบกพร่องทางร่างกาย</label>
                        <select name="inStdDisabled" id="inStdDisabled" class="form-control"  >
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="พิการทางสายตา">พิการทางสายตา</option>
                            <option value="พิการทางการได้ยิน">พิการทางการได้ยิน</option>
                            <option value="พิการทางการพูด">พิการทางการพูด</option>
                        </select>
                    </div>
                </div> 
                <div class="row">

                    <div class="col-md-6 form-group">
                        <label class="control-label">โรคประจำตัว</label>
                        <input type="text" name="inStdCongenitalDisease" id="inStdCongenitalDisease" class="form-control" />
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label">ข้อมูลการแพ้ยา</label>
                        <input type="text" name="inStdAllergic" id="inStdAllergic" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <b>ข้อมูลที่อยู่</b>
                        <br></br>
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">บ้านเลขที่</label>
                        <input type="text" name="inAddNo" id="inAddNo" class="form-control" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">หมู่</label>
                        <input type="text" name="inAddMoo" id="inAddMoo" class="form-control" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">ชื่อหมู่บ้าน</label>
                        <input type="text" name="inAddVillage" id="inAddVillage" class="form-control" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">ชื่อถนน</label>
                        <input type="text" name="inAddRoad" id="inAddRoad" class="form-control" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">ตำบล</label>
                        <input type="text" name="inAddTambol" id="inAddTambol" class="form-control" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">อำเภอ</label>
                        <input type="text" name="inAddAmphur" id="inAddAmphur" class="form-control" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">จังหวัด</label>
                        <input type="text" name="inAddProvince" id="inAddProvince" class="form-control" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">รหัสไปรษณีย์</label>
                        <input type="text" name="inAddZipcode" id="inAddZipcode" class="form-control" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">ประเภทที่อยู่อาศัย</label>
                        <select name="inAddType" id="inAddType" class="form-control">
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="บ้าน">บ้าน</option>
                            <option value="หอพัก">หอพัก</option>
                            <option value="ห้องเช่า">ห้องเช่า</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="row">
                        <b>ข้อมูลผู้ปกครอง</b>
                        <br></br>
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">ความเกี่ยวข้อง</label>
                        <select name="inFmAbout" id="inFmAbout" class="form-control"   >
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="บิดา">บิดา</option>
                            <option value="มารดา">มารดา</option>
                            <option value="ลุง">ลุง</option>
                            <option value="ป้า">ป้า</option>
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">คำนำหน้าชื่อ</label>
                        <select name="inFmTitlename" id="inFmTitlename" class="form-control"   >
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="นาย">นาย</option>
                            <option value="นางสาว">นางสาว</option>
                            <option value="นาง">นาง</option>
                            <option value="ดร.">ดร.</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">ชื่อจริง</label>
                        <input type="text" name="inFmFirstname" id="inFmFirstname" class="form-control" />
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">นามสกุล</label>
                        <input type="text" name="inFmLastname" id="inFmLastname" class="form-control" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">รหัสบัตรประชาชน</label>
                        <input type="text" name="inFmIdcard" id="inFmIdcard" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 form-group">
                        <label class="control-label">ศาสนา</label>
                        <select name="inFmReligion" id="inFmReligion" class="form-control"   >
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="พุทธ">พุทธ</option>
                            <option value="คริสต์">คริสต์</option>
                            <option value="อิสลาม">อิสลาม</option>
                            <option value="เอทิส">เอทิส</option>
                        </select>                       
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">สัญชาติ</label>
                        <select name="inFmNationality" id="inFmNationality" class="form-control"   >
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="ไทย">ไทย</option>
                            <option value="ลาว">ลาว</option>
                            <option value="พม่า">พม่า</option>
                            <option value="จีน">จีน</option>
                        </select>                          
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">เชื้อชาติ</label>
                        <select name="inFmEthnicity" id="inFmEthnicity" class="form-control"   >
                            <option value="">---เลือกข้อมูล---</option>
                            <option value="ไทย">ไทย</option>
                            <option value="ลาว">ลาว</option>
                            <option value="พม่า">พม่า</option>
                            <option value="จีน">จีน</option>   
                        </select> 
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="control-label">สถานภาพ</label>
                        <select name="inFmStatus" id="inFmStatus" class="form-control"   >
                            <option value="มีชีวิต">---มีชีวิต---</option>  
                        </select> 
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="control-label">สถานภาพสมรส</label>
                        <select name="inFmRelationship" id="inFmRelationship" class="form-control"   >
                            <option value="">---เลือกข้อมูล---</option>  
                            <option value="จดทะเบียนสมรสและอยู่ด้วยกัน">จดทะเบียนสมรสและอยู่ด้วยกัน</option> 
                            <option value="จดทะเบียนสมรสและไม่ได้อยู่ด้วยกัน">จดทะเบียนสมรสและไม่ได้อยู่ด้วยกัน</option>  
                            <option value="ไม่ได้จดทะเบียนสมรสและอยู่ด้วยกัน">ไม่ได้จดทะเบียนสมรสและอยู่ด้วยกัน</option>  
                            <option value="ไม่ได้จดทะเบียนสมรสและไม่ได้อยู่ด้วยกัน">ไม่ได้จดทะเบียนสมรสและไม่ได้อยู่ด้วยกัน</option>  
                            <option value="หย่าร้าง">หย่าร้าง</option>  
                        </select> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label class="control-label">อาชีพ</label>
                        <input type="text" name="inFmCareerName" id="inFmCareerName" class="form-control" />
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="control-label">ชื่อบริษัท</label>
                        <input type="text" name="inFmCompanyName" id="inFmCompanyName" class="form-control" />
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="control-label">รายได้ต่อเดือน(เงินบาท)</label>
                        <input type="text" name="inFmIncome" id="inFmIncome" class="form-control" />
                    </div>
                </div>

                <div class="row">
                    <div class="row">
                        <b>ภาพประกอบ</b>
                        <br></br>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="control-label">ภาพประจำตัวนักเรียน</label>
                        <input type="file" name="inStdImage" id="inStdImage" class="filestyle" />
                    </div>
                </div>
                <div class="row">
                    <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                </div>
            </form>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        var image = $('#inStdImage').val();
        var ext1 = $("#inStdImage").val().split('.').pop().toLowerCase();

        //
        if ((image != "" && jQuery.inArray(ext1, ['jpg']) == -1)) {
            alert("ไฟล์ภาพจะต้องเป็นชนิด jpg เท่านั้น");
            $(":file").filestyle('clear');
            return false;
        }
        //
        $.ajax({
            url: "<?php echo site_url('std-insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>
