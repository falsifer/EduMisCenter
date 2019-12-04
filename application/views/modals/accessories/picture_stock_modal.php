<!-- Modal -->
<div id="picture-stock-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="post" id="insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label">ชื่อภาพ</label><span class="star">&#42;</span>
                                <input type="text" name="inPictureName" id="inPictureName" class="form-control" required autofocus/>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">ประเภท</label>
                                <select name="inPictureGroupId" id="inPictureGroupId" class="form-control">
                                    <option value="">---เลือกข้อมูล---</option>
                                    <?php foreach ($picture_group as $group): ?>
                                        <option value="<?php echo $group['id']; ?>"><?php echo $group['picture_group']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">อธิบายภาพ</label>
                                <input type="text" name="inPictureComment" id="inPictureComment" class="form-control" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">ภาพถ่าย</label><span class="star">&#42;</span>
                                <input type="file" name="inPictureFile" id="inPictureFile" class="filestyle" />
                            </div>
                        </div>
                        <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center></div>
                        <div class="row">
                            <div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div>
                        </div>
                        <input type="hidden" name="id" id="id" />
                    </form>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    //
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        var file = $("#inPictureFile").val();
        var ext = $("#inPictureFile").val().split('.').pop().toLowerCase();
        var id = $('#id').val();
        //
        if (id != '') {
            if (file != '') {
                if (jQuery.inArray(ext, ['jpg']) == -1) {
                    alert('ไฟล์ภาพจะต้องเป็นชนิด jpg เท่านั้น');
                    $(":file").filestyle('clear');
                    return false;
                }
            }
        } else {
            if (file == "") {
                alert("กรุณาเลือกไฟล์ภาพก่อนดำเนินการต่อไป");
                return false;
            }
            //
            if (jQuery.inArray(ext, ['jpg']) == -1) {
                alert('ไฟล์ภาพจะต้องเป็นชนิด jpg เท่านั้น');
                $(":file").filestyle('clear');
                return false;
            }
            //
        }
        $.ajax({
            url: '<?php echo site_url('insert-picture-stock'); ?>',
            method: 'post',
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