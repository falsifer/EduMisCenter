<!-- Modal -->
<div id="subject-detail-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form id="insert-form" method="post">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label">รหัสวิชา</label>
                            <input type="text" name="inSubjectCode" id="inSubjectCode" class="form-control" required autofocus />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ชื่อวิชา</label>
                            <input type="text" name="inSubjectName" id="inSubjectName" class="form-control" required />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">ระดับชั้น</label>
                            <select name="inLevelId" id="inLevelId" class="form-control">
                                <option value="">--ข้อมูล--</option>
                                <?php foreach ($level as $l): ?>
                                    <option value="<?php echo $l['id']; ?>"><?php echo $l['education_level']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">กลุ่มสาระการเรียนรู้</label>
                            <select name="inLearningGroupId" id="inLearningGroupId" class="form-control">
                                <option value="">---ข้อมูล---</option>
                                <?php foreach ($learning_group as $group): ?>
                                    <option value="<?php echo $group['id']; ?>">กลุ่มที่ <?php echo $group['education_group_no']; ?> <?php echo $group['education_group_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label">คำอธิบายรายวิชา</label>
                            <textarea name="inSubjectDetail" id="inSubjectDetail" style="height: 150px;width:100%;">
                                
                            </textarea>
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-subject-detail'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>