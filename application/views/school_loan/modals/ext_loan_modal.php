<div id="ext-loan-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?>
            <div class="modal-body">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">วัน เดือน ปี</label>
                            <input type="text" name="inExtDate" id="inExtDate" class="form-control datepicker" placeholder="คลิกวันที่..." required/>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">ชื่อโครงการ</label>
                            <input type="text" name="inExtName" id="inExtName" class="form-control"  required/>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ประเภทโครงการ</label>
                            <input type="text" name="inExtType" id="inExtType" class="form-control" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">สถานที่</label>
                            <input type="text" name="inExtPlace" id="inExtPlace" class="form-control" />
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label">งบประมาณ (บาท)</label>
                            <input type="text" name="inExtLoan" id="inExtLoan" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">ผู้รับผิดชอบโครงการ</label>
                            <input type="text" name="inExtLeader" id="inExtLeader" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">โทรศัพท์มือถือ</label>
                            <input type="text" name="inExtLeaderMobile" id="inExtLeaderMobile" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label">ผู้ประสานงานโครงการ</label>
                            <input type="text" name="inExtCoordinator" id="inExtCoordinator" class="form-control" />
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">โทรศัพท์มือถือ</label>
                            <input type="text" name="inExtCoordinatorMobile" id="inExtCoordinatorMobile" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">โรงเรียน</label>
                            <input type="text" name="inExtSchool" id="inExtSchool" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label class="control-label">เอกสาร</label>
                            <input type="file" name="inExtDocument" id="inExtDocument" class="filestyle" />
                        </div>
                        <div class="form-group col-md-7">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inExtComment" id="inExtComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <center>
                                <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                            </center>
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
        var file = $('#inExtDocument').val();
        var ext = $('#inExtDocument').val().split('.').pop().toLowerCase();
        if (file != '') {
            if (jQuery.inArray(ext, ['pdf']) == -1) {
                alert('ไฟล์เอกสารโครงการจะต้องเป็นชนิด PDF เท่านั้น');
                return false;
            }
        }
        $.ajax({
            url: '<?= site_url('insert-loan-management-external');?>',
            method: 'POST',
            data: new FormData(this),
            cache: false,
            processData: false,
            contentType: false,
            success: function () {
                alert('บันทึกข้อมูลเรียบร้อย');
                location.reload();
            }
        });
    });
</script>