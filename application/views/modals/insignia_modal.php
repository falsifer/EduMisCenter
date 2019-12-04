<!-- Modal -->
<div id="insignia-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="insert-form" enctype="multipart/form-data">
                    <div class="row" style="margin-top:20px;">
                        <div class="form-group col-md-2">
                            <label class="control-label">ชั้นที่</label>
                            <input type="text" name="inSigniaLevel" id="inSigniaLevel" class="form-control" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">ประเภทเครื่องราชอิสริยาภรณ์</label>
                            <input type="text" name="inSigniaName" id="inSigniaName" class="form-control" autofocus required/>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">ภาพแพรแถบ</label>
                            <input type="file" name="inSigniaLabelImage" id="inSigniaLabelImage" class="filestyle"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">ภาพเหรียญตรา</label>
                            <input type="file" name="inSigniaCoinImage" id="inSigniaCoinImage" class="filestyle"/>
                        </div>
                        <div class="form-group col-md-8">
                            <label class="control-label">หมายเหตุ</label>
                            <input type="text" name="inSigniaComment" id="inSigniaComment" class="form-control" />
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center>
                    </div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    //
    $('#insert-form').on('submit', function (e) {
        e.preventDefault();
        //
        var label = $('#inSigniaLabelImage').val();
        var label_ext = $('#inSigniaLabelImage').val().split('.').pop().toLowerCase();
        var coin = $('#inSigniaCoinImage').val();
        var coin_ext = $('#inSigniaCoinImage').val().split('.').pop().toLowerCase();
        //
        if (label != '' && jQuery.inArray(label_ext, ['jpg', 'png']) == -1) {
            alert('ภาพแพรแถบจะต้องเป็นชนิด jpg หรือ png เท่านั้น');
            return false;
        }
        //
        if (coin != '' && jQuery.inArray(coin_ext, ['jpg', 'png']) == -1) {
            alert('ภาพเหรียญตราจะต้องเป็นชนิด jpg หรือ png เท่านั้น');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-insignia-data'); ?>',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });

    });
</script>