<!-- Modal -->
<div id="vh-edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form method="post" id="insert-form" enctype="multipart/form-data">
                                <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">ชื่อนักเรียน</label>
                            <input type="text" name="inStdName" id="inStdName" class="form-control" autofocus />
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">ชั้น</label>
                            <input type="text" name="inStdClass" id="inStdClass" class="form-control" autofocus />
                        </div>
                        <div class="col-md-2 form-group">
                            <label class="control-label">เลขที่</label>
                            <input type="text" name="inStdNo" id="inStdNo" class="form-control" autofocus />
                        </div>
                    </div>  

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">ครูประจำชั้น/ครูที่ปรึกษา</label>
                            <input type="text" name="inTechName" id="inTechName" class="form-control" autofocus />
                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="control-label">วันที่ออกเยี่ยม</label>
                            <input type="date" name="inDateVisit" id="inDateVisit" class="form-control" autofocus />
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">สถานที่ไปเยี่ยม</label>
                            <textarea id="inAddvDetail" name="inAddvDetail" style="width:100%;height:100px;"></textarea>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label class="control-label">สถานที่ประกอบอาชีพ คือ</label>
                            <input type="text" name="inAddcName" id="inAddcName" class="form-control" autofocus />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">ที่ตั้งสถานที่ประกอบอาชีพ</label>
                            <textarea id="inAddcDetail" name="inAddcDetail" style="width:100%;height:100px;"></textarea>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">ชื่อ-นามสกุลบิดา</label>
                            <input type="text" name="inFatherName" id="inFatherName" class="form-control" autofocus />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="control-label">อาชีพ</label>
                            <input type="text" name="inFatherCareer" id="inFatherCareer" class="form-control" autofocus />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="control-label">รายได้ต่อเดือน(บาท)</label>
                            <input type="text" name="inFatherSalary" id="inFatherSalary" class="form-control" autofocus />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">ชื่อ-นามสกุลมารดา</label>
                            <input type="text" name="inMotherName" id="inMotherName" class="form-control" autofocus />
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="control-label">อาชีพ</label>
                            <input type="text" name="inMotherCareer" id="inMotherCareer" class="form-control" autofocus />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="control-label">รายได้ต่อเดือน(บาท)</label>
                            <input type="text" name="inMotherSalary" id="inMotherSalary" class="form-control" autofocus />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">ชื่อ-นามสกุลผู้ปกครอง</label>
                            <input type="text" name="inParentName" id="inParentName" class="form-control" autofocus />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="control-label">อาชีพ</label>
                            <input type="text" name="inParentCareer" id="inParentCareer" class="form-control" autofocus />
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="control-label">รายได้ต่อเดือน(บาท)</label>
                            <input type="text" name="inParentSalary" id="inParentSalary" class="form-control" autofocus />
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">สภาพบ้านและสภาพแวดล้อม</label>
                            <textarea id="inHomeStructure" name="inHomeStructure" style="width:100%;height:100px;"></textarea>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">ความสัมพันธ์ในครอบครัว</label>
                            <textarea id="inHomeRelation" name="inHomeRelation" style="width:100%;height:100px;"></textarea>
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
                        <div class="col-md-6 form-group">
                            <label class="control-label">ระยะทางจากบ้านมาโรงเรียน</label>
                            <input type="text" name="inHomeDistance" id="inHomeDistance" class="form-control" autofocus />
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
                                    <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                                </div>
                                <input type="hidden" name="id" id="id" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();

        var image = $('#inVhImg1').val();
        var ext1 = $("#inVhImg1").val().split('.').pop().toLowerCase();

        var image = $('#inVhImg2').val();
        var ext1 = $("#inVhImg2").val().split('.').pop().toLowerCase();

        //
        if ((image != "" && jQuery.inArray(ext1, ['jpg']) == -1)) {
            alert("ไฟล์ภาพจะต้องเป็นชนิด jpg เท่านั้น");
            $(":file").filestyle('clear');
            return false;
        }
        $.ajax({
            url: "<?php echo site_url('vh-update'); ?>",
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