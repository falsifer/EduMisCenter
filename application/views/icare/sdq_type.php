<div class="box">
    <div class="box-heading">แบบประเมิน SDQ</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <!--<li><?php echo anchor(site_url('icare'), " ระบบดูแลช่วยเหลือนักเรียน/เยี่ยมบ้านนักเรียน"); ?></li>-->
        <li>แบบประเมิน SDQ</li>
    </ul>
    <div style="padding: 30px;">
        <div class="row"> 
            <div class="col-md-2 tab-menu"><?php echo anchor(site_url('sdq-base'), "<i class=\"icon-edit\"></i> การประเมิน SDQ"); ?></div>
            <div class="col-md-2 tab-menu-active"><i class="icon-list-alt"></i> พฤติกรรมแต่ละด้าน</div>
            <div class="col-md-2 tab-menu"><?php echo anchor(site_url('sdq-topic'), "<i class=\"icon-list\"></i> หัวข้อพฤติกรรม"); ?></div>
            <div class="col-md-2 tab-menu"><?php echo anchor(site_url('sdq-temp-print'), "<i class='icon-print'></i> พิมพ์แบบเปล่า"); ?></div>
        </div>
        <div class="row" style="background: #f7f7f7;padding:50px;">
            <div class="panel">
                <div class="modal-header" style="background:#ebebeb;">
                    <h4 class="modal-title">พฤติกรรมประเมินในแต่ละด้าน</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="border-bottom: solid 5px #efefef;margin-bottom: 10px;">
                        <div class="col-md-10 col-md-offset-1">
                            <form method="post" id="sdq-insert-form">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="control-label">ด้าน</label><span class="star">&#42;</span>
                                        <input type="text" name="inSdqType" id="inSdqType" class="form-control" required autofocus  />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="control-label">การให้คะแนน</label>
                                        <div class="col-md-12" style="text-align: center">
                                            <div class="row">
                                                <div class=" col-md-12">
                                                    <div class="col-md-6 control-label" style="background: #ddd;padding: 5px;border:solid 1px #efefef;text-align: center">นักเรียนประเมินตนเอง<span class="star">&#42;</span></div>
                                                    <div class="col-md-6 control-label" style="background: #ddd;padding: 5px;border:solid 1px #efefef;text-align: center">ครู/ผู้ปกครองประเมิน<span class="star">&#42;</span></div>
                                                </div>
                                                <div class=" col-md-12">
                                                    <div class="col-md-2 control-label" style="padding: 5px;border:solid 1px #efefef;text-align: center">ปกติ</div>
                                                    <div class="col-md-2 control-label" style="padding: 5px;border:solid 1px #efefef;text-align: center">เสี่ยง</div>
                                                    <div class="col-md-2 control-label" style="padding: 5px;border:solid 1px #efefef;text-align: center">มีปัญหา</div>
                                                    <div class="col-md-2 control-label" style="padding: 5px;border:solid 1px #efefef;text-align: center">ปกติ</div>
                                                    <div class="col-md-2 control-label" style="padding: 5px;border:solid 1px #efefef;text-align: center">เสี่ยง</div>
                                                    <div class="col-md-2 control-label" style="padding: 5px;border:solid 1px #efefef;text-align: center">มีปัญหา</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-2" style="padding: 5px;border:solid 1px #efefef;text-align: center"><input type="text" name="inSdqTypeSarNormal" id="inSdqTypeSarNormal" class="form-control" required /></div>
                                                    <div class="col-md-2" style="padding: 5px;border:solid 1px #efefef;text-align: center"><input type="text" name="inSdqTypeSarRisk" id="inSdqTypeSarRisk" class="form-control" required /></div>
                                                    <div class="col-md-2" style="padding: 5px;border:solid 1px #efefef;text-align: center"><input type="text" name="inSdqTypeSarProblem" id="inSdqTypeSarProblem" class="form-control" required /></div>
                                                    <div class="col-md-2" style="padding: 5px;border:solid 1px #efefef;text-align: center"><input type="text" name="inSdqTypeNormal" id="inSdqTypeNormal" class="form-control" required /></div>
                                                    <div class="col-md-2" style="padding: 5px;border:solid 1px #efefef;text-align: center"><input type="text" name="inSdqTypeRisk" id="inSdqTypeRisk" class="form-control" required /></div>
                                                    <div class="col-md-2" style="padding: 5px;border:solid 1px #efefef;text-align: center"><input type="text" name="inSdqTypeProblem" id="inSdqTypeProblem" class="form-control" required /></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button>
                                        <button type="button" class="btn btn-warning"><i class=" icon-large"></i> ล้างข้อมูล</button>
                                    </center>
                                </div>
                                <div class="row"><div class="col-md-12">เครื่องหมาย <span class="star">&#42;</span> จำเป็นต้องกรอก</div></div>
                                <input type="hidden" name="id" id="id" />
                            </form>
                        </div>
                    </div>
                    <div class="row" style='width:100%;margin: auto;'>
                        <table class="table table-hover table-striped table-bordered display" id="sdqTypeTab">
                            <thead>
                                <tr>
                                    <th style="width:40px;text-align: center;" rowspan="2">ที่</th>
                                    <th class="no-sort" style="text-align: center;" rowspan="2">รายการประเมิน</th>
                                    <th class="no-sort" style="text-align: center;" colspan="3">ประเมินตนเอง</th>
                                    <th class="no-sort" style="text-align: center;" colspan="3">ครู/ผู้ปกครอง</th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                        <th style="width:13%;"  rowspan="2" class="no-sort"></th>
                                    <?php endif; ?>
                                </tr>
                                <tr class="no-sort">

                                    <th style="text-align: center;">ปกติ</th>
                                    <th style="text-align: center;">เสี่ยง</th>
                                    <th style="text-align: center;">มีปัญหา</th>
                                    <th style="text-align: center;">ปกติ</th>
                                    <th style="text-align: center;">เสี่ยง</th>
                                    <th style="text-align: center;">มีปัญหา</th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                        <th style="display:none;"></th>
                                    <?php endif; ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (sizeof($sdq_type) > 0):
                                    $row = 1;
                                    foreach ($sdq_type as $r):
                                        ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $row; ?></td>
                                            <td style="text-align: left;"><?php echo $r['tb_sdq_type']; ?></td>
                                            <td style="text-align: center;"><?php echo $r['tb_sdq_sar_normal']; ?></td>
                                            <td style="text-align: center;"><?php echo $r['tb_sdq_sar_risk']; ?></td>
                                            <td style="text-align: center;"><?php echo $r['tb_sdq_sar_problem']; ?></td>
                                            <td style="text-align: center;"><?php echo $r['tb_sdq_normal']; ?></td>
                                            <td style="text-align: center;"><?php echo $r['tb_sdq_risk']; ?></td>
                                            <td style="text-align: center;"><?php echo $r['tb_sdq_problem']; ?></td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-pencil icon-large"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-danger btn-delete" id="<?php echo $r['id']; ?>"><i class="icon-trash icon-large"></i> ลบ</button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php
                                        $row++;

                                    endforeach;
                                else :
                                    ?>
                                    <tr><td colspan="8" style="text-align: center;color: #ddd;">ไม่พบข้อมูล</td>
                                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                            <td>&nbsp;</td>
                                        <?php endif; ?>
                                    </tr>
                                <?php
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    &nbsp;
                </div>
            </div><!-- /.modal-content -->
        </div>


    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
<div class="col-md-12">

</div>
<script>

    $("#sdq-insert-form").on("submit", function (e) {
        e.preventDefault();
        //

        $.ajax({
            url: "<?php echo site_url('Icare/sdq_type_insert'); ?>",
            method: "post",
            data: $("#sdq-insert-form").serialize(),

            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#sdq-insert-form")[0].reset();
                location.reload();
            }
        });
    });


    // edit data
    $("#sdqTypeTab").on("click", ".btn-edit", function () {
        var uid = $(this).attr("id");

        $.ajax({
            url: "<?php echo site_url('Icare/sdq_type_edit'); ?>",
            method: "post",
            data: {id: uid},
            dataType: "json",
            success: function (data) {
                $('#inSdqType').val(data.tb_sdq_type);
                $('#inSdqTypeSarNormal').val(data.tb_sdq_sar_normal);
                $('#inSdqTypeSarRisk').val(data.tb_sdq_sar_risk);
                $('#inSdqTypeSarProblem').val(data.tb_sdq_sar_problem);
                $('#inSdqTypeNormal').val(data.tb_sdq_normal);
                $('#inSdqTypeRisk').val(data.tb_sdq_risk);
                $('#inSdqTypeProblem').val(data.tb_sdq_problem);
                $('#id').val(data.id);
            }
        });
    });

    // delete data
    $("#sdqTypeTab").on("click", ".btn-delete", function () {
        var uid = $(this).attr("id");
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: "<?php echo site_url('Icare/sdq_type_delete'); ?>",
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });



</script>

