<div id="plan-insert-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="width:1250px;">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">บันทึกรายละเอียดแผนการศึกษาและปฏิทินปฏิบัติงาน</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form method="post" id="plan-insert-form"">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">กิจกรรม/โครงการ/แผน</label><span class="star">&#42;</span>
                                    <input type="text" name="inActivityPlanSubject" id="inActivityPlanSubject" class="form-control" required autofocus />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label class="control-label">วันที่เริ่มกิจกรรม</label><span class="star">&#42;</span>
                                    <div class="input-group">
                                        <input type="text" name="inActivityPlanStartDate" id="inActivityPlanStartDate" class="form-control datepicker" placeholder="คลิกวันที่..." data-date-format="yyyy-mm-dd" required/>
                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group ">
                                    <label class="control-label">วันที่สิ้นสุดกิจกรรม</label>
                                    <div class="input-group">
                                        <input type="text" name="inActivityPlanEndDate" id="inActivityPlanEndDate" class="form-control datepicker" placeholder="คลิกวันที่..." data-date-format="yyyy-mm-dd" required/>
                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                    </div>

                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label">ประเภท</label><span class="star">&#42;</span>
                                    <select name="inActivityPlanType" id="inActivityPlanType" class="form-control" required>
                                        <option value="">---เลือกข้อมูล---</option>
                                        <option value="กิจกรรม">กิจกรรม</option>
                                        <option value="แผน/โครงการ">แผน/โครงการ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">สถานที่</label><span class="star">&#42;</span>
                                    <input type="text" name="inActivityPlanPlace" id="inActivityPlanPlace" class="form-control"  />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">รายละเอียด</label><span class="star">&#42;</span>
                                    <textarea name="inActivityPlanDetail" id="inActivityPlanDetail" class="form-control" rows="6" ></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">การเผยแพร่ข้อมูล</label><span class="star">&#42;</span>&nbsp;&nbsp; 
                                    <input class="magic-radio form-control" type="radio" name="inActivityPlanPublic"  value="Y" id="r1" ><label for="r1">สาธารณะ</label>&nbsp;
                                    <input class="magic-radio form-control" type="radio" name="inActivityPlanPublic"  value="N" id="r2" checked><label for="r2">ภายใน</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">สถานะ</label><span class="star">&#42;</span>
                                    <select name="inActivityPlanStatus" id="inActivityPlanStatus" class="form-control" required>
                                        <option value="N" selected="">No Action</option>
                                        <option value="A">In Action</option>
                                        <option value="S">Success</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <center><button type="button" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                            </div>
                            <div class="row"><div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div></div>
                            <input type="hidden" name="id" id="id" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>

$(".datepicker").datepicker({autoclose: true, language: 'th'});

    $("#plan-insert-form").on("click", ".btn-insert", function (e) {
        e.preventDefault();
        //
        $.ajax({
            url: "<?php echo site_url('Vichakarn/activity_plan_add'); ?>",
            method: "post",
            data: $("#plan-insert-form").serialize(),
            success: function (data) {
                $("#plan-insert-form")[0].reset();

                location.href = "<?php echo site_url(); ?>";
            }

        });
    });





</script>
