<!-- Modal -->
<div id="km-edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label class="control-label">ชื่อแหล่งเรียนรู้</label>
                                <input type="text" name="inKmName" id="inKmName" class="form-control" autofocus  required=""/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">ประเภทแหล่งเรียนรู้</label>
                                <select name="inKmType" id="inKmType" class="form-control">
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="แหล่งเรียนรู้ภายในสถานศึกษา">แหล่งเรียนรู้ภายในสถานศึกษา</option>
                                    <option value="แหล่งเรียนรู้ภายในท้องถิ่น">แหล่งเรียนรู้ภายในท้องถิ่น</option>
                                    <option value="แหล่งเรียนรู้ภายนอกท้องถิ่น">แหล่งเรียนรู้ภายนอกท้องถิ่น</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">ชนิดแหล่งเรียนรู้</label>
                                <select name="inKmKind" id="inKmKind" class="form-control">
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="แหล่งเรียนรู้ทางวิชาการ">แหล่งเรียนรู้ทางวิชาการ</option>
                                    <option value="แหล่งเรียนรู้ตามธรรมชาติ">แหล่งเรียนรู้ตามธรรมชาติ</option>                                
                                    <option value="แหล่งเรียนรู้บุคลากร">แหล่งเรียนรู้บุคลากร</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label class="control-label">ที่อยู่เลขที่</label>
                                <input type="text" name="inKmAddNo" id="inKmAddNo" class="form-control" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">หมู่ที่</label>
                                <input type="text" name="inKmAddMoo" id="inKmAddMoo" class="form-control" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">หมู่บ้าน</label>
                                <input type="text" name="inKmAddVillage" id="inKmAddVillage" class="form-control" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">ถนน</label>
                                <input type="text" name="inKmAddRoad" id="inKmAddRoad" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label">ตำบล</label>
                                <input type="text" name="inKmAddTambol" id="inKmAddTambol" class="form-control" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">อำเภอ</label>
                                <input type="text" name="inKmAddAmphur" id="inKmAddAmphur" class="form-control" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">จังหวัด</label>
                                <input type="text" name="inKmAddProvince" id="inKmAddProvince" class="form-control" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">รหัสไปรษณีย์</label>
                                <input type="text" name="inKmAddZipcode" id="inKmAddZipcode" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label">เบอร์โทรศัพท์</label>
                                <input type="text" name="inKmPhone" id="inKmPhone" class="form-control" />
                            </div>
                            <div class="col-md-5 form-group">
                                <label class="control-label">อีเมล</label>
                                <input type="text" name="inKmEmail" id="inKmEmail" class="form-control" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">เว็บไซต์</label>
                                <input type="text" name="inKmWebsite" id="inKmWebsite" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">ประวัติของแหล่งเรียนรู้</label>
                                <textarea id="inKmHistory" name="inKmHistory" style="width:100%;height:100px;"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">ประโยชน์ของแหล่งเรียนรู้</label>
                                <textarea id="inKmBenefit" name="inKmBenefit" style="width:100%;height:100px;"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label">ภาพที่ 1</label>
                                <input type="file" name="inKmImage1" id="inKmImage1" class="filestyle" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">ภาพที่ 2</label>
                                <input type="file" name="inKmImage2" id="inKmImage2" class="filestyle" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">ภาพที่ 3</label>
                                <input type="file" name="inKmImage3" id="inKmImage3" class="filestyle" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">ภาพที่ 4</label>
                                <input type="file" name="inKmImage4" id="inKmImage4" class="filestyle" />
                            </div>
                        </div>
                        <div class="row">
                            <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                        </div>
                        <input type="Hidden" name="bid" id="bid" />
                    </form>
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
        //
        var image1 = $('#inKmImage1').val();
        var ext1 = $("#inKmImage1").val().split('.').pop().toLowerCase();
        var image2 = $('#inKmImage2').val();
        var ext2 = $("#inKmImage2").val().split('.').pop().toLowerCase();
        var image3 = $('#inKmImage3').val();
        var ext3 = $("#inKmImage3").val().split('.').pop().toLowerCase();
        var image4 = $('#inKmImage4').val();
        var ext4 = $("#inKmImage4").val().split('.').pop().toLowerCase();
        //

        if ((image1 != "" && jQuery.inArray(ext1, ['jpg']) == -1) || (image2 != "" && jQuery.inArray(ext2, ['jpg']) == -1) || (image3 != "" && jQuery.inArray(ext3, ['jpg']) == -1) || (image4 != "" && jQuery.inArray(ext4, ['jpg']) == -1)) {
            alert("ไฟล์ภาพจะต้องเป็นชนิด jpg เท่านั้น");
            $(":file").filestyle('clear');
            return false;
        }
        //
        $.ajax({
            url: "<?php echo site_url('km-update'); ?>",
            method: "post",
            data: new FormData(this),
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