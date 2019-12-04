<div id="rec-report-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="insert-form">
                    <div class="row">
                        <div class="col-md-12 ">

                            <!--<div class="row">-->
                            <div class="col-md-3 form-group">
                                <label class="control-label">ชื่อรายงาน</label>
                                <input type="text" name="inTbRecReportTopic" id="inTbRecReportTopic" class="form-control" autofocus />

                            </div>
                            <!--                        </div> 
                                                    <div class="row">-->
                            <div class="col-md-3 form-group">
                                <label class="control-label">วันที่</label>
                                <input type="date" name="inTbRecReportDate" id="inTbRecReportDate" class="form-control" autofocus />
                            </div>
                            <!--                        </div>
                                                    <div class="row">-->
                            <div class="col-md-3 form-group">
                                <label class="control-label">เรียน</label>
                                <input type="text" name="inTbRecReportFor" id="inTbRecReportFor" class="form-control" autofocus />
                            </div>
                            <!--</div>-->
                            <!--<div class="row">-->
                            <div class="col-md-3 form-group">
                                <label class="control-label">อ้างถึง</label>
                                <input type="text" name="inTbRecReportRefer" id="inTbRecReportRefer" class="form-control" autofocus />
                            </div>
                            <!--                        </div>
                                                    <div class="row">-->
                            
                            <!--</div>-->


                            <!--<div class="row">-->
                            <div class="col-md-12 form-group">
                                <label class="control-label">เนื้อหา</label>
                                <textarea id="inTbRecReportContent" name="inTbRecReportContent" style="width:100%;height:100px;"></textarea>
                            </div>
                            <!--</div>-->  


                            <!--<div class="row">-->
                            <div class="col-md-12 form-group">
                                <label class="control-label">สรุปผล</label>
                                <textarea id="inTbRecReportConclude" name="inTbRecReportConclude" style="width:100%;height:100px;"></textarea>
                            </div>
                            <!--</div>-->

                            <!--<div class="row">-->
                            <div class="col-md-4 form-group">
                                <label class="control-label">เอกสารแนบ</label>
                                <input type="file" name="inTbRecReportFile" id="inTbRecReportFile" class="filestyle" />
                            </div>
                            <div class="col-md-8 form-group">
                                <label class="control-label">สิ่งที่แนบมาด้วย</label>
                                <input type="text" name="inTbRecReportAttach" id="inTbRecReportAttach" class="form-control" autofocus />
                            </div>
                            <!--                        </div>
                                                    <div class="row">-->
                            <div class="col-md-4 form-group">
                                <label class="control-label">รูปประกอบ 1</label>
                                <input type="file" name="inTbRecReportImg1" id="inTbRecReportImg1" class="filestyle" />
                            </div>
                            <!--                        </div>
                                                    <div class="row">-->
                            <div class="col-md-4 form-group">
                                <label class="control-label">รูปประกอบ 2</label>
                                <input type="file" name="inTbRecReportImg2" id="inTbRecReportImg2" class="filestyle" />
                            </div>
                            <!--                        </div>
                                                    <div class="row">-->
                            <div class="col-md-4 form-group">
                                <label class="control-label">รูปประกอบ 3</label>
                                <input type="file" name="inTbRecReportImg3" id="inTbRecReportImg3" class="filestyle" />
                            </div>
                            <!--</div>-->
                            <!--</div>-->
                            <div class="col-md-12" style="margin-top:20px;">
                                <center>
                                    <!--<input type="submit" value="บันทึกข้อมูล" class="btn btn-success" />-->
                                    <button type='submit' class='btn btn-success'><i class='icon-save icon-large'></i> บันทึก</button>
                                </center>
                            </div>
                            <input type="hidden" name="id" id="id" />

                            <!--</div>-->

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                            <!--<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="icon-power-off"></i></button>-->
            </div>
        </div>
    </div>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
      

        if ($('#id').val() == "") {
            $.ajax({
                url: "<?php echo site_url('rec-report-insert'); ?>",
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
        } else {
            $.ajax({
                url: "<?php echo site_url('rec-report-update'); ?>",
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


        //



    });
</script>