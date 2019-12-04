<!-- Modal -->
<div id="pp5-midterm-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">

            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>

            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="pp5-midterm-insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-7 form-group">
                                <label class="control-label">ที่มาของคะแนน</label>
                                <input type="text" name="inTopicName" id="inTopicName" class="form-control" autofocus  required=""/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">คะแนนเต็ม</label>
                                <input type="text" name="inTopicScore" id="inTopicScore" class="form-control" required="" maxlength="2" onkeypress='validate(event)'/>
                            </div>
                            <div class="col-md-2 form-group">
                                <button type="button" class="btn btn-info btn-insert" style="margin-top: 26px;" onclick="InsertMidTermOnclick(this)" data-toggle="tooltip" data-placement="top" title="Tooltip on top"><i class="icon-plus icon-large"></i> บันทึกข้อมูล</button>
                            </div>
                            <input type="hidden" name="inMidTermTopicId" id="inMidTermTopicId" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function InsertMidTermOnclick(e) {
        var topic = $("#inTopicName").val();
        var score = $("#inTopicScore").val();
        var recordid = $("#inMidTermTopicId").val();

        $.ajax({
            url: "<?php echo site_url('PP5/insert_midterm_topic'); ?>",
            method: "post",
            data: {topic: topic, score: score, id: MyKpiId, recordid: recordid},
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                location.reload();
            }
        });
    }

</script>