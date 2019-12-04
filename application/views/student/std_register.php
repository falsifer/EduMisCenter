<div class="box">
    <div class="box-heading">เพิ่มข้อมูลนักเรียนใหม่</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('student-register-base', "การรับนักเรียน"); ?></li>
        <li>เพิ่มข้อมูล</li>
    </ul>
    <div class="box-body" >
        <div class="container-fluid">
            <form method="post" id="insert-form" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <b>ข้อมูลพื้นฐาน</b>
                            <br></br>

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
                    </div>

                    <div class="col-md-12">
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
                        </div>
                    </div>

                    <div class="col-md-12">
                        
                    </div>

                    <div class="col-md-12">
                        
                    </div> 

                    <div class="col-md-12">
                        
                    </div>
                    <div class="col-md-12">
                        <div class="row">

                            <b>ภาพนักเรียน</b>
                            <br></br>

                            <div class="col-md-4 form-group">
                                <label class="control-label">ภาพประจำตัวนักเรียน</label>
                                <input type="file" name="inStdImage" id="inStdImage" class="filestyle" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <b>เอกสารแนบ</b>
                            <br></br>

                            <div class="col-md-2 form-group">
                                <label class="control-label">สูติบัตร(สำเนา)</label>
                                <input type="file" name="infile1" id="infile1" class="filestyle" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">ทะเบียนบ้าน(สำเนา)</label>
                                <input type="file" name="infile2" id="infile2" class="filestyle" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">บัตรประชาชน(สำเนา)</label>
                                <input type="file" name="infile3" id="infile3" class="filestyle" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">ผลการเรียนจากที่เก่า(ถ้ามี)</label>
                                <input type="file" name="infile4" id="infile4" class="filestyle" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">อื่นๆ...(กรอกประเภทเอกสาร)</label>
                                <input type="file" name="infile5" id="infile5" class="filestyle" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">ประเภทเอกสาร</label>
                                <input type="text" name="inFileName" id="inFileName" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                    </div>
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
            url: "<?php echo site_url('Student/std_register_insert'); ?>",
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
