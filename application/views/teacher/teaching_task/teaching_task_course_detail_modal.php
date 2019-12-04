<!-- Modal -->
<div id="teaching-task-course-detail-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:95%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <div class="row">
                        <div  class="col-md-12 form-group">
                            <label class="control-label">คำอธิบายรายวิชา</label>
                            <textarea id="inCourseDetail" name="inCourseDetail" style="width:100%;height:200px;"></textarea>
                        </div>
                    </div>
                    <div style='margin-top:20px;' class="row" >
                        <center><button type="button" class="btn btn-success btn-insert" onclick='update_course_detail()'><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function update_course_detail() {
        $.ajax({
            url: "<?php echo site_url('Teacher/update_course_detail'); ?>",
            method: "post",
            data: {
                id: $("#InCourseDetailId").val(),
                course_detail: $("#inCourseDetail").val(),
            },
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                alert($("#inCourseDetail").val());
                
                alert("บันทึกข้อมูลสำเร็จ");
                location.reload();
            }
        });
    }
</script>