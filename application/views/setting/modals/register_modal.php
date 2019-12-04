<!-- Modal -->
<div id="register-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title">ลงทะเบียนเข้าใช้งานโปรแกรม</h3>
            </div>
            <div class="modal-body">
                <form method="post" id="register-form">
                    <div class="row" style="margin-top:20px;">
                        <div class="form-group col-md-11">
                            <div class="col-md-4">
                                <label class="control-label">คำนำหน้า</label><span class="star">&#42;</span>
                                <select name="inHrThaiSymbol" id="inHrThaiSymbol" class="form-control" required>
                                    <option value="">---เลือกข้อมูล---</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">ชื่อ (ภาษาไทย)</label><span class="star">&#42;</span>
                                <input type="text" name="inHrThaiName" id="inHrThaiName" class="form-control" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">นามสกุล (ภาษาไทย)</label><span class="star">&#42;</span>
                                <input type="text" name="inHrThaiLastname" id="inHrThaiLastname" class="form-control" required />
                            </div>

                        </div>
                        <div class="form-group col-md-11">
                            <div class="col-md-4 form-group">
                                <label class="control-label">เลขที่บัตรประชาชน</label>
                                <input type="text" name="inHrIdCard" id="inHrIdCard" class="form-control" maxlength="13" type="number" onkeypress='validate(event)'/>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">สังกัด</label><span class="star">&#42;</span>
                                <select name="inDepartment" id="inDepartment" class="form-control" required>
                                    <option value="กองการศึกษา">กอง/สำนักการศึกษา</option>

                                    <?php
                                    $scR = $this->My_model->get_all('tb_school');
                                    foreach ($scR as $r) {
                                        ?>


                                        <option value="<?php echo $r['sc_thai_name']; ?>"><?php echo $r['sc_thai_name']; ?></option>

                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id" />
                </form>
            </div>
            <div class="modal-footer" style="background-color:#CEE3F6;">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="icon-power-off"></i></button>
            </div>
        </div>
    </div>
</div>
<script>
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault)
                theEvent.preventDefault();
        }
    }

    $("#register-form").on("submit", function (e) {
    e.preventDefault();
            $.ajax({
            url: "<?php echo site_url('RegisterMember/register'); ?>",
                    method: "POST",
                    data: $("#register-form").serialize(),
                    success: function (data) {
                    alert('ลงทะเบียนเรียบร้อย');
                            $('#register-form')[0].reset();
//                            location.reload();
                    }

            });
    });
</script>
