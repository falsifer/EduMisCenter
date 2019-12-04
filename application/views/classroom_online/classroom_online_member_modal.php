<!-- Modal -->
<div id="classroom-online-member-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?>
            <div class="modal-body" style="padding:30px;" >
                <div class="container-fluid">
                    <div class='row'>
                        <div class="col-md-12">
                            <form method="post" id="insert-form" enctype="multipart/form-data">
<!--                                <div class="col-md-4" style="margin-top: 10px">
                                    <label class="control-label">ชื่อเรียก</label>
                                    <input type="text" name="inClassroomOnlineMemberNickname" id="inClassroomOnlineMemberNickname" class="form-control" />
                                </div>-->
                                <div class="col-md-4" style="margin-top: 10px">
                                    <label class="control-label">ประเภท</label>
                                    <select class="form-control" name="inClassroomOnlineMemberType" id="inClassroomOnlineMemberType" >
                                        <option value="Student">นักเรียน</option>
                                        <option value="Teacher">ครู</option>
                                        <option value="Obsever">ผู้สังเกตการณ์</option>
                                    </select>
                                </div>
                                <div class="col-md-4" style="margin-top: 10px">
                                    <label class="control-label">สถานะ</label>
                                    <select class="form-control" name="inClassroomOnlineMemberStatus" id="inClassroomOnlineMemberStatus" >
                                        <option value="TRUE">พร้อมใช้งาน</option>
                                        <option value="FALSE">ไม่พร้อมใช้งาน</option>
                                    </select>
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
    $("#insert-form").on("submit", function (e) {
        $.ajax({
            url: "<?php echo site_url('Classroom_online/classroom_online_member_insert'); ?>",
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
