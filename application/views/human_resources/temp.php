<section style="background:#efefe9;">
            <div class="row">
                <div class="board">
                    <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                    <div class="board-inner">
                        <ul class="nav nav-tabs" id="myTab">
                            <div class="liner"></div>
                            <li class="active">
                                <a href="#home" data-toggle="tab" title="welcome">
                                    <span class="round-tabs one">
                                        <span class="fa-stack fa-3x">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <strong class="fa-stack-1x text-primary">1</strong>
                                        </span>
                                    </span> 
                                </a></li>

                            <li><a href="#profile" data-toggle="tab" title="profile">
                                    <span class="round-tabs two">
                                        <span class="fa-stack fa-3x">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <strong class="fa-stack-1x text-primary">2</strong>
                                        </span>
                                    </span> 
                                </a>
                            </li>
                            <li><a href="#messages" data-toggle="tab" title="bootsnipp goodies">
                                    <span class="round-tabs three">
                                        <span class="fa-stack fa-3x">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <strong class="fa-stack-1x text-primary">3</strong>
                                        </span>
                                    </span> </a>
                            </li>

                            <li><a href="#settings" data-toggle="tab" title="blah blah">
                                    <span class="round-tabs four">
                                        <span class="fa-stack fa-3x">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <strong class="fa-stack-1x text-primary">4</strong>
                                        </span>
                                    </span> 
                                </a></li>

                            <li><a href="#doner" data-toggle="tab" title="completed">
                                    <span class="round-tabs five">
                                        <span class="fa-stack fa-3x">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <strong class="fa-stack-1x text-primary">5</strong>
                                        </span>
                                    </span>
                                </a>
                            </li>

                        </ul></div>

                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="home">
                            <div class="container-fluid">
                                <legend>ข้อมูลทั่วไป</legend>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="control-label">คำนำหน้าชื่อ</label><span class="star">&#9679;</span>
                                        <select name="inHrSymbol" id="inHrSymbol" class="form-control">
                                            <option value="">---เลือกข้อมูล---</option>
                                            <option value="นาย">นาย</option>
                                            <option value="นาง">นาง</option>
                                            <option value="นางสาว">นางสาว</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">ชื่อ</label><span class="star">&#9679;</span>
                                        <input type="text" name="inHrName" id="inHrName" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">นามสกุล</label><span class="star">&#9679;</span>
                                        <input type="text" name="inHrLastname" id="inHrLastname" class="form-control"  />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">ชื่อ (ภาษาอังกฤษ)</label>
                                        <input type="text" name="inHr_eName" id="inHr_eName" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">นามสกุล (ภาษาอังกฤษ)</label>
                                        <input type="text" name="inHr_eLastname" id="inHr_eLastname" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">บัตรประชาชนเลขที่</label><span class="star">&#9679;</span>
                                        <input type="text" name="inHrIdCard" id="inHrIdCard" class="form-control"  />
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="form-group col-md-3">
                                        <label class="control-label">วัน/เดือน/ปี เกิด</label>
                                        <div class="form-group">
                                            <select name="inHrDayBirthday" id="inHrMonthBirthday" class="my-select">
                                                <option value="">Day</option>
                                            </select>
                                            <select name="inHrDayBirthday" id="inHrMonthBirthday" class="my-select">
                                                <option value="">Month</option>
                                            </select>
                                            <select name="inHrDayBirthday" id="inHrMonthBirthday" class="my-select">
                                                <option value="">Year</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">กลุ่มเลือด</label>
                                        <select name="inHrBloodGroup" id="inHrBloodGroup" class="form-control">
                                            <option value="">---เลือกข้อมูล---</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">สัญชาติ</label>
                                        <input type="text" name="inNationality" id="inNationality" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="control-label">เชื้อชาติ</label>
                                        <input type="text" name="inHrOrigin" id="inHrOrigin" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">ศาสนา</label>
                                        <input type="text" name="inHrReligion" id="inHrReligion" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">สถานะภาพ</label>
                                        <div class="display-block">
                                            <input class="magic-radio" type="radio" name="inHrStatus" id="hr1" value="โสด"><label for="hr1">โสด</label>
                                            <input class="magic-radio" type="radio" name="inHrStatus" id="hr2" value="แต่งงาน"><label for="hr2">แต่งงาน</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="state" style="display:none;">
                                        <div class="form-group col-md-2">
                                            <label class="control-label">ชื่อคู่สมรส</label>
                                            <input type="text" name="inHrConsortName" id="inConsortName" class="form-control" />
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">นามสกุลคู่สมรส</label>
                                            <input type="text" name="inHrConsortLastname" id="inHrConsortLastname" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row"><center><button type="submit" class="btn btn-primary"><i class="icon-save icon-alrge"></i> บันทึก</button></center></div>

                            </div>
                        </div>


                        <div class="tab-pane fade" id="profile">
                            <div class="container-fluid">
                                <legend>ข้อมูลที่อยู่</legend>
                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <label class="control-label">ที่อยู่เลขที่</label>
                                        <input type="text" name="inHrAddressNo" id="inHrAddressNo" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="control-label">หมู่ที่</label>
                                        <input type="text" name="inHrAddressNo" id="inHrAddressNo" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">ถนน</label>
                                        <input type="text" name="inHrAddressStreet" id="inHrAddressStreet" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">แขวง/ตำบล</label>
                                        <input type="text" name="inHrAddressStreet" id="inHrAddressStreet" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">เขต/อำเภอ</label>
                                        <input type="text" name="inHrAddressStreet" id="inHrAddressStreet" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">จังหวัด</label>
                                        <input type="text" name="inHrAddressStreet" id="inHrAddressStreet" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">รหัสไปรษณีย์</label>
                                        <input type="text" name="inHrAddressStreet" id="inHrAddressStreet" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label">โทรศัพท์</label>
                                        <input type="text" name="inHrAddressTelephone" id="inHrAddressTelephone" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">โทรสาร (FAX)</label>
                                        <input type="text" name="inHrAddressFax" id="inHrAddressFax" class="form-control" />
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="tab-pane fade" id="messages">
                            <div class="container-fluid">
                                <legend>ที่อยู่ที่ติดต่อได้สะดวก</legend>
                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <label class="control-label">ที่อยู่เลขที่</label>
                                        <input type="text" name="inHrAddressNo" id="inHrAddressNo" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="control-label">หมู่ที่</label>
                                        <input type="text" name="inHrAddressNo" id="inHrAddressNo" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">ถนน</label>
                                        <input type="text" name="inHrAddressStreet" id="inHrAddressStreet" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">แขวง/ตำบล</label>
                                        <input type="text" name="inHrAddressStreet" id="inHrAddressStreet" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">เขต/อำเภอ</label>
                                        <input type="text" name="inHrAddressStreet" id="inHrAddressStreet" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">จังหวัด</label>
                                        <input type="text" name="inHrAddressStreet" id="inHrAddressStreet" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">รหัสไปรษณีย์</label>
                                        <input type="text" name="inHrAddressStreet" id="inHrAddressStreet" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label">โทรศัพท์</label>
                                        <input type="text" name="inHrAddressTelephone" id="inHrAddressTelephone" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">โทรสาร (FAX)</label>
                                        <input type="text" name="inHrAddressFax" id="inHrAddressFax" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="settings">
                            <h3 class="head text-center">Drop comments!</h3>
                            <p class="narrow text-center">
                                Lorem ipsum dolor sit amet, his ea mollis fabellas principes. Quo mazim facilis tincidunt ut, utinam saperet facilisi an vim.
                            </p>

                            <p class="text-center">
                                <a href="" class="btn btn-success btn-outline-rounded green"> start using bootsnipp <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></a>
                            </p>
                        </div>
                        <div class="tab-pane fade" id="doner">
                            <div class="text-center">
                                <i class="img-intro icon-checkmark-circle"></i>
                            </div>
                            <h3 class="head text-center">thanks for staying tuned! <span style="color:#f48260;">♥</span> Bootstrap</h3>
                            <p class="narrow text-center">
                                Lorem ipsum dolor sit amet, his ea mollis fabellas principes. Quo mazim facilis tincidunt ut, utinam saperet facilisi an vim.
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </section>  