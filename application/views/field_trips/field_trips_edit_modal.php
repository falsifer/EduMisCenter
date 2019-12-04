<!-- Modal -->
<div id="ft-edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form method="post" id="insert-form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-5 form-group">
                                            <label class="control-label">กิจกรรม</label>
                                            <input type="text" name="inTbFieldTripsContent" id="inTbFieldTripsContent" class="form-control" autofocus  required=""/>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label">วัน/เดือน/ปี</label>
                                            <input type="text" name="inTbFieldTripsDate" id="inTbFieldTripsDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required/>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 form-group">
                                                <label class="control-label">สถานที่</label>
                                                <input type="text" name="inTbFieldTripsPlace" id="inTbFieldTripsPlace" class="form-control" autofocus  required=""/>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <label class="control-label">งบประมาณ</label>
                                                <input type="text" name="inTbFieldTripsBudget" id="inTbFieldTripsBudget" class="form-control" autofocus  required=""/>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label class="control-label">จำนวนนักเรียน</label>
                                                <input type="text" name="inTbFieldTripsAmount" id="inTbFieldTripsAmount" class="form-control" autofocus  required=""/>
                                            </div>
                                        </div>  
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label class="control-label">รายละเอียดกิจกรรมทัศนศึกษา</label>
                                                <textarea id="inTbFieldTripsDetail" name="inTbFieldTripsDetail" style="width:100%;height:100px;"></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 form-group">
                                                <label class="control-label">ภาพกิจกรรม1</label>
                                                <input type="file" name="inTbFieldTripsImg1" id="inTbFieldTripsImg1" class="filestyle" />
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="control-label">ภาพกิจกรรม2</label>
                                                <input type="file" name="inTbFieldTripsImg2" id="inTbFieldTripsImg2" class="filestyle" />
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="control-label">ภาพกิจกรรม3</label>
                                                <input type="file" name="inTbFieldTripsImg3" id="inTbFieldTripsImg3" class="filestyle" />
                                            </div>
                                        </div>
                                    </div>
                                </div>    

                                <div class="row">
                                    <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                                </div>
                                <input type="hidden" name="id" id="id" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();

        var image = $('#inTbFieldTripsImg1').val();
        var ext1 = $("#inTbFieldTripsImg1").val().split('.').pop().toLowerCase();
        var image = $('#inTbFieldTripsImg2').val();
        var ext1 = $("#inTbFieldTripsImg2").val().split('.').pop().toLowerCase();
        var image = $('#inTbFieldTripsImg3').val();
        var ext1 = $("#inTbFieldTripsImg3").val().split('.').pop().toLowerCase();

        //
        if ((image != "" && jQuery.inArray(ext1, ['jpg']) == -1)) {
            alert("ไฟล์ภาพจะต้องเป็นชนิด jpg เท่านั้น");
            $(":file").filestyle('clear');
            return false;
        }
        $.ajax({
            url: "<?php echo site_url('field-trips-update'); ?>",
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