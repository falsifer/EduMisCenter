<!-- Modal -->
<div id="hr-07-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding-left:30px;padding-right:30px;">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class='row'>
                        <div class="form-group col-md-4" style='margin-top:20px;'>
                            <label class="control-label">เรื่อง</label>
                            <input type="text" name="inHr07Topic" id="inHr07Topic" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-4" style='margin-top:20px;'>
                            <label class="control-label">สถานที่</label>
                            <input type="text" name="inHr07Place" id="inHr07Place" class="form-control" />
                        </div>
                        <div class="form-group col-md-4" style='margin-top:20px;'>
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inHr07Comment" id="inHr07Comment" class="form-control" />
                        </div>
                        <div class="form-group col-md-12" style='margin-top:20px;'>
                            <label class="control-label">รายละเอียด</label>
                            <textarea id="inHr07Detail" name="inHr07Detail" style="width:100%;height:100px;"></textarea>
                        </div>

                        <div class="form-group col-md-3" style='margin-top:20px;'>
                            <label class="control-label">ตั้งแต่วันที่</label>
                            <input onchange="CalDate(this)" autocomplete="off" type="text" name="inHr07StartDatePicker" id="inHr07StartDatePicker"   class="form-control datepicker"    data-date-language="th-th" data-date-format="yyyy-mm-dd" required />

                        </div>
                        <div class="form-group col-md-3" style='margin-top:20px;'>
                            <label class="control-label">ถึงวันที่</label>
                            <input onchange="CalDate(this)" autocomplete="off" type="text" name="inHr07EndDatePicker" id="inHr07EndDatePicker"   class="form-control datepicker"    data-date-language="th-th" data-date-format="yyyy-mm-dd" required />
                        </div>
                        <div class="form-group col-md-3" style='margin-top:20px;'>
                            <label class="control-label">ระยะเวลา (วัน)</label>
                            <input type="number" name="inHr07Day" id="inHr07Day" class="form-control" />
                        </div>
                        <div class="form-group col-md-3" style='margin-top:20px;'>
                            <label class="control-label">เป็นจำนวน (ชั่วโมง)</label>
                            <input type="number" name="inHr07Hour" id="inHr07Hour" class="form-control" required/>
                        </div>
                        
<!--                        <div  class="form-group col-md-6" style='margin-top:20px;'>
                            <label class="control-label">ภาพประกอบ (สามารถนำเข้าได้มากกว่า 1 รูป)<span class="star">* .jpeg .jpg .png </span></label>
                            <input type="file" multiple name="inHr07Picture" id="inHr07Picture" class="filestyle" />
                        </div>
-->                        <div  class="form-group col-md-6" style='margin-top:20px;'>
                            <label class="control-label">เอกสารประกอบ <span class="star">* รับทุกนามสกุลไฟล์</span></label>
                            <input type="file" multiple name="inHr07File" id="inHr07File" class="filestyle" />
                        </div>


                    </div>


                    <div class="row">
                        <center>
                            <button type="submit" class="btn btn-success btn-add"><i class="icon-save icon-large"></i> บันทึก</button>
                        </center>
                    </div>
                    <input type="hidden" name="hr_id" value="<?php echo $human['id']; ?>" />
                    <input type="hidden" name="id" id="id" /> 
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function CalDate(e) {
        var Strdate = $('#inHr07StartDatePicker').datepicker('getDate');
        var Enddate = $('#inHr07EndDatePicker').datepicker('getDate');
        var Day = (Enddate.getDate() - Strdate.getDate()) + 1;
        $('#inHr07Day').val(Day);

    }
    
    
//    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    //
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-human-resources-part-07'); ?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>