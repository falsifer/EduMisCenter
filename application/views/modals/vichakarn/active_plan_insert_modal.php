<div id="plan-insert-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">บันทึกรายละเอียดแผนการศึกษาและปฏิทินปฏิบัติงาน</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form method="post" id="plan-insert-form"">

                            <div class="form-group col-md-8">
                                <label class="control-label">กิจกรรม/โครงการ/แผน</label>
                                <input type="text" name="inActivityPlanSubject" id="inActivityPlanSubject" class="form-control" required autofocus />
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">กิจกรรมประจำ</label>
                                <select name="inActivityPlanDivision" id="inActivityPlanDivision" class="form-control" required>
                                    <option value="">---เลือกข้อมูล---</option>
                                    <?php
                                    $output = "<option value='" . $this->session->userdata('department') . "'>" . $this->session->userdata('department') . "</option>";
                                    foreach ($Division as $d) {
                                        $output .= "<option value='ฝ่าย" . $d['tb_division_name'] . "'>ฝ่าย" . $d['tb_division_name'] . "</option>";
                                    }                                    
                                    echo $output;
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label class="control-label">วันที่เริ่มกิจกรรม</label>
                                <div class="input-group">
                                    <input type="text" name="inActivityPlanStartDate" id="inActivityPlanStartDate" class="form-control datepicker" placeholder="คลิกวันที่..." data-date-format="yyyy-mm-dd" required/>

                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">วันที่สิ้นสุดกิจกรรม</label>
                                <div class="input-group">
                                    <input type="text" name="inActivityPlanEndDate" id="inActivityPlanEndDate" class="form-control datepicker" placeholder="คลิกวันที่..." data-date-format="yyyy-mm-dd" required/>

                                </div>

                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">สถานที่</label>
                                <input type="text" name="inActivityPlanPlace" id="inActivityPlanPlace" class="form-control"  value='<?php echo $this->session->userdata('department'); ?>'/>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">ประเภท</label>
                                <select name="inActivityPlanType" id="inActivityPlanType" class="form-control" required>
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="กิจกรรม">กิจกรรม</option>
                                    <option value="แผน/โครงการ">แผน/โครงการ</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">การเผยแพร่ข้อมูล</label>
                                <select name="inActivityPlanPublic" id="inActivityPlanPublic" class="form-control" required>
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="Y">สาธารณะ</option>
                                    <option value="N">ภายใน</option>
                                </select>
                            </div><div class="form-group col-md-12">
                                <label class="control-label">รายละเอียด</label>
                                <textarea name="inActivityPlanDetail" id="inActivityPlanDetail" class="form-control" rows="6" ></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <center><button type="button" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>  
                            </div>
                            <input type="hidden" name="id" id="id" />
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>

    $(".datepicker").datepicker({autoclose: true, language: 'th'});

    $("#plan-insert-form").on("click", ".btn-insert", function (e) {
        e.preventDefault();
        //
        $.ajax({
            url: "<?php echo site_url('School_calendar/activity_plan_add'); ?>",
            method: "post",
            data: $("#plan-insert-form").serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลสำเร็จ !');
                $("#plan-insert-form")[0].reset();
                location.reload();
            }

        });
    });





</script>
