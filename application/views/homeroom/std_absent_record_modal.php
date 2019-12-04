<!-- Modal -->
<div id="std-absent-record-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">บันทึกเวลามาเรียน
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="insert-form" enctype="multipart/form-data">
                        <div class="col-md-12" id="RecordBody"> 

                            <?php foreach ($rs as $r): ?>
                                <div class="panel col-md-3" >
                                    <center>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 id="inStdName"><?php echo $r['std_titlename'] . ' ' . $r['std_firstname'] . ' ' . $r['std_lastname']; ?></h4>
                                                <h5>เลขประจำตัว <?php echo $r['std_code']; ?></h5>
                                            </div>

                                            <div class="col-md-12">
                                                <?php if (file_exists("upload/" . $r['pic_name']) && !empty($r['pic_name'])): ?>
                                                    <?php echo anchor(base_url() . "upload/" . $r['pic_name'], img(array("src" => "upload/" . $r['pic_name'], 'class' => 'img-thumbnail', "style" => "width:117px;")), array("target" => "_blank", "rel" => "lytebox")); ?>
                                                <?php else: ?>
                                                    <?php echo img(array("src" => base_url('images/no-image.jpg'), "style" => "width:117px;")); ?>
                                                <?php endif; ?>
                                            </div>

                                            <?php if ($r['tb_student_absent_record_status'] == "C" | $r['tb_student_absent_record_status'] == ""): ?>
                                                <div class="col-md-12" style="margin: 5px 0px;">
                                                    <input type="checkbox" name="c<?php echo $r['id']; ?>" value="C" id="c<?php echo $r['id']; ?>" onchange="clearcheck(this)" checked=""/>&nbsp;มา
                                                    <input type="checkbox" name="a<?php echo $r['id']; ?>" value="A" id="a<?php echo $r['id']; ?>" onchange="clearcheck(this)"/>&nbsp;ขาด
                                                    <input type="checkbox" name="s<?php echo $r['id']; ?>" value="S" id="s<?php echo $r['id']; ?>" onchange="clearcheck(this)"/>&nbsp;ลาป่วย
                                                    <input type="checkbox" name="e<?php echo $r['id']; ?>" value="E" id="e<?php echo $r['id']; ?>" onchange="clearcheck(this)"/>&nbsp;ลากิจ
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($r['tb_student_absent_record_status'] == "A"): ?>
                                                <div class="col-md-12" style="margin: 5px 0px;">
                                                    <input type="checkbox" name="c<?php echo $r['id']; ?>" value="C" id="c<?php echo $r['id']; ?>" onchange="clearcheck(this)" />&nbsp;มา
                                                    <input type="checkbox" name="a<?php echo $r['id']; ?>" value="A" id="a<?php echo $r['id']; ?>" onchange="clearcheck(this)" checked=""/>&nbsp;ขาด
                                                    <input type="checkbox" name="s<?php echo $r['id']; ?>" value="S" id="s<?php echo $r['id']; ?>" onchange="clearcheck(this)"/>&nbsp;ลาป่วย
                                                    <input type="checkbox" name="e<?php echo $r['id']; ?>" value="E" id="e<?php echo $r['id']; ?>" onchange="clearcheck(this)"/>&nbsp;ลากิจ
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($r['tb_student_absent_record_status'] == "S"): ?>
                                                <div class="col-md-12" style="margin: 5px 0px;">
                                                    <input type="checkbox" name="c<?php echo $r['id']; ?>" value="C" id="c<?php echo $r['id']; ?>" onchange="clearcheck(this)" />&nbsp;มา
                                                    <input type="checkbox" name="a<?php echo $r['id']; ?>" value="A" id="a<?php echo $r['id']; ?>" onchange="clearcheck(this)"/>&nbsp;ขาด
                                                    <input type="checkbox" name="s<?php echo $r['id']; ?>" value="S" id="s<?php echo $r['id']; ?>" onchange="clearcheck(this)" checked=""/>&nbsp;ลาป่วย
                                                    <input type="checkbox" name="e<?php echo $r['id']; ?>" value="E" id="e<?php echo $r['id']; ?>" onchange="clearcheck(this)"/>&nbsp;ลากิจ
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($r['tb_student_absent_record_status'] == "E"): ?>
                                                <div class="col-md-12" style="margin: 5px 0px;">
                                                    <input type="checkbox" name="c<?php echo $r['id']; ?>" value="C" id="c<?php echo $r['id']; ?>" onchange="clearcheck(this)" />&nbsp;มา
                                                    <input type="checkbox" name="a<?php echo $r['id']; ?>" value="A" id="a<?php echo $r['id']; ?>" onchange="clearcheck(this)"/>&nbsp;ขาด
                                                    <input type="checkbox" name="s<?php echo $r['id']; ?>" value="S" id="s<?php echo $r['id']; ?>" onchange="clearcheck(this)"/>&nbsp;ลาป่วย
                                                    <input type="checkbox" name="e<?php echo $r['id']; ?>" value="E" id="e<?php echo $r['id']; ?>" onchange="clearcheck(this)" checked=""/>&nbsp;ลากิจ
                                                </div>
                                            <?php endif; ?>

                                            <div class="col-md-12" style="margin: 5px 0px;">
                                                หมายเหตุ&nbsp;<textarea class="form-control" name="note<?php echo $r['id']; ?>" id="note<?php echo $r['id']; ?>" ></textarea>
                                            </div>

                                        </div>
                                    </center>
                                </div>
                                <input type="hidden" name="inBid<?php echo $r['id']; ?>" id="inBid<?php echo $r['id']; ?>" value="<?php echo $r['bid']; ?>">
                                <input type="hidden" name="inId[]" id="inId[]" value="<?php echo $r['id']; ?>">

                            <?php endforeach; ?>

                        </div>
                        <div class="row">
                            <input type="hidden" name="daynow" id="daynow" value="" />
                            <input type="hidden" name="stdclass" id="stdclass" value="" />
                            <input type="hidden" name="stdlevel" id="stdlevel" value="" />                           
                        </div>
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

    function clearcheck(checkboxElem) {
        var str = checkboxElem.id;
        var sta = str.substring(0, 1);
        var res = str.substring(1, 12);

        var status = "C";
        var recordid = $('#inBid' + res).val();
        var note = $('#note' + res).val();

        switch (sta) {
            case "c":
                $('#a' + res).prop('checked', false);
                $('#s' + res).prop('checked', false);
                $('#e' + res).prop('checked', false);
                status = "C";
                break;
            case "a":
                $('#c' + res).prop('checked', false);
                $('#s' + res).prop('checked', false);
                $('#e' + res).prop('checked', false);
                status = "A";
                break;
            case "s":
                $('#a' + res).prop('checked', false);
                $('#c' + res).prop('checked', false);
                $('#e' + res).prop('checked', false);
                status = "S";
                break;
            case "e":
                $('#a' + res).prop('checked', false);
                $('#s' + res).prop('checked', false);
                $('#c' + res).prop('checked', false);
                status = "E";
                break;
        }

        var stdclass = $('#stdclass').val();
        var stdlevel = $('#stdlevel').val();
        var daynow = $('#daynow').val();

        $.ajax({

            url: "<?php echo site_url('Homeroom/std_absent_record_update'); ?>",
            method: "post",
            data: {status: status, note: note, bid: recordid},
            success: function (data) {
                //alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                $.ajax({
                    url: "<?php echo site_url('Homeroom/std_absent_record_edit'); ?>",
                    method: "post",
                    data: {daynow: daynow, cid: cid, rid: rid},
                    success: function (data) {
                        $('#RecordBody').html(data);
//                            $('#stdclass').val(stdclass);
//                            $('#stdlevel').val(stdlevel);
                        $('#daynow').val(daynow);
                        $('#std-absent-record-modal').modal('show');
                    }
                });

            }
        });

    }

//insert
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "<?php echo site_url('Homeroom/std_absent_record_update'); ?>",
            method: "post",
            data: $("#insert-form").serialize(), //new FormData(this),
//            cache: false,
//            contentType: false,
//            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
                location.reload();
            }
        });
    });

</script>