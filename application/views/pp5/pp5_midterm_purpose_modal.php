<!-- Modal -->
<div id="pp5-midterm-purpose-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">

            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>

            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="pp5-midterm-purpose-insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-7 form-group">
                                <label class="control-label">ที่มาของคะแนน</label>
                                <input type="text" name="inTopicPurposeName" id="inTopicPurposeName" class="form-control" autofocus  required=""/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">คะแนนเต็ม</label>
                                <input type="text" name="inTopicPurposeScore" id="inTopicPurposeScore" class="form-control" required="" maxlength="2" onkeypress='validate(event)'/>
                            </div>
                            <div class="col-md-2 form-group">
                                <button type="button" class="btn btn-info btn-insert" style="margin-top: 26px;" onclick="InsertMidTermPurposeOnclick(this)" data-toggle="tooltip" data-placement="top" title="Tooltip on top"><i class="icon-plus icon-large"></i> บันทึกข้อมูล</button>
                            </div>
                            <input type="hidden" name="inMidTermPurposeTopicId" id="inMidTermPurposeTopicId" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function InsertMidTermPurposeOnclick(e) {
        var topic = $("#inTopicPurposeName").val();
        var score = $("#inTopicPurposeScore").val();
        var recordid = $("#inMidTermPurposeTopicId").val();

        $.ajax({
            url: "<?php echo site_url('PP5/insert_midterm_purpose_topic'); ?>",
            method: "post",
            data: {topic: topic, score: score, id: MyPurposeId, recordid: recordid},
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                location.reload();
            }
        });
    }

</script>