<!-- Modal -->
<div id="document-type-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="insert-form" method="post" class="col-md-8" style="padding-top:30px;padding-bottom:20px;">
                        <div class="row">
                            <label class="control-label col-md-3">ประเภทเอกสาร</label>
                            <div class="col-md-7 form-group">
                                <input type="text" name="inDocumentType" id="inDocumentType" class="form-control" required="" autofocus=""/>
                            </div>
                            <div class="col-md-1">
                                <button type="submmit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                            </div>
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
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('insert-document-type'); ?>",
            method: "post",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });
    // edit data;
    $("#example").on("click", ".btn-edit", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('update-document-type'); ?>",
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                $('#inDocumentType').val(data.document_type);
                //
                $('h3.modal-title').text("ปรับปรุงข้อมูลประเภทเอกสาร");
                $("#document-type-modal").modal("show");
            }
        });
    });
</script>