<div id="loan-ext-payment-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
<!--            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>-->
<?php $this->load->view('layout/my_school_modal_header'); ?>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">วัน เดือน ปี</label>
                            <input type="text" name="inPaymentDate" id="inPaymentDate" class="form-control datepicker" placeholder="คลิกวันที่..." />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">รายการ</label>
                            <input type="text" name="inPaymentTitle" id="inPaymentTitle" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">จำนวน</label>
                            <input type="text" name="inPaymentAmount" id="inPaymentAmount" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">หน่วยนับ</label>
                            <select name="inUnitId" id="inUnitId" class="form-control">
                                <option value="">--เลือกข้อมูล--</option>
                                <?php foreach ($unit as $u): ?>
                                    <option value="<?= $u['id']; ?>"><?= $u['unit_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ราคา/หน่วย (บาท)</label>
                            <input type="text" name="inPaymentCost" id="inPaymentCost" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inPaymentComment" id="inPaymentComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                            </center>
                        </div>
                    </div>
                    <input type="hidden" name="loan_ext_id" id="loan_ext_id" value="<?= $this->uri->segment(2); ?>" />
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
   
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th', format: 'yyyy-mm-dd'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?= site_url('insert-payment-external');?>',
            method: 'POST',
            data: $('#insert-form').serialize(),
            success: function () {
                alert('บันทึกข้อมูลเรียบร้อย');
                location.reload();
            }
        });
    });
</script>