<!-- Modal -->
<style>
    .modal-body{
        height: 350px;
        overflow-y: auto;
    }
</style>
<div id="hr-homeroom-std-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;" >
        <div class="modal-content" >            
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <?php
            $this->load->view('layout/my_school_print');
            ?>  
            <div class="modal-body" style="padding:30px;">
                <div class='row'>
                    <div class='col-md-10 col-md-offset-1'>
                        <form method="post" id="insert-form" enctype="multipart/form-data">

                            <div class='row'>
                                <div class="col-md-3">
                                    <center>
                                        <label class="control-label">ภาพประจำตัว</label>                                
                                        <img onclick='HrFileThis(this)' alt="คลิกเพื่ออัพโหลดภาพโปรไฟล์" id='blah' class='btn btn-std-file img-thumbnail' src="" style='width: 150px;'/>
                                        <input type="file" name="inStdPicture" id="inStdPicture" style='display:none' onchange="readURL(this)"/>
                                        <script>
                                            $('.btn-std-file').click(function () {
                                                $('#inStdPicture').click();
                                            });
                                            function readURL(input) {
                                                if (input.files && input.files[0]) {
                                                    var reader = new FileReader();

                                                    reader.onload = function (e) {
                                                        $('#blah')
                                                                .attr('src', e.target.result)
                                                                .width(150);
//                                                                .height();
                                                    };

                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            }
                                        </script>
                                    </center>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-2 form-group">
                                            <label class="control-label">คำนำหน้าชื่อ</label>
                                            <select name="inStdTitlename" id="inStdTitlename" class="form-control"  >
                                                <option value="">---เลือกข้อมูล---</option>
                                                <option value="เด็กชาย">เด็กชาย</option>
                                                <option value="เด็กหญิง">เด็กหญิง</option>
                                                <option value="นาย">นาย</option>
                                                <option value="นางสาว">นางสาว</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">ชื่อจริง</label>
                                            <input type="text" name="inStdFirstname" id="inStdFirstname" class="form-control"   required/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">นามสกุล</label>
                                            <input type="text" name="inStdLastname" id="inStdLastname" class="form-control"   required/>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label class="control-label">ชื่อเล่น</label>
                                            <input type="text" name="inStdNickname" id="inStdNickname" class="form-control" />
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">รหัสบัตรประชาชน</label>
                                            <input type="text" name="inStdIdcard" id="inStdIdcard" class="form-control" />
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label class="control-label">รหัสนักเรียน</label>
                                            <input type="text" name="inStdCode" id="inStdCode" class="form-control" />
                                        </div>
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
                                    <div class="row">
                                        <div class="col-md-5 form-group">
                                            <label class="control-label">วันเดือนปีเกิด</label>
                                            <input type="text" name="inStdBirthday" id="inStdBirthday" class="form-control" />                                    
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
                                    </div>
                                </div>
                            </div>


                            <input type="hidden" name="inStdId" id="inStdId" />
                            <br/>
                            <div class="row">
                                <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>  

<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('Homeroom/update_student_base'); ?>",
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