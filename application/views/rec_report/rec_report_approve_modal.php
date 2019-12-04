<div id="rec-report-approve-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="insert-form">
                    <div class="row">

       
                            <div class="col-md-6 form-group">
                                <label class="control-label">ชื่อรายงาน</label>
                                <input type="text" name="inTbRecReportTopicA" id="inTbRecReportTopicA" class="form-control"  readonly />

                            </div>
               
               
                            <div class="col-md-4 form-group">
                                <label class="control-label">วันที่</label>
                                <input type="date" name="inTbRecReportDateA" id="inTbRecReportDateA" class="form-control" readonly />
                            </div>
              
                      
                            <div class="col-md-6 form-group">
                                <label class="control-label">เรียน</label>
                                <input type="text" name="inTbRecReportForA" id="inTbRecReportForA" class="form-control" readonly />
                            </div>
                 
                       
                            <div class="col-md-6 form-group">
                                <label class="control-label">อ้างถึง</label>
                                <input type="text" name="inTbRecReportReferA" id="inTbRecReportReferA" class="form-control" readonly />
                            </div>
                   
                      
                            <div class="col-md-12 form-group">
                                <label class="control-label">สิ่งที่แนบมาด้วย</label>
                                <textarea id="inTbRecReportAttach" name="inTbRecReportAttachA" style="width:100%;height:100px;" readonly></textarea>
                            </div>
                


                            <div class="col-md-12 form-group">
                                <label class="control-label">เนื้อหา</label>
                                <textarea id="inTbRecReportContentA" name="inTbRecReportContentA" style="width:100%;height:100px;"readonly></textarea>
                            </div>
                  


                            <div class="col-md-12 form-group">
                                <label class="control-label">สรุปผล</label>
                                <textarea id="inTbRecReportConcludeA" name="inTbRecReportConcludeA" style="width:100%;height:100px;"readonly></textarea>
                            </div>
                      

                      
                            <div class="col-md-12 form-group">
                                <label class="control-label">เอกสารแนบและรูปประกอบ</label>
                                <div id="inTbRecReportImgA" class="col-md-12" ></div>
                            </div>
                      

                    </div>
<!--                    <div class="row" style="margin-top:20px;">
                        <center>
                            <input type="submit" value="อนุมัติ" class="btn btn-success" />
                            <input type="button" value="ไม่อนุมัติ(แจ้งปรับปรุงรายงาน)" class="btn btn-danger" />
                        </center>
                    </div>-->
                    <input type="hidden" name="idA" id="idA" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
