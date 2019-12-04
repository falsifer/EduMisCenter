<!-- Modal -->
<div id="teaching-task-course-unit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:95%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="unit-modal-insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label class="control-label">ลำดับหน่วยการเรียนรู้</label>
                                <select name="inUnitSequence" id="inUnitSequence" class="form-control" required>
                                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                                        <option value="<?php echo $i; ?>">หน่วยการเรียนรู้ที่ <?php echo $i; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">ชื่อหน่วยการเรียนรู้</label>
                                <input type="text" name="inUnitName" id="inUnitName" class="form-control" required/>
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">เวลา(ชั่วโมง)</label>
                                <input type="text" name="inUnitHour" id="inUnitHour" class="form-control" required/>
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">คะแนน</label>
                                <input type="text" name="inUnitScore" id="inUnitScore" class="form-control" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">สาระสำคัญ</label>
                                <textarea class="form-control" name="inUnitContent" id="inUnitContent" ></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="inUnitId" id="inUnitId"  />
                        <div class="row">
                            <center><button type="button" class="btn btn-success" onclick='insert_course_unit(this)'><i class="icon-save icon-large"></i> บันทึก</button></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function insert_course_unit(e) {
        $.ajax({
            url: "<?php echo site_url('Teacher/insert_course_unit'); ?>",
            method: "post",
            data: {
                unit_id: $("#inUnitId").val(),
                course_id: $("#InCourseId").val(),
                sequence: $("#inUnitSequence").val(),
                name: $("#inUnitName").val(),
                content: $("#inUnitContent").val(),
                hour: $("#inUnitHour").val(),
                score: $("#inUnitScore").val(),
                term: $("#inTerm").val(),
            },
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                alert("บันทึกข้อมูลสำเร็จ");
                $("#unit-modal-insert-form")[0].reset();
                location.reload();
            }
        });
    }
</script>

