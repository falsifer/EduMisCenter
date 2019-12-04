<div id="insert-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="width:1250px;">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">บันทึกรายละเอียดแผนปฏิบัติงาน</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form method="post" id="insert-form">
                            <div class="row">

                                <div class="form-group col-md-3">
                                    <label class="control-label">งาน</label><span class="star">&#42;</span>
                                    <select name="inTaskJob" id="inTaskJob" class="form-control" required>
                                        <option value="">---เลือกข้อมูล---</option>
                                        <?php foreach ($division as $rs): ?>
                                            <option value="<?php echo $rs['tb_division_name']; ?>"><?php echo $rs['tb_division_name']; ?></option>
                                            
                                        <?php endforeach; ?>
                                            <option value="Present">Present</option>
                                            <option value="ส่งงาน">ส่งงาน</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">ผู้รับผิดชอบ</label><span class="star">&#42;</span>
                                    <select name="inTaskAssign" id="inTaskAssign" class="form-control" required>
                                        <option value="">---เลือกข้อมูล---</option>
                                        <?php foreach ($team as $rs): ?>
                                            <option value="<?php echo $rs['name']; ?>"><?php echo $rs['name']; ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">สถานะ</label><span class="star">&#42;</span>
                                    <select name="inTaskStatus" id="inTaskStatus" class="form-control" required>
                                        <option value="">---เลือกข้อมูล---</option>
                                        <option value="N">No Action</option>
                                        <option value="Y">In Action</option>
                                        <option value="S">Success</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">ความสำคัญ</label><span class="star">&#42;</span>
                                    <select name="inTaskPriority" id="inTaskPriority" class="form-control" required>
                                        <option value="">---เลือกข้อมูล---</option>
                                        <option value="N">ปกติ</option>
                                        <option value="Y">ด่วน</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Task</label><span class="star">&#42;</span>
                                    <input type="text" name="inTaskTitle" id="inTaskTitle" class="form-control" required autofocus />
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">รายละเอียด</label><span class="star">&#42;</span>
                                    <textarea name="inTaskComment" id="inTaskComment" class="form-control" rows="6" ></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="control-label">วันที่เริ่ม</label><span class="star">&#42;</span>
                                    <?php echo form_input(array("type" => "text", "name" => "inTaskStartDate", "id" => "inTaskStartDate", "class" => "form-control", "value" => '', "data-provide" => "datepicker", "data-date-language" => "th", "data-date-format" => "yyyy-mm-dd")); ?>
                                </div>
                                <div class="col-md-5 form-group ">
                                    <label class="control-label">Deadline</label>
                                    <?php echo form_input(array("type" => "text", "name" => "inTaskDeadline", "id" => "inTaskDeadline", "class" => "form-control", "value" => '', "data-provide" => "datepicker", "data-date-language" => "th", "data-date-format" => "yyyy-mm-dd")); ?>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="control-label">ความคืบหน้า %</label><span class="star">&#42;</span>
                                    <input type="text" name="inTaskComplete" id="inTaskComplete" class="form-control"  />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label class="control-label">เอกสารแนบ 1</label>
                                    <input type="file" name="inTaskDoc1" id="inKmImage1" class="filestyle" />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="control-label">เอกสารแนบ 2</label>
                                    <input type="file" name="inTaskDoc2" id="inKmImage2" class="filestyle" />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="control-label">เอกสารแนบ 3</label>
                                    <input type="file" name="inTaskDoc3" id="inKmImage3" class="filestyle" />
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="control-label">เอกสารแนบ 4</label>
                                    <input type="file" name="inTaskDoc4" id="inKmImage4" class="filestyle" />
                                </div>
                            </div>

                            <div class="row">
                                <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
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



    $("#insert-form").on("submit", function (e) {
        e.preventDefault();

        //
        $.ajax({
            url: "<?php echo site_url('Task/task_add'); ?>",
            method: "post",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.href = "<?php echo site_url('task/'); ?>";
            }

        });
    });





</script>
