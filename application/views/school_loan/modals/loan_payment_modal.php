<!-- Modal -->
<div id="loan-payment-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label">วัน เดือน ปี</label>
                            <input type="text" autocomplete="off" name="inPaymentDate" id="inPaymentDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" required placeholder="คลิกวันที่..." />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">เลขที่สำคัญอ้างอิง</label>
                            <input type="text" name="inPaymentNo" id="inPaymentNo" class="form-control" />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">จำนวนเงิน (บาท)</label>
                            <input type="number" name="inPaymentAmount" id="inPaymentAmount" class="form-control" />
                        </div>
                        <div class="form-group col-md-5">
                            <label class="control-label">ผู้รับ</label>
                            <input type="text" name="inPaymentReciever" id="inPaymentReciever" class="form-control" />
                        </div>
                    </div>
                    <div class="row"><center>
                            <button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="loan_id" id="loan_id" value="<?php echo $this->uri->segment(2); ?>" />
                </form>
            </div>
            
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-loan-payment-detail'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>