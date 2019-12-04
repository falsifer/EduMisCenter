<!-- Modal -->
<div id="dc-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="dc-insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label class="control-label">กลุ่มสาระการเรียนรู้</label>
                                <select name="inGroupLearningName" id="inGroupLearningName" class="form-control">
                                    <option value="">---เลือกข้อมูล---</option>
                                    <?php foreach ($row as $rs): ?>
                                        <option value="<?php echo $rs['id']; ?>"><?php echo $rs['tb_group_learningcol_name']; ?></option>
                                    <?php endforeach; ?>  
                                </select>
                            </div>
                            <div class="col-md-4 form-group">                            
                                <label class="control-label">ชื่อวิชา</label>
                                <input type="text"  name="inSubjectName" id="inSubjectName" class="form-control" autofocus  required=""/>
                            </div>
                            <div class="col-md-2 form-group">                            
                                <label class="control-label">อักษรย่อ</label>
                                <input type="text" name="inSubjectAbbreviation" id="inSubjectAbbreviation" class="form-control" required=""/>
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">ประเภทวิชา</label>
                                <select name="inSubjectType" id="inSubjectType" class="form-control" required="">
                                    <option value="">--เลือกข้อมูล--</option>
                                    <?php foreach ($sjtype as $r): ?>
                                        <option value="<?php echo $r['tb_subject_type_name']; ?>"><?php echo $r['tb_subject_type_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
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
    $("#dc-insert-form").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "<?php echo site_url('Dc/dc_modal_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });

    var code = "";
    $('#inGroupLearningName').change(function () {

        GlCode();
    });

    function GlCode() {
        code = $('#inGroupLearningName').val();
        if (code != "") {
            $.ajax({
                url: "<?php echo site_url('Dc/dc_code'); ?>",
                method: "post",
                data: {id: code},
                dataType: "json",
                success: function (data) {
                    $('#inSubjectAbbreviation').val(data.tb_group_learning_code);
                }
            });
        }
        if (code == "9") {
            $('#inSubjectType').val("กิจกรรม");
        }
    }
</script>