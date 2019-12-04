<!-- Modal -->
<div id="dc-standard-score-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="standard-score-modal-insert-form" enctype="multipart/form-data">
                        <div class="row">                                    
                            <b id="HeadStand"></b>
                            <br></br>
                        </div>

                        <div class="col-md-12" id="standard-score">
                            <input type="text" name="kpiId" id="kpiId" value="" />
                        </div>
                        <div class="row">
                            <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script>

    $("#standard-score-modal-insert-form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('Dc/insert_standard'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#standard-score-modal-insert-form")[0].reset();
                location.reload();
            }
        });
    });

</script>