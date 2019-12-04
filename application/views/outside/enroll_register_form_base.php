<div class="box">




    <!--    <div class="box-heading">ระบบร</div>
        <ul class="breadcrumb">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
            <li>ผลงานดีเด่น/ความเป็นเลิศ</li>
        </ul>
    -->       
    <div class="box-body">
        <div class='row' style='margin-top:10px;'>
            <div class='col-md-12'>
                <form method="post" id="vh-insert-form" enctype="multipart/form-data">
                    <legend>1. ข้อมูลส่วนตัว</legend>
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label class="control-label">คำนำหน้าชื่อ</label>
                            <select name="inMTitlename" id="inMTitlename" class="form-control"   >
                                <option value="">---เลือกข้อมุล---</option>
                                <option value="เด็กชาย">เด็กชาย</option>
                                <option value="เด็กหญิง">เด็กหญิง</option>
                                <option value="นางสาว">นางสาว</option>
                                <option value="นาง">นาง</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">ชื่อจริง</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">นามสกุล</label>
                            <input type="text" name="inAddTambol" id="inAddTambol" class="form-control"  />
                        </div>
                        <div class="col-md-2 form-group">
                            <label class="control-label">ชื่อเล่น</label>
                            <input type="text" name="inAddTambol" id="inAddTambol" class="form-control"  />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">รหัสบัตรประชาชน</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                        <div class="col-md-2 form-group">
                            <label class="control-label">สัญชาติ</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                        <div class="col-md-2 form-group">
                            <label class="control-label">เชื้อชาติ</label>
                            <input type="text" name="inAddTambol" id="inAddTambol" class="form-control"  />
                        </div>
                        <div class="col-md-2 form-group">
                            <label class="control-label">ศาสนา</label>
                            <input type="text" name="inAddTambol" id="inAddTambol" class="form-control"  />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">วันเดือนปีเกิด</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                        <div class="col-md-2 form-group">
                            <label class="control-label">หมู่เลือด</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">เบอร์โทรศัพท์(ผู้สมัคร)</label>
                            <input type="text" name="inAddTambol" id="inAddTambol" class="form-control"  />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label class="control-label">สถานะผู้สมัคร</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                        <div class="col-md-5 form-group">
                            <label class="control-label">สถานศึกษาก่อนเข้าสมัคร</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                        <div class="col-md-5 form-group">
                            <label class="control-label">ที่อยู่สถานศึกษา</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                    </div>


                    <legend>2. ข้อมูลที่อยู่</legend>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">เลขที่</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">หมู่</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ซอย</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ถนน</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">ตำบล</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>

                        <div class="col-md-3 form-group">
                            <label class="control-label">อำเภอ</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>

                        <div class="col-md-3 form-group">
                            <label class="control-label">จังหวัด</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>

                        <div class="col-md-3 form-group">
                            <label class="control-label">รหัสไปรษณีย์</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                    </div>

                    <legend>3. ข้อมูลครอบครัว</legend>
                    <!--<div style='background: skyblue;padding: 5px;'>-->
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label class="control-label">คำนำหน้า</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">ชื่อ</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">นามสกุล</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label class="control-label">สัญชาติ</label>
                            <input type="text" name="inAddMoo" id="inAddMoo" class="form-control"  />
                        </div>
                        <div class="col-md-2 form-group">
                            <label class="control-label">เชื้อชาติ</label>
                            <input type="text" name="inAddTambol" id="inAddTambol" class="form-control"  />
                        </div>
                        <div class="col-md-2 form-group">
                            <label class="control-label">ศาสนา</label>
                            <input type="text" name="inAddTambol" id="inAddTambol" class="form-control"  />
                        </div>
                    </div>
                    <!--</div>-->

                </form>
            </div>    
        </div>
    </div>
</div>

