<!-- Modal -->
<div id="supervision-schedule-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#060150;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label">ปีการศึกษา</label>
                            <input type="text" name="inLoanYear" id="inLoanYear" class="form-control" value="<?php echo loan_year(date('Y')) ?>" required />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">เทอมที่</label>
                            <input type="text" name="inLoanTerm" id="inLoanTerm" class="form-control" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">กลุ่มสาระการเรียนรู้</label>
                            <select name="inLearningGroup" id="inLearningGroup" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($group as $g): ?>
                                    <option value="<?php echo $g['tb_group_learningcol_name']; ?>"><?php echo $g['tb_group_learningcol_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                             <?php
                            if($this->session->userdata('department')=="กองการศึกษา"){
                            ?>
                            <label class="control-label">โรงเรียนเป้าหมาย</label>
                           
                            <select name="inSchoolName" id="inSchoolName" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($school as $sc): ?>
                                    <option value="<?php echo $sc['sc_thai_name']; ?>"><?php echo $sc['sc_thai_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php
                            }else{
                                ?>
                            <input type="hidden" name="inSchoolName" id="inSchoolName" class="form-control" value="<?php echo $this->session->userdata('department'); ?>" >
 
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="id" id="id" />
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
            url: '<?php echo site_url('insert-supervision-schedule'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>