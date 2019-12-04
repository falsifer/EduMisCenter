<!-- Modal -->
<div id="insert-plan-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#060150;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-plan-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">ชื่อแผน</label>
                            <input type="text" name="inMainPlanName" id="inMainPlanName" placeholder="แผนพัฒนาการศึกษา" class="form-control" autofocus required/> 
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar"></i> วันที่เริ่ม</span>
                                <input type="text" name="inProjectStart" id="inProjectStart" class="form-control datepicker"  placeholder="คลิกเลือกวันที่..."  data-date-language="th-th" data-date-format="yyyy-mm-dd" required/>
                               
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar"></i> วันที่สิ้นสุด</span>
                                <input type="text" name="inProjectEnd" id="inProjectEnd" class="form-control datepicker"  placeholder="คลิกเลือกวันที่..."  data-date-language="th-th" data-date-format="yyyy-mm-dd" required/>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id" />
                    
                    <div class="row" style="margin-top: 20px;">
                        <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>
                    
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    $("#insert-plan-form").on("submit", function (e) {
        e.preventDefault();
 
        $.ajax({
            url: "<?php echo site_url('ProjectPlan/insert_plan'); ?>",
            method: "post",
            data: $("#insert-plan-form").serialize(),
            success: function (data) {
                $("#insert-plan-form")[0].reset();
                location.reload();
                alert('บันทึกเรียบร้อย');
            }
        });
    });

</script>