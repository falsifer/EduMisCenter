<div id="loan-detail-transfer-modal" class="modal fade" role="dialog">
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
                        <div class="form-group col-md-4">
                            <label class="control-label">ไตรมาสที่</label>
                            <select name="inLoanTerm" id="inLoanTerm" class="form-control">
                                <option value="">--เลือกข้อมูล--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">วันที่โอน</label>
                            <input type="text" autocomplete="off" name="inLoanDate" id="inLoanDate" class="form-control datepicker" placeholder="คลิกวันที่..."/>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">จำนวนที่โอน (บาท)</label>
                            <input type="text" name="inLoanTransfer" id="inLoanTransfer" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="school_id" id="school_id" value="<?php echo $this->uri->segment(2); ?>" />
                    <input type="hidden" name="loan_define_detail_id" id="loan_define_detail_id" value="<?php echo $this->uri->segment(3); ?>" />
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
            url: '<?php echo site_url('insert-loan-detail-transfer'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function () {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>