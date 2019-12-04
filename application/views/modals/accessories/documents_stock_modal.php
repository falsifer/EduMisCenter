<!-- Modal -->
<div id="documents-stock-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="post" id="insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">ชื่อเอกสาร</label><span class="star">&#42;</span>
                                <input type="text" name="inDocumentsName" id="inDocumentsName" class="form-control" required autofocus/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">ประเภทเอกสาร</label><span class="star">&#42;</span>
                                <select name="inDocumentTypeId" id="inDocumentTypeId" class="form-control" required="">
                                    <option value="">---เลือกข้อมูล---</option>
                                    <?php foreach ($doc_type as $type): ?>
                                        <option value="<?php echo $type['id']; ?>"><?php echo $type['document_type']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">วัน/เดือน/ปี บรรจุ</label><span class="star">&#42;</span>
                                <input type="text" name="inDocInDate" id="inDocInDate" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="คลิกวันที่..." required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label class="control-label">เจ้าของ</label><span class="star">&#42;</span>
                                <input type="text" name="inDocOwner" id="inDocOwner" class="form-control" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">ไฟล์เอกสาร</label><span class="star">&#42;</span>
                                <input type="file" name="inDocFile" id="inDocFile" class="filestyle" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">หมายเหตุ</label>
                                <input type="text" name="inDocComment" id="inDocComment" class="form-control" />
                            </div>
                        </div>
                        <div class="row"><center><button type="submit" class="btn btn-success btn-save">บันทึกข้อมูล</button></center></div>
                        <input type="hidden" name="id" id="id" />
                        <div class="row">
                            <p>เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</p>
                        </div>
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
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        var file = $('#inDocFile').val();
        var ext = $('#inDocFile').val().split('.').pop().toLowerCase();
        var uid = $("#id").val();
        //
        if (uid != "") {
            if (file != "" && jQuery.inArray(ext, ['pdf', 'doc', 'docx', 'xls', 'xlsx']) == -1) {
                alert("ไฟล์เอกสารจะต้องเป็นชนิด pdf, exel, word เท่านั้น");
                $("#inDocFile").filestyle("clear");
                return false;
            }
        } else {
            if (file == "") {
                alert("ไฟล์เอกสารจะมีค่าว่างไม่ได้");
                $("#inDocFile").filestyle("clear");
                return false;
            }
            //
            if (file != "" && jQuery.inArray(ext, ['pdf', 'doc', 'docx', 'xls', 'xlsx']) == -1) {
                alert("ไฟล์เอกสารจะต้องเป็นชนิด pdf, exel, word เท่านั้น");
                $("#inDocFile").filestyle("clear");
                return false;
            }
        }
        $.ajax({
            url: "<?php echo site_url('insert-document-to-stock'); ?>",
            method: "post",
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