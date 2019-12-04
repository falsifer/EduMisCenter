<!-- Modal -->
<div id="responsible-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="post" id="insert-form" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label col-md-3">หน้าที่รับผิดชอบ</label>
                                <div class="col-md-8">
                                    <input type="text" name="inResponsible" id="inResponsible" class="form-control" autofocus required/>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                                </div>
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
    //
    $("#insert-form").on("submit",function(e){
       e.preventDefault();
       $.ajax({
           url:"<?php echo site_url('insert-responsible'); ?>",
           method:"post",
           data:$("#insert-form").serialize(),
           success:function(data){
               $("#insert-form")[0].reset();
               location.reload();
           }
       });
    });
</script>