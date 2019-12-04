<!-- Modal -->
<div id="observ-normal-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#060150;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form id="observ-normal-form" method="post">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">วัน เดือน ปี</label><span class="star">&#42;</span>
                            <input type="text" name="inObservSubjectDate" id="inObservSubjectDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">เวลา</label><span class="star">&#42;</span>
                            <input type="text" name="inObservSubjectTime" id="inObservSubjectTime" class="form-control" placeholder="เช่น 10.30" required/>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ครั้งที่</label><span class="star">&#42;</span>
                            <input type="text" name="inObservSubjectNo" id="inObservSubjectNo" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ภาคเรียน</label<span class="star">&#42;</span>
                            <input type="text" name="inObservTerm" id="inObservTerm" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ปีการศึกษา</label><span class="star">&#42;</span>
                            <input type="text" name="inObservYear" id="inObservYear" class="form-control" value="<?php echo loan_year(date("Y")); ?>" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">ชื่อ-นามสกุลผู้สอน</label><span class="star">&#42;</span>
                            <select name="inHrId" id="inHrId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($teacher as $t): ?>
                                    <option value="<?php echo $t['id']; ?>"><?php echo $t['hr_thai_symbol']; ?><?php echo $t['hr_thai_name']; ?><?php echo nbs(3); ?><?php echo $t['hr_thai_lastname']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">โรงเรียน</label><span class="star">&#42;</span>
                            <select name="inSchoolId" id="inSchoolId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($school as $sc): ?>
                                    <option value="<?php echo $sc['id']; ?>"><?php echo $sc['sc_thai_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">นักเรียนชาย (คน)</label><span class="star">&#42;</span>
                            <input type="text" name="inObservStdMale" id="inObservStdMale" class="form-control"  required/>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">นักเรียนหญิง (คน)</label><span class="star">&#42;</span>
                            <input type="text" name="inObservStdFemale" id="inObservStdFemale" class="form-control"  required/>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ขาด/ลา (คน)</label><span class="star">&#42;</span>
                            <input type="text" name="inObservStdAbsent" id="inObservStdAbsent" class="form-control"  required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">วิชาที่สังเกตการสอน</label><span class="star">&#42;</span>
                            <select name="inSubjectDetailId" id="inSubjectDetailId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($subject as $sj): ?>
                                    <option value="<?php echo $sj['id']; ?>">รหัสวิชา <?php echo $sj['subject_code']; ?> ชื่อวิชา <?php echo $sj['subject_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">หน่วยการเรียนรู้</label><span class="star">&#42;</span>
                            <input type="text" name="inObservLearningGroup" id="inObservLearningGroup" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">เรื่องที่สอน</label><span class="star">&#42;</span>
                            <input type="text" name="inObservSubjectTopic" id="inObservSubjectTopic" class="form-control"  required/>
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-default"><i class="icon-save"></i> บันทึก</button></center></div>
                    <input type="hidden" name="plan_id" id="plan_id" value="<?php echo $this->uri->segment(2); ?>" />
                    <input type="hidden" name="id" id="id" />
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
    $("#observ-normal-form").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-supervision-observ-information'); ?>',
            method: 'post',
            data: $('#observ-normal-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $('#observ-normal-form')[0].reset();
                location.reload();
            }
        });
    });
</script>