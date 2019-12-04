<!-- Modal -->
<div id="ev-payment-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">วันที่ดำเนินงาน</label>
                            <input type="text" name="inPaymentDate" id="inPaymentDate" autocomplete="off" class="form-control datepicker" data-date-format="yyyy-mm-dd" required="" placeholder="คลิกวันที่..." />
                        </div>
                        <div class="form-group col-md-9">
                            <label class="control-label">รายการ</label>
                            <input type="text" name="inPaymentDetail" id="inPaymentDetail" class="form-control"  />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label">หน่วยนับ</label>
                            <select name="inUnitId" id="inUnitId" class="form-control">
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($unit as $u): ?>
                                    <option value="<?php echo $u['id']; ?>"><?php echo $u['unit_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">จำนวน</label>
                            <input type="text" name="inPaymentAmount" id="inPaymentAmount" class="form-control" />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">หน่วยละ</label>
                            <input type="text" name="inPaymentCost" id="inPaymentCost" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inPaymentComment" id="inPaymentComment" class="form-control" />
                        </div>
                    </div>

                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="ev_id" id="ev_id" value="<?php echo $this->uri->segment(2); ?>" />
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-education-evaluation-payment'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>