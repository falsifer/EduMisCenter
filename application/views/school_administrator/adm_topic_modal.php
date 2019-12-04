<!-- Modal -->
<div id="adm-topic-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <div class="container-fluid">
                        <form method="post" id="topic-form" enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" name="Stdid" id="Stdid" />
                            </div>

                            <div class="row">
                                <div class="row">
                                    <b>เพิ่ม/แก้ไข หัวข้อ</b>
                                    <br></br>
                                </div>
<!--                                <div class="col-md-3 form-group">
                                    <label class="control-label">เกณการคัดกรอง</label>
                                    <select name="inAdmIcare" id="inAdmIcare" class="form-control"  autofocus >
                                        <option value="">---เลือกข้อมูล---</option>
                                        <?php foreach ($icaretopic as $r): ?>
                                            <option value="<?php echo $r['id']; ?>"><?php echo $r['tb_icare_topic_content']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>-->
                                <div class="col-md-8 form-group">
                                    <label class="control-label">ชื่อหัวข้อ</label>
                                    <input type="text" name="inAdmContent" id="inAdmContent" class="form-control" autofocus  required=""/>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label class="control-label">ประเภท</label>
                                    <select name="inAdmType" id="inAdmType" class="form-control"  autofocus required="" >
                                        <option value="">---เลือกข้อมูล---</option>
                                        <option value="Plus">เพิ่มคะแนน</option>
                                        <option value="Minus">ลดคะแนน</option>
                                    </select>
                                </div>
                                <div class="col-md-2 form-group">
                                    <label class="control-label">คะแนน</label>
                                    <input type="text" name="inAdmScore" id="inAdmScore" class="form-control" autofocus  required=""/>
                                </div>              
                                <input type="hidden" name="inAdmTopicId" id="inAdmTopicId" class="form-control" autofocus  />
                            </div>
                            <div class="row">
                                <center><button type="submit" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                            </div>
                        </form>
                        <div class="row">
                            <b>หัวข้อที่มีในระบบ</b>
                            <br></br>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered display" id="example">
                                <thead>
                                    <tr>
                                        <th style="width:40px;">ที่</th>
                                        <th class="no-sort">ชื่อหัวข้อ</th>
                                        <th class="no-sort">ประเภท</th>
                                        <th class="no-sort">คะแนน</th>
                                        <th class="no-sort">ผู้บันทึก</th>
                                        <th class="no-sort">วันที่บันทึก</th>
                                        <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                            <th class="no-sort">การจัดการ</th>
                                        <?php endif; ?>                                        
                                    </tr>
                                </thead>
                                <tbody  name ="inTbody" id="inTbody">
                                    <?php $row = 1; ?>
                                    <?php foreach ($admintopic as $r): ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $row; ?></td>
                                            <td style="text-align: center;"><?php echo $r['tb_administrator_topic_content']; ?></td>

                                            <td style="text-align: center;">                                            
                                                <?php if ($r['tb_administrator_topic_type'] == "Plus"): ?>
                                                    <font color="blue">เพิ่มคะแนน</font>
                                                <?php endif; ?>
                                                <?php if ($r['tb_administrator_topic_type'] == "Minus"): ?>
                                                    <font color="red">ลดคะแนน</font>
                                                <?php endif; ?></td>
                                            <td style="text-align: center;"><?php echo $r['tb_administrator_topic_maxscore']; ?></td>
                                            <td style="text-align: center;"><?php echo $r['tb_administrator_topic_recorder']; ?></td>
                                            <td style="text-align: center;"><?php echo $r['tb_administrator_topic_createdate']; ?></td>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <td style="text-align:center;">
                                                    <button type="button" class="btn btn-warning btn-edit" id="<?php echo $r['id']; ?>"><i class="icon-gear icon-large"></i> แก้ไขข้อมูล</button>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php $row++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>

    // edit 
    $("#example").on("click", ".btn-edit", function () {

        var uid = $(this).attr('id');
        alert("test");
    });

    $("#topic-form").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "<?php echo site_url('School_administrator/adm_topic_insert'); ?>",
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                alert("บันทึกข้อมูลสำเร็จ");
                $("#topic-form")[0].reset();
                location.reload();
            }
        });
    });
</script>