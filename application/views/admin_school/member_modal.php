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
                            <div class="col-md-7 form-group">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Username</label>
                                        <input type="text" name="inUsername" id="inUsername" class="form-control" required />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Password</label>
                                        <input type="text" name="inPassword" id="inPassword" class="form-control" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="control-label">บุคคลากร</label>
                                        <select name="inHr" id="inHr" class="form-control">
                                            <option value="">---เลือกข้อมูล---</option>
                                            <?php foreach ($hr as $r): ?>
                                                <option value="<?php echo $r['id']; ?>"><?php echo $r['hr_thai_symbol']; ?><?php echo $r['hr_thai_name']; ?> <?php echo $r['hr_thai_lastname']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 form-group">
                                <label class="control-label">ภาพลายเซ็น</label>
                                <br/>
                                <img id="blah" src="#" class="img-thumbnail"  style='width:350px;height:200px;'>
                                <br/>
                                <input type="file" name="inSignature" id="inSignature" class="filestyle" onchange="ShowImg(this)"/>
                                <script>
                                    function ShowImg(e) {
                                        if (e.files && e.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function (e) {
                                                $('#blah')
                                                        .attr('src', e.target.result)
                                                        .width(350)
                                                        .height(200);
                                            };
                                            reader.readAsDataURL(e.files[0]);
                                        }
                                    }
                                </script>
                            </div>

                            <!--                            <div class="col-md-3 form-group">
                                                            <label class="control-label">Status</label>
                                                            <select name="inStatus" id="inStatus" class="form-control" required>
                                                                <option value="">---เลือกข้อมูล---</option>
                                                                <option value="ผู้ปฏิบัติงาน">ผู้ปฏิบัติงาน</option>
                                                                <option value="ผู้ใช้งานทั่วไป">ผู้ใช้งานทั่วไป</option>
                                                                <option value="ผู้บริหาร">ผู้บริหาร</option>
                                                                <option value="ผู้ดูแลระบบ">ผู้ดูแลระบบ</option>
                                                            </select>
                                                        </div>-->
                        </div>
                        <div class="row">
                            <input type="hidden" name="inStatus" id="inStatus"  value="ผู้ปฏิบัติงาน" class="form-control" required />
                            <input type="hidden" name="inDepartment" id="inDepartment" class="form-control" value="<?php echo $this->session->userdata('department') ?>"  readonly/>
                            <input type="hidden" name="inActivate" id="inActivate"  value="1" class="form-control" required />
                            <!--                            <div class="col-md-3 form-group">
                                                            <label class="control-label">Activate</label>
                                                            <div class="form-group">
                                                                <select name="inActivate" id="inActivate" class="form-control" required="" readonly>
                                                                    <option value="">---เลือกข้อมูล---</option>
                                                                    <option value="1">Activate</option>
                                                                    <option value="0">Non-Activate</option>
                                                                </select>
                                                            </div>
                                                        </div>-->
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
    $("#insert-form").on("submit", function (e) {
        e.preventDefault();
        //
        $.ajax({
            url: "<?php echo site_url('Admin_school/member_insert'); ?>",
//            method: "post",
//            data: $("#insert-form").serialize(),
            method: "post",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data) {
                    $("#insert-form")[0].reset();
                    location.reload();
                    alert("บันทึกข้อมูลเรียบร้อย");
                } else {
                    document.getElementById("inUsername").style.backgroundColor = "red";
                    alert("USER ซ้ำ !");
                }
            }
        });
    });
</script>