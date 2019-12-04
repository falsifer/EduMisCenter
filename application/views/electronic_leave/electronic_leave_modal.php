<!-- Modal -->
<div id="electronic-leave-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <style>
                .modal-body{
                    height: 500px;
                    overflow-y: auto;
                }
                .row{
                    margin-bottom: 10px;
                }
            </style>

            <div class="modal-body" style="padding:30px;" >
                <div class="container-fluid">
                    <form method="post" id="insert-form" enctype="multipart/form-data">
                        <div id="ElectronicLeaveBody" >
                            <div class="row">
                                <center><h4><b>แบบบันทึกการลา</b></h4></center>
                            </div>
                            <div class="col-md-10 col-md-offset-1">

                                <!--                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <b>เรื่อง ขออณุญาตลา</b> 
                                                                    </div>                            
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <b>เรียน ผู้อำนวยการ<?php echo $this->session->userdata('department'); ?></b> 
                                                                    </div>                            
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <p style="text-indent: 3.5em;">
                                                                            <b>ข้าพเจ้า   </b><u id="inName">นายชัยรัธฐา อ่วมอารีย์</u>  
                                                                            <b>ตำแหน่ง    </b><u id="inRank">ครูอัตราจ้าง</u>
                                                                            <b>สังกัด    </b><u id="inDepartment"><?php echo $this->session->userdata('department'); ?></u>
                                                                        </p> 
                                                                    </div>
                                                                </div>-->
                                <div class="row">
                                    <div class="col-md-6" style="margin-top: 10px">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary">ขออณุญาต </button>  
                                            </div>
                                            <select name="inTopicSub" id="inTopicSub" class="form-control">
                                                <option value="">--เลือกประเภทการลา--</option>
                                                <?php foreach ($rs as $r) : ?>
                                                    <option value="<?php echo $r['id']; ?>"><?php echo $r['tb_work_record_topic_sub_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 10px">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary">เนื่องจาก </button>
                                            </div>
                                            <input type="text" name="inReason" id="inReason" class="form-control" placeholder="เนื่องจาก ..." />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4" style="margin-top: 10px">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary"><i class="icon-calendar icon-large"></i> ตั้งแต่วันที่ </button>
                                            </div>
                                            <input type="text" name="inStartDate" id="inStartDate" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>" onchange="CalDate(this)" data-date-format="yyyy-mm-dd" placeholder="จากวันที่..." required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="margin-top: 10px">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary"><i class="icon-calendar icon-large"></i> จนถึงวันที่ </button>
                                            </div>
                                            <input type="text" name="inEndDate" id="inEndDate" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>" onchange="CalDate(this)" data-date-format="yyyy-mm-dd" placeholder="จนถึงวันที่..." required/>
                                        </div>
                                    </div>


                                    <div class="col-md-4" style="margin-top: 10px">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary">เป็นจำนวน </button>
                                            </div>
                                            <input type="text" name="inCountDay" id="inCountDay" value="1" class="form-control" readonly/>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary"> วัน</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" >
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary">ติดต่อได้ที่</button>
                                            </div>
                                            <input type="text" name="inAddress" id="inAddress" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4" style="margin-top: 10px">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-phone"></i> เบอร์โทรศัพท์ </button>
                                            </div>
                                            <input type="text" name="inPhone" id="inPhone" class="form-control"/>
                                        </div>
                                    </div> 

                                    <div class="col-md-4" style="margin-top: 10px">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary">ช่องทางการติดต่ออื่นๆ  </button>
                                            </div>
                                            <input type="text" name="inOther" id="inOther" class="form-control"/>
                                        </div>
                                    </div> 
                                    <div class="col-md-4" style="margin-top: 10px">                                                                                  
                                        <input type="file" class='filestyle' multiple="multiple" name="inELeaveRefer[]" id="inELeaveRefer[]" />
                                    </div> 
                                </div>
                                <div class="row">
                                    <center>
                                        <button type="submit" class="btn btn-success btn-insert" ><i class="icon-share icon-large"></i> ส่งใบลา  </button>
                                    </center>                            
                                </div>
                            </div> 
                            <input type="hidden" name="id" id="id" value="" class="form-control"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    function CalDate(e) {
        var Strdate = $('#inStartDate').datepicker('getDate');
        var Enddate = $('#inEndDate').datepicker('getDate');
        var Day = (Enddate.getDate() - Strdate.getDate()) + 1;
        $('#inCountDay').val(Day);

    }


    $("#insert-form").on("submit", function (e) {
        $.ajax({
            url: "<?php echo site_url('Electronic_Leave/electronic_leave_insert'); ?>",
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