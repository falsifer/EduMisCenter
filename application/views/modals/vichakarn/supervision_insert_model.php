<div id="insert-modal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document" style="width:1250px;">
        <div class="modal-content">
            <div class="modal-header" style="background:#ebebeb;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">บันทึกการนิเทศการศึกษา</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form method="post" id="insert-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">งาน</label><span class="star">&#42;</span>
                                    <select name="inDivision" id="inDivision" class="form-control" required>
                                        <option value="">---เลือกข้อมูล---</option>
                                        <?php foreach ($division as $rs): ?>
                                            <option value="<?php echo $rs['id']; ?>"><?php echo $rs['tb_division_name']; ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="control-label">หัวข้อการนิเทศ</label>
                                    <input type="text" name="inSupervisionIssueDetail" id="inSupervisionIssueDetail" class="form-control" required autofocus />
                                </div>
                            </div>
   
                            <div class="row">
                                <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                            </div>
                            <div class="row"><div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div></div>
                            <input type="hidden" name="id" id="id" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<script>

//    $('#inDivision').change(function(){
//        var inDivision = $('#inDivision').val();
//        if(inDivision!=='')
//        {
//            var post_url = "index.php/supervision/get_issue/"+inDivision;
//            $.ajax({
//                url:post_url,
//                method:"post",
//                success: function(data) //we're calling the response json array 'cities'
//            {
//                $('#inSupervisionIssueDetail').empty();
//                $('#inSupervisionIssueDetail').show();
//                $.each(data,function(id,tb_supervision_issue_detail)
//                {
//                    var opt = $('<option />'); // here we're creating a new select option for each group
//                    opt.val(id);
//                    opt.text(tb_supervision_issue_detail);
//                    $('#inSupervisionIssueDetail').append(opt);
//                });
//            } //end success
//            });
//        }
//    });

    $("#insert-form").on("submit", function (e) {
        e.preventDefault();

        //
        $.ajax({
            url: "<?php echo site_url('Supervision/supervision_issue_add'); ?>",
            method: "post",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.href = "<?php echo site_url('supervision'); ?>";
                //location.href = "<?php echo site_url(); ?>";
            }

        });
    });





</script>
