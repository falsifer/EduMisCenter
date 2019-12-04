<!-- Modal -->
<div id="ic-topic-modal" class="modal fade" style="overflow: auto; " role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="ic-topic-insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3 form-group" >
                                        <label class="control-label">องค์ประกอบของการควบคุมภายใน</label>
                                    </div>  
                                </div>

                                <div class="row">
                                    <div class="col-md-2 form-group">
                                        <select name="inPlanSequence" id="inPlanSequence" class="form-control" >
                                            <option value="">--เลือกลำดับที่--</option> 
                                            <?php $seq = 10; ?>
                                            <?php for ($i = 1; $i <= $seq; $i++) { ?>
                                                <option value=<?php echo $i; ?>>ลำดับที่ <?php echo $i; ?></option>                                                    
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-10 form-group" >
                                        <input type="text" id="inTopicContent" name="inTopicContent" class="form-control" required autofocus="">
                                    </div>   
                                    <div class="col-md-12  form-group">
                                        <label class="control-label">รายละเอียดขององค์ประกอบ</label>                                                        
                                        <textarea class="form-control" name="inTopicDescription" id="inTopicDescription" ></textarea>
                                    </div>
                                    <div class="col-md-12  form-group">
                                        <label class="control-label">ผลการประเมิน/ข้อสรุป</label>                                                        
                                        <textarea class="form-control" name="inTopicDescription" id="inTopicDescription" ></textarea>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-md-12 form-group" >
                                        <center>
                                            <button type="button" class="btn btn-info btn-topic-insert" id=""><i class="icon-plus icon-large"></i> บันทึก</button>
                                        </center>
                                    </div>
                                </div>
                                <div class="row" id="TopicBody">

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
    var TopicId = 0;
    
    $("#TopicBody").on("click", ".btn-topic-sub", function () {
        var uid = $(this).attr('id');
        TopicId = uid;
        $("h3.modal-title").text("จัดการองค์ประกอบของการควบคุม");
        $("#ic-topic-modal").modal("hide");
        $("#ic-topic-sub-modal").modal("show");
    });
</script>