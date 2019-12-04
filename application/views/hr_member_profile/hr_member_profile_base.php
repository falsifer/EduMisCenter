<div class="box">
    <div class="box-heading" style="background-color: #38C5C5;"> ข้อมูลส่วนบุคคล(<?php echo $this->session->userdata('name') ?>)</div>
    <div class="box-body" >
        <div style="padding:35px;">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">

                    <div class="row" >
                        <div class="btn-group" style='float: right;'>
                            <button type="button" data-toggle="dropdown" class="btn btn-danger dropdown-toggle" style="height: 30px;float: right;margin-right:5px;">
                                <i class="icon-user icon-large" style="font-size:1.2em;"></i> ข้อมูลอื่น ๆ <span class="caret"></span>                                    
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu" style="margin-bottom:60px;">
                                <?php $hr_id = $this->session->userdata('hr_id'); ?>
                                <!--<li><a href="#" class="btn-hr-01" id="<?php echo $hr_id; ?>">1) ข้อมูลทั่วไป</a></li>-->
                                <!--<li><a href="#" class="btn-hr-01" id="<?php echo $hr_id; ?>">1) ข้อมูลทั่วไป</a></li>-->
                                <li><a href="<?php echo site_url('human-resources-part-02/' . $hr_id); ?>">2) ข้อมูลที่อยู่</a></li>
                                <li><a href="<?php echo site_url('human-resources-part-03/' . $hr_id); ?>">3) ข้อมูลครอบครัว</a></li>
                                <li><a href="<?php echo site_url('human-resources-part-15/' . $hr_id); ?>">4) ประวัติการศึกษา</a></li>
                                <li><a href="<?php echo site_url('human-resources-part-05/' . $hr_id); ?>">5) ประวัติการรับราชการ</a></li>
                                <li><a href="<?php echo site_url('human-resources-part-04/' . $hr_id); ?>">6) ประวัติการปฏิบัติงาน</a></li>
                                <li><a href="<?php echo site_url('human-resources-part-06/' . $hr_id); ?>">7) ประวัติการสอน</a></li>
                                <li><a href="<?php echo site_url('human-resources-part-07/' . $hr_id); ?>">8) ประวัติการฝึกอบรม-ศึกษาดูงาน</a></li>
                                <li><a href="<?php echo site_url('human-resources-part-08/' . $hr_id); ?>">9) ประวัติการเลื่อนตำแหน่ง</a></li>
                                <li><a href="<?php echo site_url('human-resources-part-09/' . $hr_id); ?>">10) ประวัติการสร้างผลงาน</a></li>
                                <li><a href="<?php echo site_url('human-resources-part-10/' . $hr_id); ?>">11) ข้อมูลใบประกอบวิชาชีพ</a></li>
                                <!--<li><a href="<?php echo site_url('er-base') ?>">12) คลังผลงานวิจัย</a></<li>-->
                                <!--<li><a href="<?php echo site_url('human-resources-part-11/' . $hr_id); ?>">12) ข้อมูลการลาทุกประเภท/การขาด</a></li>-->
                                <li><a href="<?php echo site_url('human-resources-part-12/' . $hr_id); ?>">13) ข้อมูลการกระทำความผิด</a></li>
                                <li><a href="<?php echo site_url('human-resources-part-13/' . $hr_id); ?>">14) ข้อมูลการรับเครื่องราชอิสริยาภรณ์</a></li>
                                <li><a href="<?php echo site_url('human-resources-part-14/' . $hr_id); ?>">15) ข้อมูลด้านอื่น ๆ</a></li>

                            </ul>
                        </div> 
                        <button type="button" data-toggle="collapse" data-target="#HrProfile" class="btn btn-primary " style="width: 25%;height: 30px;float: right;margin-right:5px;">
                            <i class="icon-user icon-large" style="font-size:1.2em;"> ข้อมูลส่วนบุคคล</i>                                      
                        </button>
                        <button type="button" data-toggle="collapse" data-target="#MemberProfile" class="btn btn-info " style="width: 20%;height: 30px;float: right;margin-right:5px;">
                            <i class="icon-user icon-large" style="font-size:1.2em;"> ข้อมูลผู้ใช้</i>                                      
                        </button>

                    </div> 


                    <div class='row'>                
                        <form method="post" id="insert-form" enctype="multipart/form-data" >
                            <div class='row collapse' id="MemberProfile">
                                <div class="col-md-4 form-group">
                                    <center>
                                        <label class="control-label">ลายเซ็น</label>
                                        <br/>
                                        <img id='Signature' alt="คลิกเพื่ออัพโหลดลายเซ็น" class='btn btn-signature-file img-thumbnail' src="" style='height: 60px;'/>
                                        <input type="file" name="inSignature" id="inSignature" style='display:none' onchange="readURL2(this)"/>
                                        <script>
                                            $('.btn-signature-file').click(function () {
                                                $('#inSignature').click();
                                            });
                                            function readURL2(input) {
                                                if (input.files && input.files[0]) {
                                                    var reader = new FileReader();

                                                    reader.onload = function (e) {
                                                        $('#Signature')
                                                                .attr('src', e.target.result)
                                                                .width(120)
                                                                .height(60);
                                                    };

                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            }
                                        </script>
                                    </center>
                                </div>

                                <div class='col-md-8 form-group' >

                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Username</label><span class="star">&#42;</span>
                                        <input type="text" name="inUsername" id="inUsername" class="form-control"  required readonly/>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Password</label><span class="star">&#42;</span>
                                        <input type="text" name="inPassword" id="inPassword" class="form-control"  required />
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class='collapse in' id="HrProfile">
                                <div class="row">
                                    <div class="col-md-3">
                                        <center>
                                            <label class="control-label">ภาพประจำตัว</label>                                
                                            <img onclick='HrFileThis(this)' alt="คลิกเพื่ออัพโหลดภาพโปรไฟล์" id='blah' class='btn btn-hr-file img-thumbnail' src="" style='width: 190px;height: 190px;'/>
                                            <input type="file" name="inHrImage" id="inHrImage" style='display:none' onchange="readURL(this)"/>
                                            <script>
                                                $('.btn-hr-file').click(function () {
                                                    $('#inHrImage').click();
                                                });
                                                function readURL(input) {
                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();

                                                        reader.onload = function (e) {
                                                            $('#blah')
                                                                    .attr('src', e.target.result)
                                                                    .width(150)
                                                                    .height(150);
                                                        };

                                                        reader.readAsDataURL(input.files[0]);
                                                    }
                                                }
                                            </script>
                                        </center>
                                    </div>
                                    <div class='col-md-9'>


                                        <div class="col-md-3">
                                            <label class="control-label">คำนำหน้า</label><span class="star">&#42;</span>
                                            <input type="text" name="inHrThaiSymbol" id="inHrThaiSymbol" class="form-control"  required />

                                        </div>
                                        <div class="col-md-5 form-group">
                                            <label class="control-label">ชื่อ (ภาษาไทย)</label><span class="star">&#42;</span>
                                            <input type="text" name="inHrThaiName" id="inHrThaiName" class="form-control"  required />
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">นามสกุล (ภาษาไทย)</label><span class="star">&#42;</span>
                                            <input type="text" name="inHrThaiLastname" id="inHrThaiLastname" class="form-control"  required />
                                        </div>


                                        <div class="col-md-4">
                                            <label class="control-label">Title Name</label>
                                            <select name="inHrEngSymbol" id="inHrEngSymbol" class="form-control" >
                                                <option value="">---เลือกข้อมูล---</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Miss">Miss</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">Name</label>
                                            <?php echo form_input(array("type" => "text", "name" => "inHrEngName", "id" => "inHrEngName", "class" => "form-control")); ?>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">Surname</label>
                                            <?php echo form_input(array("type" => "text", "name" => "inHrEngLastname", "id" => "inHrEngLastname", "class" => "form-control")); ?>
                                        </div>

                                        <!--                                <div class="col-md-3 form-group">
                                                                            <label class="control-label">ตำแหน่ง</label>
                                        <?php echo form_input(array("type" => "text", "name" => "inHrRank", "id" => "inHrRank", "class" => "form-control", "required" => "required")); ?>
                                                                        </div>
                                                                        <div class="col-md-3 form-group">
                                                                            <label class="control-label">เลขที่ตำแหน่ง</label>
                                        <?php echo form_input(array("type" => "text", "name" => "inHrPositionId", "id" => "inHrPositionId", "class" => "form-control", "required" => "required")); ?>
                                                                        </div>-->
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">เลขที่บัตรประชาชน</label>
                                            <?php echo form_input(array("type" => "text", "name" => "inHrIdCard", "id" => "inHrIdCard", "class" => "form-control", "required" => "required")); ?>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label class="control-label">วัน/เดือน/ปี เกิด</label>
                                            <div class="form-group">
                                                <select name="inHrDayBirthday" id="inHrDayBirthday" class="my-select" style="width:30%;" >
                                                    <option value="">---เลือกข้อมูล---</option>
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

                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">ศาสนา</label>
                                        <select name="inHrReligion" id="inHrReligion" class="form-control"   >
                                            <option value="">---เลือกข้อมูล---</option>
                                            <option value="พุทธ">พุทธ</option>
                                            <option value="คริสต์">คริสต์</option>
                                            <option value="อิสลาม">อิสลาม</option>
                                            <option value="เอทิส">เอทิส</option>
                                        </select>                       
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">สัญชาติ</label>
                                        <select name="inHrNationality" id="inHrNationality" class="form-control"   >
                                            <option value="">---เลือกข้อมูล---</option>
                                            <option value="ไทย">ไทย</option>
                                            <option value="ลาว">ลาว</option>
                                            <option value="พม่า">พม่า</option>
                                            <option value="จีน">จีน</option>
                                        </select>                          
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">เชื้อชาติ</label>
                                        <select name="inHrOrigin" id="inHrOrigin" class="form-control"   >
                                            <option value="">---เลือกข้อมูล---</option>
                                            <option value="ไทย">ไทย</option>
                                            <option value="ลาว">ลาว</option>
                                            <option value="พม่า">พม่า</option>
                                            <option value="จีน">จีน</option>   
                                        </select> 
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">กลุ่มเลือด</label>
                                        <select name="inHrBloodGroup" id="inHrBloodGroup" class="form-control"  >
                                            <option value="">---เลือกข้อมูล---</option>
                                            <option value="โอ">โอ</option>
                                            <option value="บี">บี</option>
                                            <option value="เอ">เอ</option>
                                            <option value="เอบี">เอบี</option>
                                        </select> 
                                    </div>
                                </div>

                                <div class="row">


                                    <div class="col-md-4">
                                        <label class="control-label">สถานะภาพ</label>
                                        <select name="inHrStatus" id="inHrStatus" class="form-control">
                                            <option value="">---ข้อมูล---</option>
                                            <option value="โสด">โสด</option>
                                            <option value="แต่งงาน">แต่งงาน</option>
                                            <option value="หย่าร้าง">หย่าร้าง</option>
                                            <option value="ไม่ระบุ">ไม่ระบุ</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <!--<label class="control-label">ชื่อ-นามสกุล บิดา</label>-->
                                        <?php echo form_input(array("type" => "hidden", "name" => "inHrFatherName", "id" => "inHrFatherName", "class" => "form-control")); ?>
                                    </div>
                                    <div class="col-md-4">
                                        <!--<label class="control-label">ชื่อ-นามสกุล มารดา</label>-->
                                        <?php echo form_input(array("type" => "hidden", "name" => "inHrMotherName", "id" => "inHrMotherName", "class" => "form-control")); ?>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">โทรศัพท์มือถือ</label>
                                        <input type="text" name="inHrMobile" id="inHrMobile" class="form-control" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">อีเมล</label>
                                        <input type="text" name="inHrEmail" id="inHrEmail" class="form-control" />
                                    </div> 
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label">ประเภทบุคลากร</label>
                                        <select name="inHrType" id="inHrType" class="form-control" >
                                            <option value="">---เลือกข้อมูล---</option>
                                            <?php foreach ($rHrType as $r) { ?>
                                                <option value="<?php echo $r['id'] ?>"><?php echo $r['human_resources_type'] ?></option>                                
                                            <?php } ?>
                                        </select>
                                        <!--<input type="hidden" name="inHrPositionRecordId" id="inHrPositionRecordId" />-->
                                    </div> 
                                    <div class="form-group col-md-4">
                                        <label class="control-label">เลขที่ตำแหน่ง</label>
                                        <select name="inHrPosition" id="inHrPosition" class="form-control" >
                                            <option value="">---เลือกข้อมูล---</option>
                                            <?php foreach ($rPos as $r) { ?>
                                                <option value="<?php echo $r['id'] ?>"><?php echo $r['tb_hr_position_name'] ?> : <?php echo $r['tb_hr_position_code'] ?></option>                                
                                            <?php } ?>
                                        </select>
                                        <!--<input type="hidden" name="inHrPositionRecordId" id="inHrPositionRecordId" />-->
                                    </div> 
                                    <div class="form-group col-md-4">
                                        <label class="control-label">วิทยฐานะ</label>
                                        <select name="inHrDegree" id="inHrDegree" class="form-control">
                                            <option value="">--ข้อมูล--</option>
                                            <?php foreach ($tbHrDegree as $r): ?>
                                                <option value="<?php echo $r['tb_hr_degree_name']; ?>"><?php echo $r['tb_hr_degree_name']; ?> (<?php echo $r['tb_hr_degree_description']; ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <?php if ($this->session->userdata('department') != 'กองการศึกษา') {
                                    ?>

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
                                            <label class="control-label">ตำแหน่ง (กลุ่มสาระ)</label>
                                            <select name="inHrGroupLearningClass" id="inHrGroupLearningClass" class="form-control">
                                                <option value="">--ข้อมูล--</option>
                                                <option value="หัวหน้า">หัวหน้า</option>
                                                <option value="รองหัวหน้า">รองหัวหน้า</option>                                           
                                                <option value="เจ้าหน้าที่">เจ้าหน้าที่</option>
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
                                            <label class="control-label">ตำแหน่ง (ฝ่ายงาน)</label>
                                            <select name="inHrDivisionClass" id="inHrDivisionClass" class="form-control">
                                                <option value="">--ข้อมูล--</option>                                            
                                                <option value="หัวหน้า">หัวหน้า</option>
                                                <option value="รองหัวหน้า">รองหัวหน้า</option>
                                                <option value="เลขา">เลขา</option>
                                                <option value="เจ้าหน้าที่">เจ้าหน้าที่</option>                                         
                                            </select>
                                        </div>

                                    </div>
                                <?php } ?>


                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <center>
                                    <button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button>
                                </center>
                            </div>
                            <p style="color:#666;">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</p>
                        </form>
                    </div>                
                </div>            
            </div>
        </div>

    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<script>
    window.onload = function () {
        var searchPic;
        $.ajax({
            url: "<?php echo site_url('Hr_member_profile/hr_member_profile_onload'); ?>",
            dataType: "json",
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();

                document.getElementById("blah").src = '<?php echo base_url() . hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')) ?>' + data.hr_image;
                $('#inHrType').val(data.hr_type_id);
                $('#inHrThaiSymbol').val(data.hr_thai_symbol);
                $('#inHrThaiName').val(data.hr_thai_name);
                $("#inHrThaiLastname").val(data.hr_thai_lastname);
                $("#inHrEngSymbol").val(data.hr_eng_symbol);
                $("#inHrEngName").val(data.hr_eng_name);
                $("#inHrEngLastname").val(data.hr_eng_lastname);
                $("#inHrIdCard").val(data.hr_id_card);
                $("#inHrBloodGroup").val(data.hr_blood_group);
                $("#inHrDayBirthday").val(data.hr_day_birthday);
                $('#inHrMonthBirthday').val(data.hr_month_birthday);
                $('#inHrYearBirthday').val(data.hr_year_birthday);
                $('#inHrNationality').val(data.hr_nationality);
                $('#inHrOrigin').val(data.hr_origin);
                $('#inHrReligion').val(data.hr_religion);
                $('#inHrStatus').val(data.hr_status);
//                $('#inHrFatherName').val(data.hr_father_name);
//                $('#inHrMotherName').val(data.hr_mother_name);
                $('#inHrMobile').val(data.hr_mobile);
                $('#inHrEmail').val(data.hr_email);

                $('#inHrDegree').val(data.hr_degree);
                $('#inHrDivision').val(data.hr_division);
                $('#inHrDivisionClass').val(data.hr_division_class);
                $('#inHrGroupLearning').val(data.hr_group_learning);
                $('#inHrGroupLearningClass').val(data.hr_group_learning_class);





                document.getElementById("Signature").src = '<?php echo base_url() . hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')) ?>' + data.signature;
                $('#inUsername').val(data.username);
                $('#inPassword').val(data.password);

                $('#inHrPositionRecordId').val(data.tb_hr_position_id);
                $('#inHrPosition').val(data.tb_hr_position_id);
            }
        });
    };

    $("#insert-form").on("submit", function (e) {
//    alert($('#inHrType').val());
//        alert($('#inHrPosition').val());
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('Hr_member_profile/hr_member_profile_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>