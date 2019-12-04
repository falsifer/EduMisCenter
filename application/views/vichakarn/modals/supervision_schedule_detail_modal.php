<!-- Modal -->
<div id="supervision-schedule-detail-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#060150;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form id="insert-form" method="post">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label">วัน เดือน ปี</label><span class="star">&#42;</span>
                            <input type="text" name="inScheduleDate" id="inScheduleDate" class="form-control datepicker" data-date-format='yyyy-mm-dd' placeholder="คลิกวันที่..." required />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">รายการนิเทศ/สังเกตการสอน</label><span class="star">&#42;</span>
                            <?php
//                            print($schedule_title['learning_group'].">>>".$schedule_title['school_name']);
                            $subject = $this->Supervision_model->get_subject($schedule_title['learning_group'], $schedule_title['school_name']);
//                            print_r($subject);
                            ?>

                            <select name="inSubjectDetailId" id="inSubjectDetailId" class="form-control" onchange="ThisClassOnChange(this)" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($subject as $sub): ?>
                                    <option value="<?php echo $sub['cid']; ?>">ระดับชั้น <?php echo $sub['class']; ?> <b>รหัสวิชา</b> <?php echo $sub['tb_course_code']; ?> - <?php echo $sub['tb_subject_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <?php
                            $teacher = $this->Supervision_model->get_human_resources_type_by_department('ครูผู้สอน', $schedule_title['school_name']);
                            ?>
                            <label class="control-label">ผู้รับการนิเทศ</label><span class="star">&#42;</span>
                            <select name="inTeacherName" id="inTeacherName" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($teacher as $t): ?>
                                    <option value="<?php echo $t['hr_thai_symbol']; ?><?php echo $t['hr_thai_name']; ?><?php echo nbs(1); ?><?php echo $t['hr_thai_lastname']; ?>"><?php echo $t['hr_thai_symbol']; ?><?php echo $t['hr_thai_name']; ?><?php echo nbs(1); ?><?php echo $t['hr_thai_lastname']; ?>(<?php echo $t['hr_department']; ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ผู้นิเทศ</label><span class="star">&#42;</span>
                            <select name="inSupervisionName" id="inSupervisionName" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php
                                if ($this->session->userdata('department') !== 'กองการศึกษา') {
                                    
                                    $supervision = $this->Supervision_model->get_supervision_by_school($schedule_title['learning_group'], $this->session->userdata('department'));
                                }
                                
                                foreach ($supervision as $s){
                                    ?>
                                    <option value="<?php echo $s['hr_thai_symbol']; ?><?php echo $s['hr_thai_name']; ?><?php echo nbs(3); ?><?php echo $s['hr_thai_lastname']; ?>"><?php echo $s['hr_thai_symbol']; ?><?php echo $s['hr_thai_name']; ?><?php echo nbs(3); ?><?php echo $s['hr_thai_lastname']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="schedule_id" id="schedule_id" value="<?php echo $this->uri->segment(2); ?>" />
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center></div>
                    <div class="row"><div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div></div>
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
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-supervision-schedule-detail'); ?>',
            method: 'post',
            data: $("#insert-form").serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });

    function ThisClassOnChange(e) {
        $.ajax({
            url: "<?php echo site_url('Supervision/get_teacher_list_by_class_id'); ?>",
            method: "POST",
            data: {id: e.value},
            success: function (data) {
                $('#inTeacherName').html(data);
            }
        });
    }
</script>