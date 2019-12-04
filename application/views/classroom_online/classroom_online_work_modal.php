<!-- Modal -->
<div id="classroom-online-work-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?>
            <style>
                .modal-body{
                    min-height: 300px;
                    overflow-y: auto;
                }
                .row{
                    margin-bottom: 10px;
                }
            </style>

            <div class="modal-body" style="padding:30px;" >
                <div class="container-fluid">
                    <div class='row'>
                        <div class="col-md-12">
                            <form method="post" id="insert-form" enctype="multipart/form-data">
                                <input type="hidden" value='<?php echo $classroom_online['id']; ?>' name="classroom_online_id" id="classroom_online_id" required />
                                <div class="col-md-8" style="margin-top: 10px">
                                    <label class="control-label">ชื่อภาระงาน</label>
                                    <input type="text" name="inClassroomOnlineWorkName" id="inClassroomOnlineWorkName" class="form-control"  required />
                                </div>
                                <div class="col-md-4" style="margin-top: 10px">
                                    <label class="control-label">ประเภท</label>
                                    <select class="form-control" name="inClassroomOnlineWorkType" id="inClassroomOnlineWorkType" >
                                        <option value="Classroomwork">ภาระงานในคาบเรียน</option>
                                        <option value="Homework">ภาระงานการบ้าน</option>
                                    </select>
                                </div>
                                <div class="col-md-4" style="margin-top: 10px">
                                    <label class="control-label">วันเริ่มต้น</label>
                                    <input type="text" name="inClassroomOnlineWorkStartdate" id="inClassroomOnlineWorkStartdate" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>"  data-date-format="yyyy-mm-dd" placeholder="จากวันที่..." required/>
                                </div>
                                <div class="col-md-4" style="margin-top: 10px">
                                    <label class="control-label">วันสิ้นสุด</label>
                                    <input type="text" name="inClassroomOnlineWorkEnddate" id="inClassroomOnlineWorkEnddate" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>" data-date-format="yyyy-mm-dd" placeholder="จนถึงวันที่..." required/>
                                </div>
                                <div class="col-md-4" style="margin-top: 10px">
                                    <label class="control-label">เอกสารประกอบ</label>
                                    <input type="file" class='filestyle' multiple="multiple" name="inClassroomOnlineWorkFile[]" id="inClassroomOnlineWorkFile[]" />
                                </div> 

                                <div class="col-md-12" style="margin-top: 10px">
                                    <label class="control-label">รายละเอียด</label>
                                    <textarea id="inClassroomOnlineWorkDetail" name="inClassroomOnlineWorkDetail" style="width:100%;height:100px;"></textarea>
                                </div>
                                <div class="col-md-12" style="margin-top: 10px">
                                    <center>
                                        <button type="submit" class="btn btn-success" ><i class="icon-save icon-large"></i> บันทึกข้อมูล</button>
                                    </center>    
                                </div>
                                <input type="hidden" name="id" id="id" value="" class="form-control"/>
                            </form>
                        </div> 
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#insert-form").on("submit", function (e) {
        $.ajax({
            url: "<?php echo site_url('Classroom_online/classroom_online_work_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>
