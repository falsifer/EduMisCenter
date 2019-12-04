<!-- Modal -->
<div id="school-type-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body">
                <form method="post" id="school-type-form">
                    <div class="row" style="margin-top:20px;">
                        <div class="form-group col-md-11">
                            <label class="control-lael col-md-3">ประเภทสถานศึกษา</label>
                            <div class="col-md-7">
                                <input type="text" name="inSchoolType" id="inSchoolType" class="form-control" atofocus required />
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                            </div>
                        </div>
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
    $("#school-type-form").on("submit",function(e){
       e.preventDefault();
       $.ajax({
           url:"<?php echo site_url('insert-school-type'); ?>",
           method:"POST",
           data:$("#school-type-form").serialize(),
           success:function(data){
               $('#school-type-form')[0].reset();
               location.reload();
           }
       });
    });
</script>
