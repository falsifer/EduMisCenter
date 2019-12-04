<!-- Modal -->
<div id="teaching-task-course-unit-manage-purpose-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:95%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <div class="modal-body" style="padding:30px;max-height: 600px;overflow-y: auto;">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">ชื่อจุดประสงค์การเรียนรู้</label>
                            <input type="text" name="inCoursePurposeName" id="inCoursePurposeName" class="form-control"  required />
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">คะแนนเต็ม</label>
                            <input type="text" name="inCoursePurposeScore" id="inCoursePurposeScore" class="form-control"  required />
                        </div>
                        <div class="col-md-2 form-group">
                            <button style='margin-top:25px;' type='button' class='btn btn-success' onclick='InsertCoursePurpose(this)' ><i class='icon-save icon-large'></i> บันทึกข้อมูล</button>
                        </div>
                        <input type="hidden" name="inPurposeId" id="inPurposeId" class="form-control" />
                    </div>
                    <div class="row">
                        <input type="hidden" value="" id="InUnitId" name="InUnitId"/>
                        <table class="table table-hover table-bordered display" id="KpiTable">
                            <thead>
                                <tr style='background-color: #eeeeee;'>
                                    <th style="width:10%; text-align: center">ที่</th>
                                    <th style="width:50%;text-align: center">ชื่อจุดประสงค์</th>
                                    <th style="width:20%;text-align: center">คะแนน</th>
                                    <th style="width:20%;text-align: center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody id="PurposeTBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function InsertCoursePurpose(e) {
        $.ajax({
            url: "<?php echo site_url('Teacher/insert_course_purpose'); ?>",
            method: "post",
            data: {id: $('#inPurposeId').val(), unit_id: $('#InUnitId').val(), course_id: $('#InCourseId').val(), name: $('#inCoursePurposeName').val(), score: $('#inCoursePurposeScore').val()},
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                location.reload();
            }
        });
    }

    function DeleteThisCoursePurpose(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Teacher/delete_course_purpose'); ?>',
                method: 'post',
                data: {id: e.id},
                success: function (data) {
                    location.reload();
                }
            });
        }
    }
</script>