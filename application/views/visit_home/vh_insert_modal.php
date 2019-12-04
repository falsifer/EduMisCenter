<!-- Modal -->
<div id="vh-insert-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title">บันทึกข้อมูลเยี่ยมบ้านนักเรียน</h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="row">

                    <form method="post" id="vh-insert-form" enctype="multipart/form-data">
                        <div class="col-md-12 ">

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="hidden" name="inStdId" id='inStdId'>
                                    <h3 class="control-label" id='inStdFullname'>&nbsp;</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">วันที่เยี่ยมบ้าน</span>
                                        <input type="text" name="inDateVisit" id="inDateVisit" class="form-control datepicker" placeholder="คลิกวันที่..."  data-date-language="th-th" data-date-format="yyyy-mm-dd" />
                                        <span class="input-group-addon">
                                            <i class="icon-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <legend style="margin-top: 15px;">ข้อมูลที่อยู่ปัจจุบัน</legend>
                            <div class="row">
                                <div class="col-md-8 form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">พิกัดบ้าน</span>
                                        <input type="text" name="inAddLat" id="inAddLat" class="form-control" placeholder="ละติจูด" />
                                        <span class="input-group-addon">,</span>
                                        <input type="text" name="inAddLong" id="inAddLong" class="form-control" placeholder="ลองจิจูด" />
                                        <span onclick="getCurrentGEO(this)" class="input-group-addon btn btn-primary btn-search-location"><i class="glyphicon glyphicon-map-marker"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 form-group">
                                    <label class="control-label">เลขที่</label>
                                    <input type="text" name="inAddNo" id="inAddNo" class="form-control" autofocus />
                                </div>
                                <div class="col-md-2 form-group">
                                    <label class="control-label">หมู่</label>
                                    <input type="text" name="inAddMoo" id="inAddMoo" class="form-control" autofocus />
                                </div>
                                <div class="col-md-8 form-group">
                                    <label class="control-label">ตำบล</label>
                                    <input type="text" name="inAddTambol" id="inAddTambol" class="form-control" autofocus />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 form-group">
                                    <label class="control-label">อำเภอ</label>
                                    <input type="text" name="inAddAmphur" id="inAddAmphur" class="form-control" autofocus />
                                </div>
                                <div class="col-md-5 form-group">
                                    <label class="control-label">จังหวัด</label>
                                    <input type="text" name="inAddProvince" id="inAddProvince" class="form-control" autofocus />
                                </div>
                                <div class="col-md-2 form-group">
                                    <label class="control-label">รหัสไปรษณีย์</label>
                                    <input type="text" name="inAddZipcode" id="inAddZipcode" class="form-control" autofocus />
                                </div>
                            </div>  
                            <legend style="margin-top: 15px;">ข้อมูลบิดา</legend>
                            <div class="row">
                                <div class="col-md-2 form-group">
                                    <label class="control-label">คำนำหน้าชื่อ</label>
                                    <select name="inDTitlename" id="inDTitlename" class="form-control"   >
                                        <option value="นาย">นาย</option>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="control-label">ชื่อจริง</label>
                                    <input type="text" name="inDFirstname" id="inDFirstname" class="form-control" />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="control-label">นามสกุล</label>
                                    <input type="text" name="inDLastname" id="inDLastname" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 form-group">
                                    <label class="control-label">สถานภาพ</label>
                                    <select name="inDStatus" id="inDStatus" class="form-control"   >
                                        <option value="มีชีวิต">---มีชีวิต---</option>  
                                        <option value="ถึงแก่กรรม">---ถึงแก่กรรม---</option>
                                    </select> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">อาชีพ</label>
                                    <input type="text" name="inDCareerName" id="inDCareerName" class="form-control" />
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">ชื่อบริษัท</label>
                                    <input type="text" name="inDCompanyName" id="inDCompanyName" class="form-control" />
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">รายได้ต่อเดือน(เงินบาท)</label>
                                    <input type="text" name="inDIncome" id="inDIncome" class="form-control" />
                                </div>
                            </div>
                            <legend style="margin-top: 15px;">ข้อมูลมารดา</legend>
                            <div class="row">
                                <div class="col-md-2 form-group">
                                    <label class="control-label">คำนำหน้าชื่อ</label>
                                    <select name="inMTitlename" id="inMTitlename" class="form-control"   >
                                        <option value="นางสาว">นางสาว</option>
                                        <option value="นาง">นาง</option>

                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="control-label">ชื่อจริง</label>
                                    <input type="text" name="inMFirstname" id="inMFirstname" class="form-control" />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="control-label">นามสกุล</label>
                                    <input type="text" name="inMLastname" id="inMLastname" class="form-control" />
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-2 form-group">
                                    <label class="control-label">สถานภาพ</label>
                                    <select name="inMStatus" id="inMStatus" class="form-control"   >
                                        <option value="มีชีวิต">---มีชีวิต---</option>  
                                        <option value="ถึงแก่กรรม">---ถึงแก่กรรม---</option>
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
                                    <input type="text" name="inMCareerName" id="inMCareerName" class="form-control" />
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">ชื่อบริษัท</label>
                                    <input type="text" name="inMCompanyName" id="inMCompanyName" class="form-control" />
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">รายได้ต่อเดือน(เงินบาท)</label>
                                    <input type="text" name="inMIncome" id="inMIncome" class="form-control" />
                                </div>
                            </div>

                            <legend style="margin-top: 15px;">ข้อมูลผู้ปกครอง</legend>
                            <div class="row">

                                <div class="col-md-2 form-group">
                                    <label class="control-label">ความเกี่ยวข้อง</label>
                                    <select name="inFmAbout" id="inFmAbout" class="form-control"   >
                                        <option value="">---เลือกข้อมูล---</option>
                                        <option value="บิดา">บิดา</option>
                                        <option value="มารดา">มารดา</option>
                                        <option value="ลุง">ลุง</option>
                                        <option value="ป้า">ป้า</option>
                                        <option value="น้า">น้า</option>
                                        <option value="อา">อา</option>
                                        <option value="ปู่">ปู่</option>
                                        <option value="ย่า">ย่า</option>
                                        <option value="ตา">ตา</option>
                                        <option value="ยาย">ยาย</option>
                                        <option value="พี่">พี่</option>
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
                                <div class="col-md-12 form-group">
                                    <label class="control-label">สภาพบ้านและสภาพแวดล้อม</label>
                                    <select class="form-control" id='inHomeStructure' name='inHomeStructure'>
                                        <option value="เหมาะสม">เหมาะสม</option>
                                        <option value="บ้านพัก ห้องพัก หรือห้องเช่ามีแหล่งมั่วสุม">บ้านพัก ห้องพัก หรือห้องเช่ามีแหล่งมั่วสุม</option>
                                        <option value="บ้านพัก ห้องพัก หรือห้องเช่าไม่เหมาะสม">บ้านพัก ห้องพัก หรือห้องเช่าไม่เหมาะสม</option>
                                    </select>
                                </div>                        
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="control-label">ความสัมพันธ์ในครอบครัว</label>
                                    <select class="form-control" id='inHomeRelation' name='inHomeRelation'>
                                        <option value="พ่อแม่อยู่ด้วยกัน รักใคร่กันดี">พ่อแม่อยู่ด้วยกัน รักใคร่กันดี</option>
                                        <option value="พ่อแม่เสียชีวิต หรือไม่มีคนดูแล หรือครอบครัวขัดแย้งทะเลาะร้ายแรงพ่อแม่เสียชีวิต หรือไม่มีคนดูแล หรือครอบครัวขัดแย้งทะเลาะร้ายแรง">พ่อแม่เสียชีวิต หรือไม่มีคนดูแล หรือครอบครัวขัดแย้งทะเลาะร้ายแรงพ่อแม่เสียชีวิต หรือไม่มีคนดูแล หรือครอบครัวขัดแย้งทะเลาะร้ายแรง</option>
                                        <option value="พ่อหรือแม่เสียชีวิต หรือแยกกันอยู่ พ่อหรือแม่เสียชีวิต หรือแยกกันอยู่ ">พ่อหรือแม่เสียชีวิต หรือแยกกันอยู่ พ่อหรือแม่เสียชีวิต หรือแยกกันอยู่ </option>
                                    </select>
                                </div>                        
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="control-label">การช่วยงานของนักเรียนในครอบครัว</label>
                                    <textarea id="inStdTask" name="inStdTask" style="width:100%;height:100px;"></textarea>
                                </div>                        
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="control-label">ผู้ปกครองช่วยอบรมดูแลนักเรียนอย่างไร</label>
                                    <textarea id="inParentTraining" name="inParentTraining" style="width:100%;height:100px;"></textarea>
                                </div>                        
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="control-label">สิ่งที่ผู้ปกครองต้องการความช่วยเหลือจากโรงเรียน</label>
                                    <textarea id="inParentAssistance" name="inParentAssistance" style="width:100%;height:100px;"></textarea>
                                </div>                        
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="control-label">ความเห็น/ข้อเสนอของครูในการเยี่ยมบ้าน</label>
                                    <textarea id="inTechComment" name="inTechComment" style="width:100%;height:100px;"></textarea>
                                </div>                        
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">รูปบ้าน1</label>
                                    <input type="file" name="inVhImg1" id="inVhImg1" class="filestyle" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">รูปบ้าน2</label>
                                    <input type="file" name="inVhImg2" id="inVhImg2" class="filestyle" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">รูปบ้าน3</label>
                                    <input type="file" name="inVhImg3" id="inVhImg3" class="filestyle" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="control-label">รูปบ้าน4</label>
                                    <input type="file" name="inVhImg4" id="inVhImg4" class="filestyle" />
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
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    $("#vh-insert-form").on("submit", function (e) {
        $.ajax({
            url: "<?php echo site_url('Visit_home/vh_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#vh-insert-form")[0].reset();
                location.reload();
            }
        });
//        alert('บันทึกเรียบร้อย');
//        e.preventDefault();
//
//        var image = $('#inVhImg1').val();
//        var ext1 = $("#inVhImg1").val().split('.').pop().toLowerCase();
//
//        var image = $('#inVhImg2').val();
//        var ext1 = $("#inVhImg2").val().split('.').pop().toLowerCase();
//
//
//        //
//        if ((image != "" && jQuery.inArray(ext1, ['jpg']) == -1)) {
//            alert("ไฟล์จะต้องเป็นชนิด jpg เท่านั้น");
//            $(":file").filestyle('clear');
//            return false;
//        }
//
//        $.ajax({
//            url: "<?php echo site_url('vh-insert'); ?>",
//            method: "post",
//            data: new FormData(this),
//            cache: false,
//            contentType: false,
//            processData: false,
//            success: function (data) {
//                alert("บันทึกข้อมูลสำเร็จ");
//                $("#insert-form")[0].reset();
//                location.reload();
//            }
//        });
    });



    function getCurrentGEO(e) {
//        alert('111');
        if (navigator.geolocation) {
//            alert('222');
            navigator.geolocation.getCurrentPosition(foundLocation, noLocation);
        }
    }

    function foundLocation(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        var userLocation = lat + ', ' + lon;
        alert(userLocation);
    }
    function noLocation() {
        alert("Could not find location");
    }

</script>
