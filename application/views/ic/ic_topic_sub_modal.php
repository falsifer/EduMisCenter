<!-- Modal -->
<div id="ic-topic-sub-modal" class="modal fade" style="overflow: auto; " role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="ic-topic-sub-insert-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row" >
                                    <label class="control-label"><font color="red"><label> (1)</label></font>เลือกฝ่ายงาน</label>
                                    <select name="inDivision" id="inDivision" class="form-control" >
                                        <option value="">---เลือกฝ่ายงาน---</option> 
                                        <?php foreach ($rDivision as $r): ?>
                                            <option value="<?php echo $r['id']; ?>">ฝ่าย<?php echo $r['tb_division_name']; ?></option> 
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>
                                <div class="row" >
                                    <div class="col-md-2 form-group" >
                                        <label class="control-label"><font color="red"><label> (2)</label></font>เลือกลำดับที่</label>
                                        <select name="inTopicSubSequence" id="inTopicSubSequence" class="form-control" >
                                            <option value="">--เลือกลำดับที่--</option> 
                                            <?php $seq = 10; ?>
                                            <?php for ($i = 1; $i <= $seq; $i++) { ?>
                                                <option value=<?php echo $i; ?>>ลำดับที่ <?php echo $i; ?></option>                                                    
                                            <?php } ?>
                                        </select>
                                    </div>  
                                    <div class="col-md-7 form-group" >
                                        <label class="control-label"><font color="red"><label> (3)</label></font>กรอกชื่อกิจกรรม</label>
                                        <input type="text" id="inTopicSubContent" name="inTopicSubContent" class="form-control" required autofocus="">
                                    </div>   
                                    <div class="col-md-1 form-group" >
                                        <font color="red"><label> (4)</label></font>
                                        <button type="button" class="btn btn-info btn-topic-sub-insert" id=""><i class="icon-plus icon-large"></i> เพิ่มกิจกรรม</button>
                                    </div> 
                                </div>
                                <br>

                                <br>
                                <div class="row" id="TopicSubBody">
                                                                    <div class="row" >
                                    <div class="col-md-7 form-group" >
                                        <label class="control-label"><font color="red"><label> (C)</label></font>กรอกเนื้อหาที่จะเพิ่ม</label>
                                        <input type="text" id="inTopicSubContentName" name="inTopicSubContentName" class="form-control"  autofocus="">
                                    </div>   
                                    <div class="col-md-1 form-group" >
                                        <font color="red"><label> (4)</label></font>
                                        <button type="button" class="btn btn-info btn-topic-sub-insert" id=""><i class="icon-plus icon-large"></i> เพิ่ม</button>
                                    </div> 
                                </div>
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

    $('#inDivision').on('change', function (e) {
        $("#TopicSubBody").html("");
        var Did = $("#inDivision").val();
        $.ajax({
            url: "<?php echo site_url('Ic/get_ic_topic_sub'); ?>",
            method: "POST",
            data: {id: Did, topicid: TopicId},
            success: function (data) {
                $("#TopicSubBody").html(data);
            }
        });
    });

    $("#ic-topic-sub-insert-form").on("click", ".btn-topic-sub-insert", function (e) {
        e.preventDefault();
        var Did = $("#inDivision").val();
        $.ajax({
            url: "<?php echo site_url('Ic/topic_insert'); ?>",
            method: "post",
            data: {content: $("#inTopicSubContent").val(), seq: $("#inTopicSubSequence").val(), division: Did, id: TopicId},
            success: function (data) {
                alert("บันทึกสำเร็จ");
                $.ajax({
                    url: "<?php echo site_url('Ic/get_ic_topic_sub'); ?>",
                    method: "POST",
                    data: {id: Did, topicid: TopicId},
                    success: function (data) {
                        $("#TopicSubBody").html(data);
                    }
                });
            }
        });
    });
</script>