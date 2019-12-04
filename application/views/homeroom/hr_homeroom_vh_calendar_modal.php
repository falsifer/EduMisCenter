<!-- Modal -->
<div id="hr-homeroom-vh-calendar-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;" >
        <div class="modal-content" >            
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <div class="modal-body" style="padding:30px;">
                <div class='row'>
                    <div class='col-md-12'>
                        <form method="post" id="vh-calendar-insert-form" enctype="multipart/form-data">

                            <!--                            <div style='margin-top:20px;' class="col-md-8 form-group">
                                                            <label class="control-label">เลือกนักเรียน</label>
                                                            <select name="inStudentId" id="inStudentId" class="form-control">
                                                                <option value="">---เลือกข้อมูล---</option>
                            <?php echo $Student_list; ?>
                                                            </select>
                                                        </div>-->

                            <div style='margin-top:20px;' class="col-md-2 form-group">
                                <label class="control-label">วันที่เยี่ยม</label>
                                <input autocomplete='off' type="text" name="inVitsitHomeCalendarDate" id="inVitsitHomeCalendarDate" class="form-control datepicker" placeholder="คลิกเลือกวันที่..." data-date-format="yyyy-mm-dd" required/>
                            </div>
                            <div style='margin-top:20px;' class="col-md-10   form-group">
                                <label class="control-label">สถานที่</label>
                                <input type="text" name="inVitsitHomeCalendarLocation" id="inVitsitHomeCalendarLocation" class="form-control"/>
                                <!--<textarea id="inVitsitHomeCalendarLocation" name="inVitsitHomeCalendarLocation" style="width:100%;height:100px;"></textarea>-->
                            </div>
                            <div style='margin-top:20px;' class="col-md-12 form-group" >
                                <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                            </div>
                            <input type="hidden" name="id" id="id" />
                            <input type="hidden" name="inStdId" id="inStdId" />
                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>  
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});

    $("#vh-calendar-insert-form").on("submit", function (e) {
//        alert('as');
        $.ajax({
            url: "<?php echo site_url('Homeroom/hr_homeroom_vh_calendar_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                alert("บันทึกข้อมูลสำเร็จ");
                $("#vh-calendar-insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>