<!-- Modal -->
<div id="edoc-forward-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal"><i class="icon-power-off"></i></button>
                <h3 class="modal-title" id="title">ส่งเรื่องต่อ</h2>
            </div>
            <div class="modal-body">
                <input type="hidden" id="inPermission" name="inPermission" />
                <input type="hidden" id="inTrackingType" name="inTrackingType" />
                <table class="table table-hover table-striped table-bordered display" id="inBoxTab">
                    <thead>
                        <tr>
                            <th style="width:40px;">ที่</th>
                            <th class="no-sort">เลขที่รับ</th>
                            <th class="no-sort">รายละเอียด</th>
                            <th class="no-sort">การติดตาม</th>
                        </tr>
                    </thead>
                    <tbody id="inboxView">

                    </tbody>
                </table>
                <div class="databox">
                    <form method="post" id="insert-form" enctype="multipart/form-data">
                        <div class=" box">
                            <legend class="legend-heading" style="padding:10px;"><i class="icon-list icon-large"></i> รายละเอียด</legend>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6" style="margin-bottom:10px;">
                                        <div class="input-group">
                                            <span class="input-group-addon">วันที่เกษียนหนังสือราชการ</span>
                                            <input type="text" name="inActivityPlanStartDate" id="inActivityPlanStartDate" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>"  data-date-format="yyyy-mm-dd" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:10px;">
                                        <div class="input-group">
                                            <span class="input-group-addon">เกษียนหนังสือราชการ</span>
                                            <textarea class="form-control" rows="5" autofocus></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <legend class="legend-heading" style="padding:10px;"><i class="icon-user icon-large"></i> รายชื่อผู้รับหนังสือ <div style="float: right"><input type="checkbox" id="selectAll" />  ทุกคน</div></legend>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4" style="margin-bottom:10px;">
                                        <ul class="list-group">
                                            <li class="list-group-item active"><input type="checkbox" id="selectManager" />  ผู้บริหาร</li>

                                            <?php
                                            foreach ($hr_manager as $r):
                                                ?>
                                                <li class="list-group-item"><input type="checkbox" id="manager[]" name="manager[]" /> <?php echo $r['hr_thai_symbol'] . $r['hr_thai_name'] . " " . $r['hr_thai_lastname']; ?></li>
                                                <?php
                                            endforeach;
                                            ?>
                                        </ul>
                                    </div>
                  <?php
                  
                  /////////////////// ถ้าชัั้นความลับเป็นปกติ และ การติดตามเป็นแจ้งเพื่อโปรดทราบ จะสามารถส่งเอกสารให้ทุกคนได้โดยตรงเลย
                  
                  ?>
                                    <div class="col-md-4" style="margin-bottom:10px;">
                                        <ul class="list-group">
                                            <li class="list-group-item active"><input type="checkbox" id="selectDivision" />  ฝ่ายงาน</li>
                                            <?php
                                            foreach ($hr_division as $r):
                                                ?>
                                                <li class="list-group-item"><input type="checkbox" name="division[]" id="division[]" /> <?php echo $r['tb_division_name'] ?></li>
                                                <?php
                                            endforeach;
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="col-md-4" style="margin-bottom:10px;">

                                        <ul class="list-group">
                                            <li class="list-group-item active"><input type="checkbox" id="selectGroupL" /> กลุ่มสาระ</li>
<?php
foreach ($hr_group_learning as $r):
    ?>
                                                <li class="list-group-item"><input type="checkbox" name="groupL[]" id="groupL[]" /> <?php echo $r['tb_group_learningcol_name'] ?></li>
                                                <?php
                                            endforeach;
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="margin-bottom:10px;">
                                        <button class="btn btn-success form-control"><i class="glyphicon glyphicon-send"></i> บันทึกเรื่องส่งต่อ</button>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <input type="hidden" name="id" id="id" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th', format: 'yyyy-mm-dd'});
    //
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        var file = $('#inOutboxFile').val();
        var ext = $('#inOutboxFile').val().split('.').pop().toLowerCase();
        var pid = $('#id').val();
        if (pid != '') {
            if (file != '' && jQuery.inArray(ext, ['pdf']) == -1) {
                alert('ชนิดไฟล์เอกสารแนบจะต้องเป็น pdf เท่านั้น');
                return false;

            }
        } else {
            // กรณีไฟล์มีค่าว่าง
            if (file == '') {
                alert('ไฟล์แนบจะมีค่าว่างไม่ได้...');
                return false;
            }
            // กรณีไฟล์มีค่าไม่ว่าง
            if (file != '' && jQuery.inArray(ext, ['pdf']) == -1) {
                alert('ชนิดไฟล์เอกสารแนบจะต้องเป็น pdf เท่านั้น');
                return false;
            }
        }
        //
        $.ajax({
            url: '<?php echo site_url('send-document-to'); ?>',
            method: 'post',
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });


    $('#selectAll').change(function () {
        var checkboxes = $(this).closest('form').find(':checkbox');
        checkboxes.prop('checked', $(this).is(':checked'));
    });

    $('#selectManager').change(function () {
        var checked_status = this.checked;
        $("input[name='manager[]']").each(function () {
            this.checked = checked_status;
        });
        if(!checked_status){
            $('#selectAll').prop('checked', false); 
        }
        
    });
    
    $('#selectdivision').change(function () {
        var checked_status = this.checked;
        $("input[name='division[]']").each(function () {
            this.checked = checked_status;
        });
        if(!checked_status){
            $('#selectAll').prop('checked', false); 
        }
        
    });
    
    $('#selectGroupL').change(function () {
        var checked_status = this.checked;
        $("input[name='groupL[]']").each(function () {
            this.checked = checked_status;
        });
        if(!checked_status){
            $('#selectAll').prop('checked', false); 
        }
        
    });

</script>
