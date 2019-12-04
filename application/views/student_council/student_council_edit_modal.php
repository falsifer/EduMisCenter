<!-- Modal -->
<div id="sc-edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form method="post" id="insert-form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-5 form-group">
                                            <label class="control-label">กิจกรรม</label>
                                            <input type="text" name="inTbStudentCouncilContent" id="inTbStudentCouncilContent" class="form-control" autofocus  required=""/>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">วัน เดือน ปี</label>
                                            <input type="text" autocomplete="off" name="inTbStudentCouncilDate" id="inTbStudentCouncilDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label class="control-label">รายละเอียดกิจกรรม</label>
                                            <textarea id="inTbStudentCouncilDetail" name="inTbStudentCouncilDetail" style="width:100%;height:100px;"></textarea>
<!--                                        <input type="text" name="inBsSubj" id="inBsSubj" class="form-control" autofocus  required=""/>-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">ภาพกิจกรรม1</label>
                                            <input type="file" name="inTbStudentCouncilImg1" id="inTbStudentCouncilImg1" class="filestyle" />
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">ภาพกิจกรรม2</label>
                                            <input type="file" name="inTbStudentCouncilImg2" id="inTbStudentCouncilImg2" class="filestyle" />
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">ภาพกิจกรรม3</label>
                                            <input type="file" name="inTbStudentCouncilImg3" id="inTbStudentCouncilImg3" class="filestyle" />
                                        </div>
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
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "<?php echo site_url('student-council-update'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                MyStartLoading();
            },
            success: function (data) {
                MyEndLoading();
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>