<!-- Modal -->
<div id="hr-15-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                <form id="insert-form" method="post">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">ปี พ.ศ.</label>
                            <input type="text" name="inEduYear" id="inEduYear" class="form-control" placeholder="เช่น 2535" autofocus required />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ระดับการศึกษา</label>
<!--                            <select name="inEduLevel" id="inEduLevel" class="form-control"  required>
                                <option value="">---เลือกข้อมูล---</option>
                                <option value="ปริญญาตรี">ปริญญาตรี</option>
                                <option value="ปริญญาโท">ปริญญาโท</option>
                                <option value="ปริญญาเอก">ปริญญาเอก</option>
                            </select>-->
                            <input type="text" name="inEduLevel" id="inEduLevel" class="form-control" placeholder="เช่น ปริญญาตรี"/>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">คณะวิชา</label>
                            <input type="text" name="inEduGroup" id="inEduGroup" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">สาขาวิชา</label>
                            <input type="text" name="inEduBranch" id="inEduBranch" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">สถาบันการศึกษา</label>
                            <input type="text" name="inEduUniversity" id="inEduUniversity" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inEduComment" id="inEduComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="hr_id" id="hr_id" value="<?php echo $this->uri->segment(2); ?>" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-link" data-dismiss="modal">ปิดหน้าต่างนี้</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url:'<?php echo site_url('insert-human-resources-part-15'); ?>',
            method:'post',
            data:$('#insert-form').serialize(),
            success:function(data){
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>