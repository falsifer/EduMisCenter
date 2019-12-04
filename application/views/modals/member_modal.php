<!-- Modal -->
<div id="member-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h2>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="post" id="insert-form">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label">ชื่อ</label>
                                <input type="text" name="inMemberName" id="inMemberName" class="form-control" required />
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">นามสกุล</label>
                                <input type="text" name="inMemberLastname" id="inMemberLastname" class="form-control" required />
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">โทรศัพท์มือถือ</label>
                                <input type="text" name="inMemberMobile" id="inMemberMobile" class="form-control"  />
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Email</label>
                                <input type="text" name="inMemberEmail" id="inMemberEmail" class="form-control"  />
                            </div>
                        </div>
                        <div class="row">
                            <!--
                            <div class="form-group col-md-4">
                                <label class="control-label">กลุ่ม/ส่วน/ฝ่าย</label>
                                <select name="inDivision" id="inDivision" class="form-control">
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="วิชาการ">วิชาการ</option>
                                    <option value="บริหารงานทั่วไป">บริหารงานทั่วไป</option>
                                    <option value="บุคลากร">บุคลากร</option>
                                    <option value="งบประมาณ">งบประมาณ</option>
                                </select>
                            </div>
                            -->
                            <div class="form-group col-md-3">
                                <label class="control-label">สังกัดหน่วยงาน</label>
                                <select name="inDepartment" id="inDepartment" class="form-control">
                                    <option value="">---เลือกหน่วยงาน---</option>
                                    <?php foreach ($inside_office as $office): ?>
                                        <option value="<?php echo $office['inside_office']; ?>"><?php echo $office['inside_office']; ?></option>
                                    <?php endforeach; ?>
                                    <?php foreach ($school as $sc): ?>
                                        <option value="<?php echo $sc['sc_thai_name']; ?>"><?php echo $sc['sc_thai_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!--
                            <div class="form-group col-md-4">
                                <label class="control-label">หน้าที่รับผิดชอบ</label>
                                <select name="inResponsible" id="inResponsible" class="form-control">
                                    <option value="">---เลือกข้อมูล---</option>
                                    <?php foreach ($res as $rs): ?>
                                        <option value="<?php echo $rs['responsible']; ?>"><?php echo $rs['responsible']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            -->
                            <div class="col-md-3 form-group">
                                <label class="control-label">Username</label>
                                <input type="text" name="inUsername" id="inUsername" class="form-control" required />
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Password</label>
                                <input type="text" name="inPassword" id="inPassword" class="form-control" required />
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Status</label>
                                <select name="inStatus" id="inStatus" class="form-control" required>
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="ผู้ปฏิบัติงาน">ผู้ปฏิบัติงาน</option>
                                    <option value="ผู้ใช้งานทั่วไป">ผู้ใช้งานทั่วไป</option>
                                    <option value="ผู้บริหาร">ผู้บริหาร</option>
                                    <option value="ผู้ดูแลระบบ">ผู้ดูแลระบบ</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label">Activate</label>
                                <div class="form-group">
                                    <select name="inActivate" id="inActivate" class="form-control" required="">
                                        <option value="">---เลือกข้อมูล---</option>
                                        <option value="1">Activate</option>
                                        <option value="0">Non-Activate</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <center><button type="submit" class="btn btn-success"><i class="icon-save icon-large"></i> บันทึก</button></center>
                        </div>
                        <input type="hidden" name="id" id="id" />
                    </form>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th'});
    //
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        $.ajax({
            url: "<?php echo site_url('setting/member_insert'); ?>",
            method: "post",
            data: $("#insert-form").serialize(),
            success: function (data) {
                $("#insert-form")[0].reset();
                location.reload();
                alert("บันทึกข้อมูลเรียบร้อย");
            }
        });
    });
</script>