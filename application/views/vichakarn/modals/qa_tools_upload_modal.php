<div id="qa-tools-upload-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog"style="width:90%;">
        <div class="modal-content">
<!--            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>-->
             <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <div class="modal-body">
                <div class="row">
                    <form method="post" id="qa-tools-insert-form" enctype="multipart/form-data">
                        <input type="hidden" name="inTbQAPlanKpiID" id="inTbQAPlanKpiID" />
                        <div class="col-md-12" style="padding: 10px;">
                            <input type="file" class='filestyle' name="inTbQAPlanKpiAttachment" id="inTbQAPlanKpiAttachment" />
                        </div>
                        <div class="col-md-12">
                            <center>
                                <button class="btn btn-success" type="submit"><i class="icon-save"></i> บันทึก</button>
                            </center>
                        </div>
                    </form>

                </div>

            </div>

        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>
$("#qa-tools-insert-form").on("submit", function (e) {
        $.ajax({
            url: "<?php echo site_url('Qa/attachment_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert(data);
//                alert("นำเข้าข้อมูลสำเร็จ");
//                $("#qa-tools-insert-form")[0].reset();
//                location.reload();
            }
        });
    });

</script>


