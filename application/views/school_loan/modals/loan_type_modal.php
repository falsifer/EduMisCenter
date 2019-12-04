<div id="loan-type-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?>
            <div class="modal-body">
                <form method="post" id="insert-form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">หมวดเงินโอน</label>
                            <select name="inLoanCategoryId" id="inLoanCategoryId" class="form-control" required>
                                <option value="">---เลือกข้อมูล---</option>
                                <?php foreach ($category as $c): ?>
                                    <option value="<?php echo $c['id'] ?>"><?php echo $c['loan_category']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">ประเภทเงินโอน</label>
                            <input type="text" name="inLoanType" id="inLoanType" class="form-control" autofocus required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                        </div>
                    </div>
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
            url: "<?php echo site_url('insert-loan-type'); ?>",
            method: "POST",
            data: $("#insert-form").serialize(),
            success: function () {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>