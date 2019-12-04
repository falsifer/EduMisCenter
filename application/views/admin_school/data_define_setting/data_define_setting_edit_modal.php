<!-- Modal -->
<div id="data-define-setting-edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="insert-form" enctype="multipart/form-data">

                        <div class="row" style="margin-bottom: 20px;"> 
                            <center>
                                <div class="btn form-control" id='BtnPreview' style="height: 100px ;width: 350px; background: #000000; font-size: 1.95em !important;text-align: left">
                                    <div class='col-md-3'>
                                        <img id="blah" src='<?php echo base_url() ?>/images/menu/assignment.png' style="width: 85px" />
                                    </div>
                                    <div class='col-md-8 col-md-offset-1' style='margin-top: 20px;'>
                                        <p>ตัวอย่าง Text ....</p>
                                    </div>
                                </div>
                            </center>
                        </div>

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                
                                <div class="col-md-4 form-group">
                                    <label class="control-label">ชื่อเมนู</label>
                                    <input type="text" name="inDataDefineName" id="inDataDefineName" class="form-control" autofocus  required/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="control-label">ภาพสัญลักษ์เมนู</label>
                                    <input type="file" name="inDataDefinePicture" id="inDataDefinePicture" class="filestyle" onchange="ShowImg(this)"/>

                                </div>
                                <div class="col-md-2 form-group">
                                    <label class="control-label">สีเมนู</label>
                                    <br>
                                    <input type="color" id="inDataDefineColor" name="inDataDefineColor" value="#000000"  style="width: 200px;height: 40px" onchange='ShowBgColor(this)'>
                                </div>
                            </div>   
                        </div>

                        <div class="row">
                            <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                        </div>
                        <input type="hidden" name="id" id="id" />

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function ShowImg(e) {
        if (e.files && e.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah')
                        .attr('src', e.target.result)
            };
            reader.readAsDataURL(e.files[0]);
        }
    }
</script>
<script>
    function BgColor(e) {
        document.getElementById("BtnPreview").style.background = $('#inDataDefineBgColor').val();
    }
    function FontColor(e) {
        document.getElementById("MyFont").style.color = $('#inDataDefineFontColor').val();
    }

    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('Admin_school/data_define_setting_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกสำเร็จ");
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
</script>