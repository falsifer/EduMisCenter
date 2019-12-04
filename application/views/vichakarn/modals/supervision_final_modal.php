<!-- Modal -->
<div id="supervision-final-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="supervision-final-form">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label">ชื่องานหรือโครงการ</label>
                            <input type="text" name="inFinalProject" id="inFinalProject" class="form-control" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="row-fluid">
                                <label class="control-label">ขั้นตอนการนำนวัตกรรมไปใช้</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">1.</div>
                                        <input type="text" name="inFinalActivities1" id="inFinalActivities1" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">3.</div>
                                        <input type="text" name="inFinalActivities1" id="inFinalActivities1" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">5.</div>
                                        <input type="text" name="inFinalActivities1" id="inFinalActivities1" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">2.</div>
                                        <input type="text" name="inFinalActivities1" id="inFinalActivities1" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">4.</div>
                                        <input type="text" name="inFinalActivities1" id="inFinalActivities1" class="form-control" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="row-fluid">
                                <label class="control-label">วัตถุประสงค์</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">1.</div>
                                        <input type="text" name="inFinalPurpose1" id="inFinalPurpose1" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">3.</div>
                                        <input type="text" name="inFinalPurpose1" id="inFinalPurpose1" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">5.</div>
                                        <input type="text" name="inFinalPurpose1" id="inFinalPurpose1" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">2.</div>
                                        <input type="text" name="inFinalPurpose1" id="inFinalPurpose1" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">4.</div>
                                        <input type="text" name="inFinalPurpose1" id="inFinalPurpose1" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">6.</div>
                                        <input type="text" name="inFinalPurpose1" id="inFinalPurpose1" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                        </div>
                    </div>
                    <input type="hidden" name="plan_id" value="<?php echo $this->uri->segment(2); ?>" />
                    <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    
</script>