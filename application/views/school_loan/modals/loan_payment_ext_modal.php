<!-- Modal -->
<div id="loan-management-ext-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?>
            <div class="modal-body">
                <form method="post" id="insert-form" enctype="multipart/form-data" >
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label class="control-label">ปีงบประมาณ</label>
                            <input type="text" name="inLoanYear" id="inLoanYear" class="form-control" autofocus required />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ประเภทงบอุดหนุน</label>
                            <input type="text" name="inLoanGroup" id="inLoanGroup" class="form-control" />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">จำนวนเงิน (บาท)</label>
                            <input type="number" name="inLoanAmount" id="inLoanAmount" class="form-control" />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">โรงเรียนเป้าหมาย</label>
                            <input type="text" name="inSchoolName" id="inSchoolName" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">เอกสารอ้างอิง</label>
                            <input type="file" name="inLoanDocument" id="inLoanDocument" class="filestyle" />
                        </div>
                        <div class="form-group col-md-8">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inLoanComment" id="inLoanComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center></div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('insert-loan-managment'); ?>",
            method: "POST",
            data: new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>