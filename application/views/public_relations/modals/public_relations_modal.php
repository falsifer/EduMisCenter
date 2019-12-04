<div id="public-relations-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <!--            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                            <button type="button" class="close" data-dismiss="modal">X</button>
                            <h3 class="modal-title" id="title"></h3>
                        </div>-->
            <?php
            $this->load->view('layout/my_school_modal_header');
            ?>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="insert-form">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <input type="hidden" name="id" id="id" />
                            <label class="control-label">วันที่เผยแพร่ข่าวสาร</label>
                            <input type="text" autocomplete="off" name="inPrDate" id="inPrDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required/>
                        </div>
                        <div class="col-md-3 form-group">

                            <label class="control-label">ถึงวันที่</label>
                            <input type="text" autocomplete="off" name="inPrEndDate" id="inPrEndDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required/>
                        </div>
                        <div class="col-md-9 form-group">
                            <label class="control-label">หัวข้อประชาสัมพันธ์</label>
                            <input type="text" name="inPrTopic" id="inPrTopic" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">การเผยแพร่ข่าวสาร</label><span class="star">&#42;</span>&nbsp;&nbsp; 
                            <input class="magic-radio form-control" type="radio" name="inPRStatus"  value="สาธารณะ" id="r1" ><label for="r1">สาธารณะ</label>&nbsp;
                            <input class="magic-radio form-control" type="radio" name="inPRStatus"  value="ภายใน" id="r2" checked><label for="r2">ภายใน</label>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-grup col-md-12">
                            <label class="control-label">รายละเอียดเพิ่มเติม (โดยสังเขป)</label>
                            <!--<textarea style="width:100%;height:180px;" name="inPrDetail" id="inPrDetail"></textarea>-->
                            <textarea name="inPrDetail" id="inPrDetail" toolbar="Mytoolbar1">
                            </textarea>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-3 form-group">
                            <label class="control-label">ภาพที่ 1</label>
                            <input type="file" name="inPrImage1" id="inPrImage1" class="filestyle" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ภาพที่ 2</label>
                            <input type="file" name="inPrImage2" id="inPrImage2" class="filestyle" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ภาพที่ 3</label>
                            <input type="file" name="inPrImage3" id="inPrImage3" class="filestyle" />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ภาพที่ 4</label>
                            <input type="file" name="inPrImage4" id="inPrImage4" class="filestyle" />
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <center><input type="submit" value="บันทึกข่าว" class="btn btn-success" /></center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        var img1 = $('#inPrImage1').val();
        var img2 = $('#inPrImage2').val();
        var img3 = $('#inPrImage3').val();
        var img4 = $('#inPrImage4').val();
        //
        var ext1 = $('#inPrImage1').val().split('.').pop().toLowerCase();
        var ext2 = $('#inPrImage2').val().split('.').pop().toLowerCase();
        var ext3 = $('#inPrImage3').val().split('.').pop().toLowerCase();
        var ext4 = $('#inPrImage4').val().split('.').pop().toLowerCase();
        //
        if (img1 != '' && jQuery.inArray(ext1, ['jpg', 'png']) == -1) {
            alert('ไฟล์ประกอบที่ 1 จะต้องเป็นชนิด jpg หรือ png เท่านั้น');
            return false;
        }
        if (img2 != '' && jQuery.inArray(ext2, ['jpg', 'png']) == -1) {
            alert('ไฟล์ประกอบที่ 2 จะต้องเป็นชนิด jpg หรือ png เท่านั้น');
            return false;
        }
        if (img3 != '' && jQuery.inArray(ext3, ['jpg', 'png']) == -1) {
            alert('ไฟล์ประกอบที่ 3 จะต้องเป็นชนิด jpg หรือ png เท่านั้น');
            return false;
        }
        if (img4 != '' && jQuery.inArray(ext4, ['jpg', 'png']) == -1) {
            alert('ไฟล์ประกอบที่ 4 จะต้องเป็นชนิด jpg หรือ png เท่านั้น');
            return false;
        }
        
        var data = CKEDITOR.instances.inPrDetail.getData();
        $('#inPrDetail').val(data);
        $.ajax({
            url: "<?php echo site_url('insert-public-relations'); ?>",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('inPrDetail');
    function CKupdate() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }
</script>

