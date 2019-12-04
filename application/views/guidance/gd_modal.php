<!-- Modal -->
<div id="gd-modal" class="modal fade" role="dialog">
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
                            <div class="col-md-6">
                                <div class="pricing hover-effect">
                                    <div class="pricing-head">
                                        <h3>ข้อมูลนักเรียน</h3>
                                    </div>
                                    <div class="row">                        
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="row">
                                                <div class="col-md-12 form-group ">
                                                    <label class="control-label">ชื่อ : </label>
                                                    <input type="text" name="inStdname" id="inStdname" value="เด็กชายชัยรัธฐา อ่วมอารีย์" disabled="disabled"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group ">
                                                    <label class="control-label">รหัสนักเรียน : </label>
                                                    <input type="text" name="inStdCode" id="inStdCode" value="44698" disabled="disabled"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group ">
                                                    <label class="control-label" name="inStd2" id="inStd2" >ระดับชั้น : </label>
                                                    <input type="text" name="inStdCode" id="inStdCode" value="" disabled="disabled"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group ">
                                                    <label class="control-label" name="inStd3" id="inStd3">ความบกพร่องทางร่างกาย : </label>
                                                    <input type="text" name="inStdHealth" id="inStdHealth" value="" disabled="disabled"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group ">
                                                    <label class="control-label" name="inStd4" id="inStd4">ผลการเรียนเฉลี่ย : </label>
                                                    <input type="text" name="inStdCode" id="inStdGrade" value="" disabled="disabled"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group ">
                                                    <label class="control-label" name="inStd5" id="inStd5">เวลาเรียนเฉลี่ย : </label>
                                                    <input type="text" name="inStdCode" id="inStdRecord" value="" disabled="disabled"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 form-group col-md-offset-1">
                                <div class="row">
                                    <div class="row">
                                        <b>บันทึกผลการแนะแนว</b>
                                        <br></br>
                                    </div>
                                    <div class="row">
                                        <label class="control-label">บันทึกการให้คำปรึกษา</label>
                                        <textarea id="inText" name="inText" style="width:100%;height:100px;" ></textarea>
                                    </div>
                                    <div class="row">
                                        <label class="control-label">บันทึกการส่งต่อ</label>
                                        <textarea id="inResultText" name="inResultText" style="width:100%;height:100px;" ></textarea>
                                    </div>
                                </div>
                                <div class="row" style='display:none;'>
                                    <div class="row">
                                        <b>แนบเอกสารประกอบ</b>
                                        <br></br>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="control-label">เอกสารประกอบ</label>
                                        <input type="file" name="inFile" id="inFile" class="filestyle" />
                                    </div>
                                </div>
                                <div class="row">
                                    <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="aid" id="aid" />
                        <input type="hidden" name="chid" id="chid" />
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
        var checkid = $('#chid').val();
        var file = $('#inFile').val();
        var ext1 = $("#inFile").val().split('.').pop().toLowerCase();
        //

        if ((file != "" && jQuery.inArray(ext1, ['pdf']) == -1)) {
            alert("ไฟล์ภาพจะต้องเป็นชนิด pdf เท่านั้น");
            $(":file").filestyle('clear');
            return false;
        }

        if (checkid != "") {
            $.ajax({
                url: "<?php echo site_url('Guidance/gd_update'); ?>",
                method: "post",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    alert("แก้ไขข้อมูลสำเร็จ");
                    $("#insert-form")[0].reset();
                    location.reload();
                }
            });
        } else {
            $.ajax({
                url: "<?php echo site_url('Guidance/gd_insert'); ?>",
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
        }

    });
</script>