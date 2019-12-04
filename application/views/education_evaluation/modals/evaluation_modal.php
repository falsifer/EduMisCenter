<!-- Modal -->
<div id="evaluation-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">

                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">วัน/เดือน/ปี</label>
                            <input type="text" name="inEvDate" id="inEvDate" autocomplete="off" class="form-control datepicker" data-date-format='yyyy-mm-dd' placeholder="Click วันที่..." required/>
                        </div>
                        <div class="form-group col-md-9">
                            <label class="control-label">กลุ่มข้อมูลกิจกรรม</label>
                            <select name="inActivitiesId" id="inActivitiesId" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($ev_category as $ev): ?>
                                    <option value="<?php echo $ev['id']; ?>"><?php echo $ev['evaluation_category']; ?> | <?php echo $ev['evaluation_activities']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label">ระยะเวลา (วัน)</label>
                            <input type="number" name="inEvDay" id="inEvDay" class="form-control" />
                        </div>
                        <div class="form-group col-md-5">
                            <label class="control-label">หน่วยงานเป้าหมาย</label>
                            <select name="inSchoolId" id="inSchoolId" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($school as $sc): ?>
                                    <option value="<?php echo $sc['id']; ?>"><?php echo $sc['sc_thai_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-5 form-group">
                            <label class="control-label">หัวหน้าชุดดำเนินการ</label>
                            <input type="text" name="inOfficeLeader" id="inOfficeLeader" class="form-control" placeholder="ระบุชื่อ..." />
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
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    //
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        //
        $.ajax({
            url: '<?php echo site_url('insert-education-evaluation-data'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
               location.reload();
            }
        });
    });

</script>