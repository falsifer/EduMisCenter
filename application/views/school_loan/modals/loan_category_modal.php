<!-- Modal -->
<div id="loan-category-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?>
            <div class="modal-body">
                <form id="insert-form" method="post" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-10">
                            <label class="control-label col-md-3">หมวดค่าใช้จ่าย</label>
                            <div class="col-md-8">
                                <input type="text" name="inLoanCategory" id="inLoanCategory" class="form-control" required autofocus/>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                            </div>
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
            url: '<?php echo site_url('insert-loan-category'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function () {
                alert("บันทึกข้อมูลเรียบร้อย");
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>