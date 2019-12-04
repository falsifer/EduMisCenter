<!-- Modal -->
<div id="ap-assessment-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">

                <div class="container-fluid">
                    <form method="post" id="ap-assessment-insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row" id="AssessmentBody">

                                </div>
                            </div>     
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script>

    $("#AssessmentBody").on("click", ".btn-ap-fail", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Ap/ap_pass'); ?>",
            method: "post",
            data: {id: uid, Hrid: HrId},
            success: function (data) {
                $.ajax({
                    url: "<?php echo site_url('Ap/get_hr_ap'); ?>",
                    method: "POST",
                    data: {id: HrId},
                    success: function (data) {
                        $("#AssessmentBody").html(data);
                        $("h3.modal-title").text("ประเมินผล");
                        $("#ap-assessment-modal").modal("show");
                    }
                });
            }
        });
    });

    $("#AssessmentBody").on("click", ".btn-ap-pass", function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "<?php echo site_url('Ap/ap_fail'); ?>",
            method: "post",
            data: {id: uid},
            success: function (data) {
                $.ajax({
                    url: "<?php echo site_url('Ap/get_hr_ap'); ?>",
                    method: "POST",
                    data: {id: HrId},
                    success: function (data) {
                        $("#AssessmentBody").html(data);
                        $("h3.modal-title").text("ประเมินผล");
                        $("#ap-assessment-modal").modal("show");
                    }
                });
            }
        });
    });

</script>