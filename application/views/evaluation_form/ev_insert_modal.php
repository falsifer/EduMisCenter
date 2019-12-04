<!-- Modal -->
<div id="ev-insert-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <form method="post" id="insert-form">
                    <div class="row">

                        <form method="post" id="insert-form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="control-label">หัวข้อการประเมิน</label>
                                    <textarea id="inEvBasename" name="inEvBasename" style="width:100%;height:100px;" autofocus  required=""></textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="control-label">คำตอบข้อที่1</label>
                                    <input type="text" name="inEvSubname1" id="inEvSubname1" class="form-control"/>
                                </div>  
                                <div class="col-md-12 form-group">
                                    <label class="control-label">คำตอบข้อที่2</label>
                                    <input type="text" name="inEvSubname2" id="inEvSubname2" class="form-control"/>
                                </div>  
                                <div class="col-md-12 form-group">
                                    <label class="control-label">คำตอบข้อที่3</label>
                                    <input type="text" name="inEvSubname3" id="inEvSubname3" class="form-control"/>
                                </div>  
                                <div class="col-md-12 form-group">
                                    <label class="control-label">คำตอบข้อที่4</label>
                                    <input type="text" name="inEvSubname4" id="inEvSubname4" class="form-control"/>
                                </div>  
                                <div class="col-md-12 form-group">
                                    <label class="control-label">คำตอบข้อที่5</label>
                                    <input type="text" name="inEvSubname5" id="inEvSubname5" class="form-control"/>
                                </div> 
                                <div class="row">
                                    <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                                </div>
                            </div>
                        </form>

                        <input type="text" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('ev-insert-name'); ?>',
            method: 'post',
            data: $('#insert-form').serialize(),
            success: function (data) {
                $('#insert-form')[0].reset();
                location.reload();
            }
        });
    });
</script>