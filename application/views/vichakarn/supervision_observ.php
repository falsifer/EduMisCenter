
<!------------------------------------------------------------------------------
|  Title      Supervision Observ
| ----------------------------------------------------------------------------
| Copyright	Edutech Co.,Ltd.
| Purpose     สังเกตการสอน
| Author	นายบัณฑิต ไชยดี
| Create Date 22 December 2018
| Last edit	-
| Comment	-
| --------------------------------------------------------------------------->
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">บันทึกการสังเกตการสอน</div>
        <ul class="breadcrumb">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
            <li><a href="<?php echo site_url('supervision'); ?>">แผนงานและการดำเนินงานนิเทศ</a></li>
            <li>บันทึกการสังเกตการสอน</li>

            <!-- Print data -->
            <span class="pull-right"><?php //echo anchor(current_url(),img('images/printer.png')." พิมพ์ข้อมูล"); ?></span>

        </ul>
        <div class="panel-body">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-left:15px;margin-right:15px;box-shadow: none;">
                <div class="panel panel-default" style="box-shadow:none;">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                ข้อมูลทั่วไป
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div style="border:3px double #ccc;padding:20px;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <b>ปีการศึกษา</b><?php echo nbs(3); ?><?php echo $supervision['loan_year']; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <b>ภาคเรียนที่</b><?php echo nbs(3); ?><?php echo $supervision['loan_term']; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <b>วัน เดือน ปี</b><?php echo nbs(3); ?><?php echo datethai($supervision['schedule_date']); ?>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-md-6">
                                        <b>ชื่อ-นามสกุลผู้สอน</b><?php echo nbs(3); ?><?php echo $supervision['teacher_name']; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <b>โรงเรียน</b><?php echo nbs(3); ?><?php echo $supervision['school_name']; ?>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-md-6">
                                        <b>หน่วยการเรียนรู้</b><?php echo nbs(3); ?><?php echo $supervision['learning_group']; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <b>วิชาที่สังเกตการสอน</b><?php echo nbs(3); ?><?php echo 'รหัสวิชา ' . $supervision['tb_course_code']; ?><?php echo nbs(2); ?><?php echo 'ชื่อวิชา ' . $supervision['tb_subject_name']; ?>
                                    </div>
                                </div>
                                <!-- บันทึกข้อมูล -->
                                <?php if ($observ): ?>
                                    <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                        <form method="post" id="observ-normal-form" style="margin-top:20px;">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">สังเกตการสอนครั้งที่</label>
                                                    <input type="text" name="inObservNo" id="inObservNo" value="<?php echo $observ['observ_no'] ?>" class="form-control" required autofocus/>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">เวลา</label>
                                                    <input type="text" name="inObservTime" id="inObservTime" value="<?php echo $observ['observ_time'] ?>" class="form-control" required/>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">นักเรียนชาย (คน)</label>
                                                    <input type="text" name="inObservStdMale" id="inObservStdMale" value="<?php echo $observ['observ_std_male'] ?>" class="form-control" required/>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">นักเรียนหญิง (คน)</label>
                                                    <input type="text" name="inObservStdFemale" id="inObservStdFemale" value="<?php echo $observ['observ_std_female'] ?>" class="form-control" required/>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">ขาด/ลา (คน)</label>
                                                    <input type="text" name="inObservStdAbsent" id="inObservStdAbsent" value="<?php echo $observ['observ_std_absent'] ?>" class="form-control" required/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-8">
                                                    <label class="control-label">เรื่องที่สอน</label>
                                                    <input type="text" name="inObservIssue" id="inObservIssue" value="<?php echo $observ['observ_issue'] ?>" class="form-control" required/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <center>
                                                        <button type="submit" class="btn btn-warning"><i class="icon-pencil"></i> แก้ไข</button>
                                                        <button type="button" class="btn btn-danger btn-observ-delete" id="<?php echo $observ['id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                                    </center>
                                                </div>
                                            </div>
                                            <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                            <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                                        </form>
                                    <?php else: ?>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <b>สังเกตการสอนครั้งที่</b> <?php echo $observ['observ_no']; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <b>เวลา</b> <?php echo $observ['observ_time']; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <b>จำนวนนักเรียนชาย (คน)</b> <?php echo $observ['observ_std_male']; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <b>จำนวนนักเรียนหญิง (คน)</b> <?php echo $observ['observ_std_female']; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <b>ขาด/ลา (คน)</b> <?php echo $observ['observ_std_absent']; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8"><b>เรื่องที่สอน</b> <?php echo $observ['observ_issue']; ?></div>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <form method="post" id="observ-normal-form" style="margin-top:20px;">
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label class="control-label">สังเกตการสอนครั้งที่</label>
                                                <input type="text" name="inObservNo" id="inObservNo" class="form-control" required autofocus/>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">เวลา</label>
                                                <input type="text" name="inObservTime" id="inObservTime" class="form-control" required/>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">จำนวนนักเรียนชาย (คน)</label>
                                                <input type="text" name="inObservStdMale" id="inObservStdMale" class="form-control" required/>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">จำนวนนักเรียนหญิง (คน)</label>
                                                <input type="text" name="inObservStdFemale" id="inObservStdFemale" class="form-control" required/>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">ขาด/ลา (คน)</label>
                                                <input type="text" name="inObservStdAbsent" id="inObservStdAbsent" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-8">
                                                <label class="control-label">เรื่องที่สอน</label>
                                                <input type="text" name="inObservIssue" id="inObservIssue" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                                            </div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                        <input  type="hidden" name="status" value="" />
                                    </form>
                                <?php endif; ?>
                            </div>                            
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" style="box-shadow:none;">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                ส่วนประกอบต่าง ๆ ในห้องเรียน
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <?php if ($classroom): ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="classroom-form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="control-label">ส่วนประกอบต่าง ๆ ในห้องเรียน</label>
                                                <input type="file" name="inObservClassroom" id="inObservClassroom" class="filestyle" />
                                            </div>
                                            <div class="form-group col-md-1">
                                                <?php echo br(); ?>
                                                <button type="submit" class="btn btn-default"><i class="icon-pencil"></i> แก้ไข</button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $classroom['schedule_detail_id']; ?>" />
                                        <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                                    </form>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php if (file_exists('upload/' . $classroom['observ_classroom']) && !empty($classroom['observ_classroom'])): ?>
                                                <img src="<?php echo base_url() . 'upload/' . $classroom['observ_classroom']; ?>" style="width:80%;height:65%;border:3px double #ccc;padding:8px;" />
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php if (file_exists('upload/' . $classroom['observ_classroom']) && !empty($classroom['observ_classroom'])): ?>
                                                <img src="<?php echo base_url() . 'upload/' . $classroom['observ_classroom']; ?>" class="img-thumbnail" style="width:80%;height:65%;" />
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="classroom-form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="control-label">ส่วนประกอบต่าง ๆ ในห้องเรียน</label>
                                                <input type="file" name="inObservClassroom" id="inObservClassroom" class="filestyle" />
                                            </div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                        <input type="hidden" name="status" value="" />
                                        <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" style="box-shadow:none;">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                เนื้อหา
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <?php if ($content): ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="observ-content-form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <textarea style="width:100%;height:150px;border:none;" name="inObservContent" id="inObservContent" placeholder="คลิกเพื่อพิมพ์ข้อมูล..."><?php echo $content['observ_content']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="submit" class="btn btn-default"><i class="icon-pencil"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-default btn-content-delete" id="<?php echo $content['schedule_detail_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                                </center>
                                            </div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $content['schedule_detail_id']; ?>" />
                                        <input type="hidden" name="edit" id="edit" value="edit_data" />
                                    </form>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $observ_content['observ_content']; ?>
                                        </div>
                                    </div>

                                <?php endif; ?>
                            <?php else: ?>
                                <form method="post" id="observ-content-form">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <textarea style="width:100%;height:150px;border:none;" name="inObservContent" id="inObservContent" placeholder="คลิกเพื่อพิมพ์ข้อมูล..."></textarea>
                                        </div>
                                    </div>
                                    <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center></div>
                                    <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" style="box-shadow:none;">
                    <div class="panel-heading" role="tab" id="heading4">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                ความคิดรวบยอด
                            </a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapse4">
                        <div class="panel-body">
                            <?php if ($concept): ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="observ-concept-form">
                                        <div class="row">
                                            <textarea name="inObservConcept" id="inObservConcept" style="width:100%;height:180px;border:none;"><?php echo $concept['observ_concept']; ?></textarea>
                                        </div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="submit" class="btn btn-default"><i class="icon-pencil"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-default btn-concept-delete" id="<?php echo $concept['schedule_detail_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                                </center>
                                            </div>
                                        </div>
                                        <input type="hidden" name="edit" id="edit" value="edit_data" />
                                        <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $concept['schedule_detail_id']; ?>" />
                                    </form>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $concept['observ_concept']; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <!-- บันทึกข้อมูล -->
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="observ-concept-form">
                                        <div class="row">
                                            <textarea name="inObservConcept" id="inObservConcept" style="width:100%;height:180px;border:none;" placeholder="คลิกเพื่อพิมพ์ข้อมูล..."></textarea>
                                        </div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-md-12"><center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center></div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>                    

                <div class="panel panel-default" style="box-shadow:none;">
                    <div class="panel-heading" role="tab" id="headingFive">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                พฤติกรรมครู
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                        <div class="panel-body">
                            <?php if (!empty($teacher_act)): ?>
                                <!-- Edit data -->
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="observ-teacher-activities-form" style="margin-left:20px;margin-right:20px;">
                                        <div class="row">
                                            <textarea name="inObservTeacherActivities" id="inObservTeacherActivities" style="width:100%;height:180px;border:none;"><?php echo $teacher_act['teacher_activities']; ?></textarea>
                                        </div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="submit" class="btn btn-default"><i class="icon-pencil"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-default btn-teacher-activities-delete" id="<?php echo $teacher_act['schedule_detail_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                                </center>
                                            </div>
                                        </div>
                                        <input type="hidden" name="status" id="status" value="ปรับปรุงข้อมูล" />
                                        <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $teacher_act['schedule_detail_id']; ?>" />
                                    </form>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $teacher_act['teacher_activities']; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <!-- Add data -->
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="observ-teacher-activities-form" style="margin-left:20px;margin-right:20px;">
                                        <div class="row">
                                            <textarea name="inObservTeacherActivities" id="inObservTeacherActivities" style="width:100%;height:180px;border:none;" placeholder="คลิกเพื่อพิมพ์ข้อมูล..."></textarea>
                                        </div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-md-12"><center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center></div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?> 
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" style="box-shadow:none;">
                    <div class="panel-heading" role="tab" id="headingSix">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                พฤติกรรมนักเรียน
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                        <div class="panel-body">
                            <?php if (!empty($student_act)): ?>
                                <!-- Edit data -->
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="observ-student-activities-form" style="margin-left:20px;margin-right:20px;">
                                        <div class="row">
                                            <textarea name="inObservStudentActivities" id="inObservStudentActivities" style="width:100%;height:180px;border:none;"><?php echo $student_act['student_activities']; ?></textarea>
                                        </div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="submit" class="btn btn-default"><i class="icon-pencil"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-default btn-student-activities-delete" id="<?php echo $student_act['schedule_detail_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                                </center>
                                            </div>
                                        </div>
                                        <input type="hidden" name="status" id="status" value="ปรับปรุงข้อมูล" />
                                        <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $student_act['schedule_detail_id']; ?>" />
                                    </form>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $student_act['student_activities']; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <!-- Add data -->
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="observ-student-activities-form" style="margin-left:20px;margin-right:20px;">
                                        <div class="row">
                                            <textarea name="inObservStudentActivities" id="inObservStudentActivities" style="width:100%;height:180px;border:none;" placeholder="คลิกเพื่อพิมพ์ข้อมูล..."></textarea>
                                        </div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-md-12"><center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center></div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- กิจกรรมการเรียนการสอน -->
                <div class="panel panel-default" style="box-shadow:none;">
                    <div class="panel-heading" role="tab" id="headingSeven">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                กิจกรรมการเรียนการสอน
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped display" id="study-activities" style="border:none;">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">ที่</th>
                                            <th class="no-sort">กิจกรรมที่ - รายละเอียด</th>
                                            <th class="no-sort">ใช้เวลา (นาที)</th>
                                            <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                <th class="no-sort"></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $row = 1; ?>
                                        <?php foreach ($study_act as $r): ?>
                                            <tr>
                                                <td style="text-align:center;"><?php echo $row; ?></td>
                                                <td><?php echo $r['activities_no'] . ' - ' . $r['activities_detail']; ?></td>
                                                <td style="text-align:center;"><?php echo $r['activities_time']; ?></td>
                                                <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
                                                    <td style="text-align:center;border-right:none;">
                                                        <button type="button" class="btn btn-default btn-study-activities-edit" id="<?php echo $r['id'] ?>"><i class="icon-pencil"></i> แก้ไข</button>
                                                        <button type="button" class="btn btn-default btn-study-activities-delete" id="<?php echo $r['id'] ?>"><i class="icon-pencil"></i> ลบ</button>
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

                <!-- การประเมินผล -->
                <div class="panel panel-default" style="box-shadow:none;">
                    <div class="panel-heading" role="tab" id="headingValuation">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseValuation" aria-expanded="false" aria-controls="collapseValuation">
                                การประเมินผล
                            </a>
                        </h4>
                    </div>
                    <div id="collapseValuation" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingValuation">
                        <div class="panel-body">
                            <?php if (!empty($valuation)): ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="valuation-form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <textarea class="form-control" name="inValuationDetail" id="inValuationDetail" style="height:160px;border:none;" required><?php echo $valuation['valuation_detail']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row"><center>
                                                <button type="submit" class="btn btn-default"><i class="icon-pencil"></i> แก้ไข</button>
                                                <button type="button" class="btn btn-default btn-valuation-delete" id="<?php echo $valuation['schedule_detail_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                            </center></div>
                                        <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                        <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                                    </form>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $valuation['valuation_detail']; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="valuation-form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <textarea class="form-control" name="inValuationDetail" id="inValuationDetail" style="height:160px;border:none;" required placeholder="คลิกเพื่อพิมพ์ข้อมูล..."></textarea>
                                            </div>
                                        </div>
                                        <div class="row"><center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center></div>
                                        <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>                    

                <!-- การใช้สื่อ -->
                <div class="panel panel-default" style="box-shadow:none;">
                    <div class="panel-heading" role="tab" id="headingEight">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                การใช้สื่อ/นวัตกรรม
                            </a>
                        </h4>
                    </div>
                    <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                        <div class="panel-body">
                            <?php if (!empty($media)): ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="media-form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <textarea name="inMediaDescription" id="inMediaDescription" class="form-control" style="height:180px;border:none;" placeholder="คลิกพิมพ์ข้อมูล..."><?php echo $media['media_description']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <center>
                                                <button type="submit" class="btn btn-default"><i class="icon-pencil"></i> แก้ไข</button>
                                                <button type="button" class="btn btn-default btn-media-delete" id="<?php echo $media['schedule_detail_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                            </center>
                                        </div>
                                        <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                                        <input type="hidden" name="schedule_detail_id" value="<?php echo $media['schedule_detail_id'] ?>" />
                                    </form>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $media['medai_description']; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <form method="post" id="media-form">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <textarea name="inMediaDescription" id="inMediaDescription" class="form-control" style="height:180px;border:none;" placeholder="คลิกพิมพ์ข้อมูล..."></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <center>
                                            <button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button>
                                        </center>
                                    </div>
                                    <input type="hidden" name="schedule_detail_id" id="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>                    

                <!-- การใช้คำถาม -->
                <div class="panel panel-default" style="box-shadow:none;">
                    <div class="panel-heading" role="tab" id="headingNine">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                การใช้คำถามของครู
                            </a>
                        </h4>
                    </div>
                    <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                        <div class="panel-body">
                            <?php if (!empty($teacher_question)): ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="teacher-question">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <textarea name="inTeacherQuestion" id="inTeacherQuestion" class="form-control" style="height:180px;border:none;" required required placeholder="คลิกเพื่อพิมพ์ข้อมูล..."><?php echo $teacher_question['teacher_question']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="submit" class="btn btn-default"><i class="icon-pencil"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-default btn-teacher-question" id="<?php echo $teacher_question['schedule_detail_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                                </center>
                                            </div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" value="<?php echo $teacher_question['schedule_detail_id']; ?>" />
                                        <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                                    </form>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-12"><?php echo $teacher_question['teacher_question']; ?></div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="teacher-question">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <textarea name="inTeacherQuestion" id="inTeacherQuestion" class="form-control" style="height:180px;border:none;" required required placeholder="คลิกเพื่อพิมพ์ข้อมูล..."></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                                            </div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" style="box-shadow:none;">
                    <div class="panel-heading" role="tab" id="headingTen">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                การใช้คำถามของนักเรียน
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                        <div class="panel-body">
                            <?php if (!empty($student_question)): ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="student-question">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <textarea name="inStudentQuestion" id="inStudentQuestion" class="form-control" style="height:180px;border:none;" required><?php echo $student_question['student_question']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="submit" class="btn btn-default"><i class="icon-pencil"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-default btn-student-question" id="<?php echo $student_question['schedule_detail_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                                </center>
                                            </div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" value="<?php echo $student_question['schedule_detail_id']; ?>" />
                                        <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                                    </form>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-12"><?php echo $teacher_question['student_question']; ?></div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="student-question">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <textarea name="inStudentQuestion" id="inStudentQuestion" class="form-control" style="height:180px;border:none;" required placeholder="คลิกเพื่อพิมพ์ข้อมูล..."></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                                            </div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                        <input type="hidden" name="status" value="" />
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>                    

                <!-- สรุป -->
                <div class="panel panel-default" style="box-shadow:none;">
                    <div class="panel-heading" role="tab" id="headingEleven">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                สรุปจุดแข็ง (Strength)
                            </a>
                        </h4>
                    </div>
                    <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEleven">
                        <div class="panel-body">

                            <?php if (!empty($strength)): ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="strength-form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <legend>จุดแข็ง</legend>
                                                <textarea class="form-control" name="inStrengthDetail" id="inStrengthDetail" style="height:180px;border:none;" required="" placeholder="คลิกเพื่อพิมพ์ข้อมูล..."><?php echo $strength['strength_detail']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <legend>จุดที่ควรพัฒนา</legend>
                                                <textarea class="form-control" name="inStrengthDev" id="inStrengthDev" style="height:180px;border:none;" placeholder="คลิกเพื่อพิมพ์ข้อมูล..."><?php echo $strength['strength_dev']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="submit" class="btn btn-default"><i class="icon-pencil"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-default btn-strength-delete" id="<?php echo $strength['schedule_detail_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                                </center>
                                            </div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" value="<?php echo $strength['schedule_detail_id'] ?>" />
                                        <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                                    </form>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $strength['strength_detail']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $strength['strength_dev']; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="strength-form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <legend>จุดแข็ง</legend>
                                                <textarea class="form-control" name="inStrengthDetail" id="inStrengthDetail" style="height:180px;border:none;" required placeholder="คลิกเพื่อพิมพ์ข้อมูล..."></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <legend>จุดที่ควรพัฒนา</legend>
                                                <textarea class="form-control" name="inStrengthDev" id="inStrengthDev" style="height:180px;border:none;" placeholder="คลิกเพื่อพิมพ์ข้อมูล..."></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <center><button type="submit" class="btn btn-success"><i class="icon-save" placeholder="คลิกเพื่อพิมพ์ข้อมูล..."></i> บันทึก</button></center>
                                            </div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                        <input type="hidden" name="status" value="" />
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>                                  

                <div class="panel panel-default" style="box-shadow:none;">
                    <div class="panel-heading" role="tab" id="headingTwelve">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                สรุปจุดอ่อน (Weakness)
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwelve">
                        <div class="panel-body">
                            <?php if (!empty($weakness)): ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="weakness-form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <legend>จุดอ่อน</legend>
                                                <textarea class="form-control" name="inWeaknessDetail" id="inWeaknessDetail" style="height:180px;border:none;" required=""><?php echo $weakness['weakness_detail']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <legend>จุดที่ควรพัฒนา</legend>
                                                <textarea class="form-control" name="inWeaknessDev" id="inWeaknessDev" style="height:180px;border:none;"><?php echo $weakness['weakness_dev']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="submit" class="btn btn-default"><i class="icon-pencil"></i> แก้ไข</button>
                                                    <button type="button" class="btn btn-default btn-weakness-delete" id="<?php echo $weakness['schedule_detail_id']; ?>"><i class="icon-trash"></i> ลบ</button>
                                                </center>
                                            </div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                        <input type="hidden" name="status" value="ปรับปรุงข้อมูล" />
                                    </form>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $weakness['weakness_detail']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $weakness['weakness_dev']; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ($this->session->userdata('status') == 'ผู้ปฏิบัติงาน'): ?>
                                    <form method="post" id="weakness-form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <legend>จุดอ่อน</legend>
                                                <textarea class="form-control" name="inWeaknessDetail" id="inWeaknessDetail" style="height:180px;border:3px double #ccc;" required placeholder="คลิกเพื่อพิมพ์ข้อมูล..."></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <legend>จุดที่ควรพัฒนา</legend>
                                                <textarea class="form-control" name="inWeaknessDev" id="inWeaknessDev" style="height:180px;" placeholder="คลิกเพื่อพิมพ์ข้อมูล..."></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <center><button type="submit" class="btn btn-success"><i class="icon-save"></i> บันทึก</button></center>
                                            </div>
                                        </div>
                                        <input type="hidden" name="schedule_detail_id" value="<?php echo $this->uri->segment(2); ?>" />
                                        <input type="hidden" name="status" value="" />
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>              
            </div>
        </div>
        <?php $this->load->view('layout/my_school_footer'); ?>
    </div>
</div>
<!---------------------------------------------------------------------------->
<script>
    $('#study-activities').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": true,
        columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
        "language": {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "zeroRecords": "## ไม่มีข้อมูล ##",
            "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "",
            "infoFiltered": "",
            "sSearch": "ระบุคำค้น",
            "sPaginationType": "full_numbers"
        }
    });


    $('#example').DataTable({
        "responsive": true,
        "stateSave": true,
        "bSort": false,
        "ordering": true,
        columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
        "language": {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "zeroRecords": "## ไม่มีข้อมูล ##",
            "info": "แสดงหน้าที่ _PAGE_ ในทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "",
            "infoFiltered": "",
            "sSearch": "ระบุคำค้น",
            "sPaginationType": "full_numbers"
        }
    });
    $('.sorting_asc').removeClass('sorting_asc');
    // Tool tips;
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-default btn-print'><i class='icon-print icon-large'></i> พิมพ์</a>");
    //
    var status = '<?php echo $this->session->userdata('status'); ?>';
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#example_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-success btn-insert'><i class='icon-plus icon-large'></i> บันทึก</a>");
    }
    if (status == 'ผู้ปฏิบัติงาน') {
        $('div#study-activities_length.dataTables_length').append("&nbsp;&nbsp;<a href='#' class='btn btn-success btn-study-activities-insert'><i class='icon-plus icon-large'></i> บันทึก</a>");
    }
    // บันทึกข้อมูลจาก observer-normal-form
    $("#observ-normal-form").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-supervision-observ-information'); ?>',
            method: 'post',
            data: $('#observ-normal-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $('#observ-normal-form')[0].reset();
                location.reload();
            }
        });
    });
    // delete observ normal data;
    $('.btn-observ-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-supervision-observ-information'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    //
    // Classroom form
    $('#classroom-form').on('submit', function (e) {
        e.preventDefault;
        var file = $('#inObservClassroom').val();
        var ext = $('#inObservClassroom').val().split('.').pop().toLowerCase();
        if (file == '') {
            alert('File ภาพส่วนประกอบภายในห้องเรียนจะมีค่าว่างไม่ได้...');
            return false;
        }

        if (jQuery.inArray(ext, ['jpg', 'png']) == -1) {
            alert('File ภาพส่วนประกอบภายในห้องเรียนจะต้องเป็นชนิด jpg หรือ png เท่านั้น');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-observ-classroom-component'); ?>',
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                location.reload();
            }
        });
    });
    // เนื้อหา
    $('#observ-content-form').on('submit', function (e) {
        e.preventDefault();
        var content = $('#inObservContent').val();
        if (content == '') {
            alert('ส่วนของเนื้อหาจะมีค่าว่างไม่ได้...');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-observ-content'); ?>',
            method: 'post',
            data: $('#observ-content-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเนื้อหาเรียบร้อย...');
                $('#observ-content-form')[0].reset();
                location.reload();
            }
        });
    });
    // ลบเนื้อหา
    $('.btn-content-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-observ-content'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // Observ Concept
    $('#observ-concept-form').on('submit', function (e) {
        e.preventDefault();
        var concept = $('#inObservConcept').val();
        if (concept == '') {
            alert('ข้อมูลความคิดรวบยอดจะมีค่าว่างไม่ได้...');
            return false;
        }
        $.ajax({
            url: '<?php echo site_url('insert-observ-concept'); ?>',
            method: 'post',
            data: $('#observ-concept-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลความคิดรวบยอดเรียบร้อย...');
                $('#observ-concept-form')[0].reset();
                location.reload();
            }
        });
    });
    // ลบข้อมูลความคิดรวบยอด
    $('.btn-concept-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-observ-concept'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    // พฤติกรรมครู
    $('#observ-teacher-activities-form').on('submit', function (e) {
        e.preventDefault();
        var status = $('#inObservTeacherActivities').val();
        if (status == '') {
            alert('ข้อมูลพฤติกรรมครูจะมีค่าว่างไม่ได้...');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-observ-teacher-activities'); ?>',
            method: 'post',
            data: $('#observ-teacher-activities-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $('#observ-teacher-activities-form')[0].reset();
                location.reload();
            }
        });
    });

    // ลบข้อมูลพฤติกรรมครู
    $('.btn-teacher-activities-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-observ-teacher-activities'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    // พฤติกรรมนักเรียน
    $('#observ-student-activities-form').on('submit', function (e) {
        e.preventDefault();
        var status = $('#inObservStudentActivities').val();
        if (status == '') {
            alert('ข้อมูลพฤติกรรมนักเรียนจะมีค่าว่างไม่ได้...');
            return false;
        }
        //
        $.ajax({
            url: '<?php echo site_url('insert-observ-student-activities'); ?>',
            method: 'post',
            data: $('#observ-student-activities-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $('#observ-student-activities-form')[0].reset();
                location.reload();
            }
        });
    });

    // ลบข้อมูลพฤติกรรมครู
    $('.btn-student-activities-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-observ-student-activities'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    // กิจกรรมการเรียนการสอน
    $('.btn-study-activities-insert').on('click', function () {
        $('#study-activities-form').trigger('reset');
        $('h3.modal-title').text('บันทึกข้อมูลกิจกรรมการเรียนการสอน');
        $('#study-activities-modal').modal('show');
    });
    // แก้ไขข้อมูลกิจกรรมการเรียนฯ
    $('#study-activities').on('click', '.btn-study-activities-edit', function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('update-observ-study-activities'); ?>',
            method: 'post',
            data: {id: uid},
            dataType: 'json',
            success: function (data) {
                $('#activities_id').val(data.id);
                $('#inStudyActivitiesNo').val(data.activities_no);
                $('#inStudyActivitiesDetail').val(data.activities_detail);
                $('#inStudyActivitiesTime').val(data.activities_time);
                //
                $('h3.modal-title').text('แก้ไขข้อมูลกิจกรรมการเรียนการสอน');
                $('#study-activities-modal').modal('show');
            }
        });
    });
    // ลบข้อมูลกิจกรรมการเรียนการสอน
    $('#study-activities').on('click', '.btn-study-activities-delete', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-observ-study-activities'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // บันทึกการประเมินผล
    $('#valuation-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-observ-valuation'); ?>',
            method: 'post',
            data: $('#valuation-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย');
                $('#valuation-form')[0].reset();
                location.reload();
            }
        });
    });
    // ลบข้อมูลการประเมินผล
    $('.btn-valuation-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-observ-valuation'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    // การใช้สื่อ
    $('#media-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-observ-media'); ?>',
            method: "POST",
            data: $("#media-form").serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $("#media-form")[0].reset();
                location.reload();
            }
        });
    });
    // delete การใช้สื่อ
    $('.btn-media-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-observ-media'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // การใช้คำถามของครู
    $('#teacher-question').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-observ-teacher-question'); ?>',
            method: 'post',
            data: $('#teacher-question').serialize(),
            success: function (data) {
                alert('บันทึกเรียบร้อย...');
                $('#teacher-question')[0].reset();
                location.reload();
            }
        });
    });
    // ลบข้อมูลการใช้คำถามของครู
    $('.btn-teacher-question').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-observ-teacher-question'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // การใช้คำถามของนักเรียน
    $('#student-question').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-observ-student-question'); ?>',
            method: 'post',
            data: $('#student-question').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $('#student-question')[0].reset();
                location.reload();
            }
        });
    });
    // delete
    $('.btn-student-question').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-observ-student-question'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    // สรุปจุดแข็งและจุดที่ควรพัฒนา
    $('#strength-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-observ-strength'); ?>',
            method: 'post',
            data: $('#strength-form').serialize(),
            success: function (data) {
                alert('บันทึกข้อมูลเรียบร้อย...');
                $('#strength-form')[0].reset();
                location.reload();
            }
        });
    });
    // delete
    $('.btn-strength-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-observ-strength'); ?>',
                method: 'post',
                data: {schedule_detail_id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
    // สรุปจุดอ่อนและากรปรับปรุงแก้ไข
    $('#weakness-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo site_url('insert-observ-weakness'); ?>',
            method: 'post',
            data: $('#weakness-form').serialize(),
            success: function (data) {
                $('#weakness-form')[0].reset();
                location.reload();
            }
        });
    });
    // delete data;
    $('.btn-weakness-delete').on('click', function () {
        var uid = $(this).attr('id');
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('delete-observ-weakness'); ?>',
                method: 'post',
                data: {schedule_detail_id: uid},
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>

<!---------------------------------------------------------------------------->
<?php //$this->load->view('vichakarn/modals/observ_normal_modal'); ?>
<?php $this->load->view('vichakarn/modals/study_activities_modal'); ?>