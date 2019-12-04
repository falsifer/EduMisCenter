<!-- Modal -->
<div id="std-register-insert-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="student-register-modal-insert-form" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div id="dashboardTAB" class="row"> 
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a  href="#tab1" data-toggle="tab" data-id="1">
                                            <b>ข้อมูลพื้นฐาน</b>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab2" data-toggle="tab" data-id="2">
                                            <b>อื่นๆ</b>
                                        </a>
                                    </li>
                                    <!--                                    <li>
                                                                            <a href="#tab3" data-toggle="tab" data-id="3">
                                                                                <b>กิจกรรมการควบคุม</b>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#tab4" data-toggle="tab" data-id="4">
                                                                                <b>สารสนเทศและการสื่อสาร</b>
                                                                            </a>
                                                                        </li>-->
                                    <li>
                                        <a href="#tab5" data-toggle="tab" data-id="5">
                                            <b>เอกสารแนบ</b>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1" style="padding-top:10px;">   
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img id="blah" src="#" class="img-thumbnail"  alt="ภาพนักเรียน" />
                                            <input type="file" name="inStdImage" id="inStdImage" class="filestyle" onchange="readURL(this)"/>
                                        </div>  
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-2 form-group">
                                                    <label class="control-label">คำนำหน้าชื่อ</label>
                                                    <select name="inStdTitlename" id="inStdTitlename" class="form-control" onchange="TitleNameOnChange(this)" >
                                                        <option value="">---เลือกเพศ---</option>
                                                        <option value="เด็กชาย">เด็กชาย</option>
                                                        <option value="เด็กหญิง">เด็กหญิง</option>
                                                        <option value="นาย">นาย</option>
                                                        <option value="นางสาว">นางสาว</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label class="control-label">ชื่อจริง</label>
                                                    <input type="text" name="inStdFirstname" id="inStdFirstname" class="form-control" autofocus  required=""/>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label class="control-label">นามสกุล</label>
                                                    <input type="text" name="inStdLastname" id="inStdLastname" class="form-control" autofocus  required=""/>
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <label class="control-label">ชื่อเล่น</label>
                                                    <input type="text" name="inStdNickname" id="inStdNickname" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 form-group">
                                                    <label class="control-label">รหัสบัตรประชาชน</label>
                                                    <input type="text" name="inStdIdcard" id="inStdIdcard" class="form-control" maxlength="13" type="number" onkeypress='validate(event)'/>
                                                </div>
                                                <!--<div class="col-md-2 form-group">-->
                                                <!--<label class="control-label">เพศ</label>-->
                                                <input type="hidden" name="inStdGender" id="inStdGender" value="" readonly  class="form-control" />
                                                <!--</div>-->
                                                <div class="col-md-3 form-group">
                                                    <label class="control-label">ระดับชั้นที่เข้ารับการศึกษา</label>
                                                    <select name="inStdClass" id="inStdClass" class="form-control" required>
                                                        <option value="">---เลือกข้อมูล---</option>
                                                        <?php foreach ($rClass as $r): ?>
                                                            <option value="<?php echo $r['cid']; ?>"><?php echo $r['tb_ed_school_class_name']; ?>ปีที่ <?php echo $r['tb_ed_school_class_level']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
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
                                        </div>  
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2" style="padding-top:10px;">   
                                    <div class="row">
                                        <b>ข้อมูลด้านสุขภาพ</b>
                                        <br></br>
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
                                        <b>ข้อมูลที่อยู่(ปัจจุบันหรือสามารถติดต่อได้)</b>
                                        <br></br>

                                        <div class="col-md-2 form-group">
                                            <label class="control-label">บ้านเลขที่</label>
                                            <input type="text" name="inAddNo" id="inAddNo" class="form-control" maxlength="9" />
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label class="control-label">หมู่</label>
                                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control" maxlength="2" type="number" onkeypress='validate(event)'/>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">ชื่อหมู่บ้าน</label>
                                            <input type="text" name="inAddVillage" id="inAddVillage" class="form-control" />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">ชื่อถนน</label>
                                            <input type="text" name="inAddRoad" id="inAddRoad" class="form-control" />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">ตำบล</label>
                                            <input type="text" name="inAddTambol" id="inAddTambol" class="form-control" />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">อำเภอ</label>
                                            <input type="text" name="inAddAmphur" id="inAddAmphur" class="form-control" />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">จังหวัด</label>
                                            <input type="text" name="inAddProvince" id="inAddProvince" class="form-control" />
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label class="control-label">รหัสไปรษณีย์</label>
                                            <input type="text" name="inAddZipcode" id="inAddZipcode" class="form-control" maxlength="5" type="number" onkeypress='validate(event)' />
                                        </div>
                                    </div>
                                </div>
                                <!--                                <div class="tab-pane" id="tab3" style="padding-top:10px;">   
                                                                    กิจกรรมการควบคุม
                                                                </div>
                                                                <div class="tab-pane" id="tab4" style="padding-top:10px;">   
                                                                    สารสนเทศและการสื่อสาร
                                                                </div>-->
                                <div class="tab-pane" id="tab5" style="padding-top:10px;">   
<!--                                    <div class="row">

                                        <b>ภาพนักเรียน</b>
                                        <br></br>

                                        <div class="col-md-4 form-group">
                                            <label class="control-label">ภาพประจำตัวนักเรียน</label>
                                            <input type="file" name="inStdImage" id="inStdImage" class="filestyle" />
                                        </div>
                                    </div>-->
                                    <div class="row">
                                        <b>เอกสารแนบ</b>
                                        <br></br>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">สูติบัตร(สำเนา)</label>
                                            <input type="file" name="infile1" id="infile1" class="filestyle" />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">ทะเบียนบ้าน(สำเนา)</label>
                                            <input type="file" name="infile2" id="infile2" class="filestyle" />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">บัตรประชาชน(สำเนา)</label>
                                            <input type="file" name="infile3" id="infile3" class="filestyle" />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">ผลการเรียนจากที่เก่า(ถ้ามี)</label>
                                            <input type="file" name="infile4" id="infile4" class="filestyle" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <b>อื่นๆ</b>
                                        <br></br>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">อื่นๆ...(กรอกประเภทเอกสาร)</label>
                                            <input type="file" name="infile5" id="infile5" class="filestyle" />
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">ประเภทเอกสาร</label>
                                            <input type="text" name="inFileName" id="inFileName" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                        </div>

                    </form>
                </div>

            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<?php $this->db->select("*")->from('tb_setting_title_name'); ?>
<?php $titlename = $this->db->get()->result_array(); ?>
<script>
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
<script>
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault)
                theEvent.preventDefault();
        }
    }

    function TitleNameOnChange(e) {
        if (e.value == "นาย" | e.value == "เด็กชาย") {
            $('#inStdGender').val("ชาย");
        } else {
            $('#inStdGender').val("หญิง");
        }
    }

    $(function () {
        var dataSource = <?php echo json_encode($titlename); ?>;

        $('#inStdTitlename').magicsearch({
            dataSource: dataSource,
            fields: ['tb_setting_title_name_name'],
            id: 'id',
            format: '%tb_setting_title_name_name%',
            isClear: false,
//            multiple: false,
//            multiField: 'tb_setting_title_name_name',
//            multiStyle: {
//                space: 5,
//                width: 40
//            },
            success: function ($input, data) {
                return true;
            },

        });
    });

    $("#student-register-modal-insert-form").on("submit", function (e) {
        e.preventDefault();

//        var CheckIdCard = $('#inStdIdcard').val();
//        alert(typeof CheckIdCard)

        //
        var image = $('#inStdImage').val();
        var ext1 = $("#inStdImage").val().split('.').pop().toLowerCase();
        //
        if ((image != "" && jQuery.inArray(ext1, ['jpg']) == -1)) {
            alert("ไฟล์ภาพจะต้องเป็นชนิด jpg เท่านั้น");
            $(":file").filestyle('clear');
            return false;
        }
        
        $.ajax({
            url: "<?php echo site_url('Student/std_register_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#student-register-modal-insert-form")[0].reset();
                location.reload();
            }
        });
    });

</script>