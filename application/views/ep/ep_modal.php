<!-- Modal -->
<div id="ep-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="modal-form" enctype="multipart/form-data">
                        <div class="row">
                            <b>การจัดตัวชี้วัดลงหน่วยการเรียนรู้</b>
                            <br></br>
                        </div>
                        <table class="table table-hover table-striped table-bordered display" id="example">
                            <thead>
                                <tr>
                                    <th style="width:40px;">ที่</th>
                                    <th class="sorting">มาตรฐาน/ตัวชี้วัด</th>
                                    <th class="sorting">คะแนนเต็ม</th>
                                    <th class="sorting">จัดหน่วย</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php foreach ($rsj as $r): ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $row; ?></td>
                                        <td style="text-align: center;"><?php echo $r['tb_standard_learning_code']; ?> <?php echo $r['tb_kpi_standard_learning_level']; ?>/<?php echo thaidigit($r['tb_kpi_standard_learning_seq']); ?></td>
                                        <td style="text-align: center;">
                                            <input type="text" size="1" name="inScore<?php echo $row; ?>" id="inScore<?php echo $row; ?>" value="<?php echo $r['tb_kpi_score']; ?>" class="form-control" />
                                        </td>
                                        <td style="text-align:center;">
                                            <select name="inUnit<?php echo $row; ?>" id="inUnit<?php echo $row; ?>" class="form-control"   >
                                                <option value="">---Select---</option>
                                                <?php foreach ($rsunit as $ru): ?>
                                                    <option value="<?php echo $ru['id']; ?>">หน่วยที่ <?php echo $ru['tb_unit_learning_content']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                <input type="hidden" name="inStandId[]" id="inStandId[]" value="<?php echo $r['bid']; ?>">
                                <input type="hidden" name="inId[]" id="inId[]" value="<?php echo $r['cid']; ?>">
                                </tr>
                                <?php $row++; ?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>


                        <div class="row">
                            <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึกข้อมูล</button></center>
                        </div>
                        <input type="hidden" name="bid" id="bid" />
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

    $("#modal-form").on("submit", function (e) {
        e.preventDefault();
        //

        $.ajax({
            url: "<?php echo site_url('Ep/ep_modal_save'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#insert-form")[0].reset();
               // location.reload();
            }
        });
    });

</script>