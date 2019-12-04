<div id="hr-give-up-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" enctype="multipart/form-data" style="padding-top:30px;padding-bottom:30px;">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">วัน/เดือน/ปี</label>
                            <input type="text" name="inGiveUpDate" autocomplete='off' id="inGiveUpDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" require placeholder="คลิกวันที่..."/>
                        </div>
                        <div class="form-group col-md-5">
                            <label class="control-label">ผู้ได้รับการยกย่อง/เชิดชูเกียรติ</label>
                            <select name="inHrId" id="inHrId" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach($hr as $h):?>
                                <option value="<?php echo $h['id'];?>"><?php echo $h['hr_thai_symbol'];?><?php echo $h['hr_thai_name'];?> <?php echo $h['hr_thai_lastname'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ผู้ประกาศ/ผู้ยกย่อง</label>
                            <input type="text" name="inGiveUpOffice" id="inGiveUpOffice" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">'
                            <label class="control-label">เรื่องที่ประกาศยกย่อง/เชิดชูเกียรติ</label>
                            <input type="text" name="inGiveUpTopic" id="inGiveUpTopic" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">เอกสารประกอบ</label>
                            <input type="file" name="inGiveUpDocument" id="inGiveUpDocument" class="filestyle" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ภาพประกอบ 1</label>
                            <input type="file" name="inGiveUpImage1" id="inGiveUpImage1" class="filestyle" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ภาพประกอบ 2</label>
                            <input type="file" name="inGiveUpImage2" id="inGiveUpImage2" class="filestyle" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ภาพประกอบ 3</label>
                            <input type="file" name="inGiveUpImage3" id="inGiveUpImage3" class="filestyle" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inGiveUpComment" id="inGiveUpComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" id="id" name="id" />
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
    //
    $('#insert-form').on('submit',function(e){
        e.preventDefault();
        var doc = $('#inGiveUpDocument').val();
        var doc_ext = $('#inGiveUpDocument').val().split('.').pop().toLowerCase();
        var img1 = $('#inGiveUpImage1').val();
        var img1_ext = $('#inGiveUpImage1').val().split('.').pop().toLowerCase();
        var img2 = $('#inGiveUpImage2').val();
        var img2_ext = $('#inGiveUpImage2').val().split('.').pop().toLowerCase();
        var img3 = $('#inGiveUpImage3').val();
        var img3_ext = $('#inGiveUpImage3').val().split('.').pop().toLowerCase();
        //
        $.ajax({
            url:'<?php echo site_url('insert-human-resources-give-up'); ?>',
            method:'post',
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>