<!-- Modal -->
<div id="excellence-insert-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <?php $this->load->view("layout/my_school_modal_header"); ?>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" id="insert-form" enctype="multipart/form-data">
                                <div style='margin-top:20px;' class="col-md-6 form-group">
                                    <label class="control-label">เรื่อง</label>
                                    <input type="text" name="inExcellenceName" id="inExcellenceName" class="form-control" autofocus required/>
                                </div>

                                <div style='margin-top:20px;' class="col-md-3 form-group">
                                    <label class="control-label">ประเภทผลงาน</label>
                                    <select name="inExcellenceType" id="inExcellenceType" class="form-control">
                                        <option value="">---เลือกข้อมูล---</option>
                                        <option value="กีฬา">การแข่งขันกีฬา</option>
                                        <option value="วิชาการ">การแข่งขันทางด้านวิชาการ</option>
                                    </select>
                                </div>
                                <div style='margin-top:20px;' class="col-md-3 form-group">
                                    <label class="control-label">ระดับ</label>
                                    <input type="text" name="inExcellenceLevel" id="inExcellenceLevel" class="form-control" placeholder='ระดับจังหวัด,ระดับประเทศ,ระดับเขต...'/>
                                </div>
                                <div style='margin-top:20px;' class="col-md-12 form-group">
                                    <label class="control-label">รายละเอียด</label>
                                    <textarea id="inExcellenceDetail" name="inExcellenceDetail" style="width:100%;height:100px;"></textarea>
                                </div>
                                <div style='margin-top:20px;' class="col-md-4 form-group">
                                    <label class="control-label">ตั้งแต่</label>
                                    <input autocomplete='off' type="text" name="inExcellenceStartDate" id="inExcellenceStartDate" class="form-control datepicker" placeholder="คลิกวันที่..." data-date-format="yyyy-mm-dd" required/>

                                </div>

                                <div style='margin-top:20px;' class="col-md-4 form-group">
                                    <label class="control-label">จนถึง</label>
                                    <input autocomplete='off' type="text" name="inExcellenceEndDate" id="inExcellenceEndDate" class="form-control datepicker" placeholder="คลิกวันที่..." data-date-format="yyyy-mm-dd" required/>

                                </div>

                                <div style='margin-top:20px;' class="col-md-4 form-group">
                                    <label class="control-label">ภาพประกอบ</label><font style='color:red;font-size:0.7em;'> * ชื่อไฟล์ห้ามมีตัวอักษรจุด(.)</font>    
                                    <input type="file" class='filestyle' multiple="multiple" name="inExcellenceFile[]" id="inExcellenceFile[]" />
                                </div>    

                                <div style='margin-top:20px;' class="col-md-12 form-group" >
                                    <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                                </div>
                                <input type="hidden" name="id" id="id" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    $("#insert-form").on("submit", function (e) {
        $.ajax({
            url: "<?php echo site_url('Excellence/excellence_insert'); ?>",
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