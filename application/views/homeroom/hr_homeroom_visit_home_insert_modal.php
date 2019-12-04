<!-- Modal -->
<style>
    input[type="checkbox"]{
        padding-left:5px;
        padding-right:5px;
        border-radius:5px;
        transform : scale(2); 
        margin-right:10px;
    } 

    input:checked + label {
        color: red;

    }

    input[type="radio"] {

        margin:10px;
        -ms-transform: scale(1.5); /* IE 9 */
        -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
        transform: scale(1.5);
    } 

    input:redio + label {
        color: red;

    }
</style>
<div id="visit-home-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title">บันทึกข้อมูลการเยี่ยมบ้านนักเรียน <?php echo $this->session->userdata('department') ?></h3>
            </div>
            <div class="modal-body" style="padding:30px;">
                <form method="post" id="vh-insert-new-form" enctype="multipart/form-data">
                    <div class='row'>
                        <input type='hidden' id='VhClId' name='VhClId' value=''/>
                        <div id='For1'>
                            <div class='col-md-12'>
                                <legend>๑. ข้อมูลส่วนตัวนักเรียน</legend>
                                <div class='col-md-3' style='margin-top:20px;'>
                                    <center>
                                        <img src='' name='inVhStdPicture' id='inVhStdPicture' class='' style='width: 190px;height: 190px;' />
                                    </center>
                                </div>
                                <div class='col-md-9'>

                                    <div class='col-md-2'>
                                        <label class='control-label'>คำนำหน้า</label>
                                        <input type='text' name='inVhStdTitleName' id='inVhStdTitleName' class='form-control' readonly />
                                    </div>
                                    <div class='col-md-5 form-group'>
                                        <label class='control-label'>ชื่อ (ภาษาไทย)</label>
                                        <input type='text' name='inVhStdFirstName' id='inVhStdFirstName' class='form-control' readonly />
                                    </div>
                                    <div class='col-md-5 form-group'>
                                        <label class='control-label'>นามสกุล (ภาษาไทย)</label>
                                        <input type='text' name='inVhStdLastName' id='inVhStdLastName' class='form-control' readonly />
                                    </div>

                                    <div class='col-md-3'>
                                        <label class='control-label'>ชั้น</label>
                                        <input type='text' name='inVhStdClassName' id='inVhStdClassName' class='form-control' readonly />
                                    </div>
                                    <div class='col-md-5 form-group'>
                                        <label class='control-label'>เลขบัตรประจำตัวประชาชน</label>
                                        <input type='text' name='inVhStdIdCard' id='inVhStdIdCard' class='form-control' readonly />
                                    </div>

                                    <div class='col-md-3'>
                                        <label class='control-label'>ชื่อเล่นนักเรียน</label>
                                        <input type='text' name='inVhStdNickName' id='inVhStdNickName' class='form-control' readonly />
                                    </div>
                                    <div class='col-md-5 form-group'>
                                        <label class='control-label'>เลขประจำตัวนักเรียน</label>
                                        <input type='text' name='inVhStdCode' id='inVhStdCode' class='form-control' readonly />
                                    </div>
                                    <!--                                    <div class='col-md-4 form-group'>
                                                                            <label class='control-label'>เบอร์โทรศัพท์</label>
                                                                            <input type='text' name='inVhStdPhone' id='inVhStdPhone' class='form-control' readonly />
                                                                        </div>-->
                                </div>

                            </div>
                        </div>
                        <div id='For2'>
                            <div class='col-md-12'>
                                <legend>๒. ผู้ปกครองนักเรียน</legend>

                                <div class='col-md-9' style='margin-top:20px;'>
                                    <div class='col-md-2 from-group'>
                                        <label class='control-label'>คำนำหน้า</label>
                                        <input type='text' name='inVhPrTitleName' id='inVhPrTitleName' class='form-control' required />
                                    </div>
                                    <div class='col-md-5 form-group'>
                                        <label class='control-label'>ชื่อ (ภาษาไทย)</label>
                                        <input type='text' name='inVhPrFirstName' id='inVhPrFirstName' class='form-control' required />
                                    </div>
                                    <div class='col-md-5 form-group'>
                                        <label class='control-label'>นามสกุล (ภาษาไทย)</label>
                                        <input type='text' name='inVhPrLastName' id='inVhPrLastName' class='form-control' required />
                                    </div>
                                    <div class='col-md-4 from-group'>
                                        <label class='control-label'>ความสัมพันธ์ของผู้ปกครองกับนักเรียน</label>
                                        <input type='text' name='inVhPrRelation' id='inVhPrRelation' class='form-control' required />
                                    </div>
                                    <div class='col-md-4 form-group'>
                                        <label class='control-label'>อาชีพ</label>
                                        <input type='text' name='inVhPrCareer' id='inVhPrCareer' class='form-control'  />
                                    </div>
                                    <div class='col-md-4 form-group'>
                                        <label class='control-label'>รายได้/เดือน</label>
                                        <input type='text' name='inVhPrCareerSalary' id='inVhPrCareerSalary' class='form-control'  />
                                    </div>


                                    <div class='col-md-4 from-group'>
                                        <label class='control-label'>เบอร์โทรศัพท์</label>
                                        <input type='text' name='inVhPrPhone' id='inVhPrPhone' class='form-control'  />
                                    </div>
                                    <div class='col-md-4 form-group'>
                                        <label class='control-label'>จบการศึกษาสูงสุด</label>
                                        <input type='text' name='inVhPrEducation' id='inVhPrEducation' class='form-control'  />
                                    </div>
                                    <div class='col-md-4 form-group'>
                                        <label class='control-label'>เลขที่บัตรประชาชน</label>
                                        <input type='text' name='inVhPrIdcard' id='inVhPrIdcard' class='form-control'  />
                                    </div>

                                </div>
                                <div class='col-md-3' style='margin-top:20px;'>
                                    <label class='control-label'>ภาพผู้ปกครอง</label>
                                    <center>
                                        <img style='width: 190px;height: 190px;' />
                                    </center>
                                </div>

                            </div>
                        </div>
                        <div id='For3'>
                            <div class='col-md-12'>
                                <legend>๓. ความสัมพันธ์ในครอบครัว</legend>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๓.๑ สมาชิกในครอบครัวมีเวลาอยู่ร่วมกันกี่ชั่วโมงต่อวัน </h4>
                                    <span style='float: left;'>
                                        <select  name='in31' id='in31' class='form-control'>
                                            <?php
                                            for ($i = 0; $i < 25; $i++) {
                                                echo "<option value='{$i}'>" . $i . " ชั่วโมง/วัน</option>";
                                            }
                                            ?>

                                        </select>
                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๓.๒ กรณีที่ผู้ปกครองไม่อยู่บ้านฝากเด็กนักเรียนอยู่บ้านกับใคร </h4>
                                    <span style='float: left;'>
                                        <select name='in32' id='in32'  class='form-control'>
                                            <option value=''>ไม่เลือกข้อมูล</option>
                                            <option value='ญาติ'>ญาติ</option>
                                            <option value='เพื่อนบ้าน'>เพื่อนบ้าน</option>
                                            <option value='นักเรียนอยู่บ้านด้วยตนเอง'>นักเรียนอยู่บ้านด้วยตนเอง</option>
                                            <option value='อื่นๆ'>อื่นๆ</option>
                                        </select>
                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๓.๓ รายได้ครัวเรือนเฉลี่ยต่อคน (รวมรายได้ครัวเรือน หารด้วยจำนวนสมาชิกทั้งหมด) หน่วยเป็นบาท</h4>
                                    <span style='float: left;'>
                                        <input type='number' class='form-control' id='in33' name='in33'/>
                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๓.๔ นักเรียนได้รับค่าใช้จ่ายจาก</h4>
                                    <span style='float: left;'>
                                        <input type='text' class='form-control' id='in341' name='in341'/>
                                    </span>
                                    <h4 style='float: left;margin-right:10px;'>นักเรียนได้เงินมาโรงเรียนวันละหน่วยเป็นบาท</h4>
                                    <span style='float: left;'>
                                        <input type='number' class='form-control' id='in342' name='in342'/>
                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4>๓.๕ สิ่งที่ผู้ปกครองต้องการให้โรงเรียนช่วยเหลือนักเรียน </h4>
                                    <div class='col-md-6 form-group'>
                                        <input type='checkbox' name='in35' id='in35' value='ด้านการเรียน'/>
                                        <label class='control-label' >ด้านการเรียน</label>
                                    </div>
                                    <div class='col-md-6 form-group'>
                                        <input type='checkbox' name='in35' id='in35' value='ด้านพฤติกรรม'/>
                                        <label class='control-label'>ด้านพฤติกรรม</label>
                                    </div>
                                    <div class='col-md-6 form-group'>
                                        <input type='checkbox' name='in35' id='in35' value='ด้านเศรษฐกิจ เช่น ขอรับทุน'/>
                                        <label class='control-label'>ด้านเศรษฐกิจ เช่น ขอรับทุน</label>
                                    </div>
                                    <div class='col-md-6 form-group'>
                                        <input type='checkbox' name='in35' id='in35' value='อื่นๆ'/>
                                        <label class='control-label'>อื่นๆ</label>
                                    </div>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4>๓.๗ ความช่วยเหลือที่ครอบครัวเคยได้รับจากหน่วยงานหรือต้องการได้รับการช่วยเหลือ </h4>
                                    <div class='col-md-6 form-group'>
                                        <input type='checkbox' name='in37' id='in37' value='เบี้ยผู้สูงอายุ'/>
                                        <label class='control-label'>เบี้ยผู้สูงอายุ</label>
                                    </div>
                                    <div class='col-md-6 form-group'>
                                        <input type='checkbox' name='in37' id='in37' value='เบี้ยพิการ'/>
                                        <label class='control-label'>เบี้ยพิการ</label>
                                    </div>
                                    <div class='col-md-6 form-group'>
                                        <input type='checkbox' name='in37' id='in37' value='อื่นๆ'/>
                                        <label class='control-label'>อื่นๆ</label>
                                    </div>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <label class='control-label'>๓.๘ ข้อห่วงใยของผู้ปกครองที่มีต่อนักเรียน </label>
                                    <span >
                                        <textarea id="in38" name="in38" style="width:100%;height:100px;"></textarea>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div id='For4'>
                            <div class='col-md-12'>
                                <legend>๔. พฤติกรรมและความเสี่ยง </legend>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๔.๑ สภาพร่างกาย </h4>
                                    <span style='float: left;'>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in41' id='in41' value='ร่างกายไม่แข็งแรง'/>
                                            <label class='control-label'>ร่างกายไม่แข็งแรง</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in41' id='in41' value='มีโรคประจำตัวหรือเจ็บป่วยบ่อย'/>
                                            <label class='control-label'>มีโรคประจำตัวหรือเจ็บป่วยบ่อย</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in41' id='in41' value='มีภาวะทุพโภชนาการ'/>
                                            <label class='control-label'>มีภาวะทุพโภชนาการ</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in41' id='in41' value='ป่วยเป็นโรคร้ายแรงเรื้อรัง'/>
                                            <label class='control-label'>ป่วยเป็นโรคร้ายแรงเรื้อรัง</label>
                                        </div>
                                        <div class='col-md-12 form-group'>
                                            <input type='checkbox' name='in41' id='in41' value='สมรรถภาพทางร่างกายต่ำ'/>
                                            <label class='control-label'>สมรรถภาพทางร่างกายต่ำ</label>
                                        </div>

                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๔.๒ สวัสดิการหรือความปลอดภัย </h4>
                                    <span style='float: left;'>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in42' id='in42' value='พ่อแม่แยกทางกัน หรือแต่งงานใหม่'/>
                                            <label class='control-label'>พ่อแม่แยกทางกัน หรือแต่งงานใหม่</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in42' id='in42' value='ที่พักอาศัยอยู่ในชุมชนแออัดหรือใกล้แหล่งมั่วสุม/สถานเริงรมย์'/>
                                            <label class='control-label'>ที่พักอาศัยอยู่ในชุมชนแออัดหรือใกล้แหล่งมั่วสุม/สถานเริงรมย์ </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in42' id='in42' value='มีบุคคลในครอบครัวเจ็บป่วยด้วยโรคร้ายแรง/เรื้อรัง/ติดต่'/>
                                            <label class='control-label'> มีบุคคลในครอบครัวเจ็บป่วยด้วยโรคร้ายแรง/เรื้อรัง/ติดต่อ</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in42' id='in42' value='บุคคลในครอบครัวติดสารเสพติด'/>
                                            <label class='control-label'>บุคคลในครอบครัวติดสารเสพติด</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in42' id='in42' value='บุคคลในครอบครัวเล่นการพนัน'/>
                                            <label class='control-label'>บุคคลในครอบครัวเล่นการพนัน </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in42' id='in42' value='มีความขัดแย้ง/ทะเลาะกันในครอบครัว'/>
                                            <label class='control-label'>มีความขัดแย้ง/ทะเลาะกันในครอบครัว </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in42' id='in42' value='ไม่มีผู้ดูแล'/>
                                            <label class='control-label'> ไม่มีผู้ดูแล </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in42' id='in42' value='มีความขัดแย้งและมีการใช้ความรุนแรงในครอบครัว'/>
                                            <label class='control-label'> มีความขัดแย้งและมีการใช้ความรุนแรงในครอบครัว</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in42' id='in42' value='ถูกทารุณ/ทำร้ายจากบุคคลในครอบครัว/เพื่อนบ้าน'/>
                                            <label class='control-label'>ถูกทารุณ/ทำร้ายจากบุคคลในครอบครัว/เพื่อนบ้าน</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in42' id='in42' value='ถูกล่วงละเมิดทางเพศ'/>
                                            <label class='control-label'>ถูกล่วงละเมิดทางเพศ </label>
                                        </div>
                                        <div class='col-md-12 form-group'>
                                            <input type='checkbox' name='in42' id='in42' value='เล่นการพนัน'/>
                                            <label class='control-label'>เล่นการพนัน </label>
                                        </div>

                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๔.๓ ระยะทางระหว่างบ้านไปโรงเรียน(ไป/กลับ) หน่วยเป็นกิโลเมตร</h4>
                                    <span style='float: left;'>
                                        <input type='number' class='form-control' id='in431' name='in431'/>
                                    </span>
                                    <h4 style='float: left;margin-right:10px;'>ใช้เวลาเดินทาง</h4>
                                    <span style='float: left;'>
                                        <input type='time' class='form-control' id='in432' name='in432'/>
                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๔.๓.๑ การเดินทางของนักเรียนไปโรงเรียน (ตอบเพียง 1 ข้อ)</h4>
                                    <span style='float: left;'>
                                        <div class='col-md-6 form-group'>
                                            <input type='radio' name='in433' id='in433' value='ผู้ปกครองมาส่ง'/>
                                            <label class='control-label'>ผู้ปกครองมาส่ง</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='radio' name='in433' id='in433' value='รถโดยสารประจำทาง'/>
                                            <label class='control-label'>รถโดยสารประจำทาง </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='radio' name='in433' id='in433' value='รถจักรยานยนต์'/>
                                            <label class='control-label'>รถจักรยานยนต์</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='radio' name='in433' id='in433' value='รถโรงเรียน'/>
                                            <label class='control-label'>รถโรงเรียน</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='radio' name='in433' id='in433' value='รถยนต์'/>
                                            <label class='control-label'>รถยนต์ </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='radio' name='in433' id='in433' value='รถจักรยาน'/>
                                            <label class='control-label'>รถจักรยาน </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='radio' name='in433' id='in433' value='เดิน'/>
                                            <label class='control-label'>เดิน </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='radio' name='in433' id='in433' value='อื่นๆ'/>
                                            <label class='control-label'>อื่นๆ </label>
                                        </div>
                                    </span>
                                </div>

                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๔.๔ สภาพที่อยู่อาศัย ดังนี้ </h4>
                                    <span style='float: left;'>
                                        <div class='col-md-12 form-group'>
                                            <input type='checkbox' name='in44' id='in44' value='สภาพบ้านชำรุดทรุดโทรม หรือ บ้านทำจากวัสดุพื้นบ้าน เช่น ไม้ไผ่ ใบจากหรือวัสดุเหลือใช้'/>
                                            <label class='control-label'>สภาพบ้านชำรุดทรุดโทรม หรือ บ้านทำจากวัสดุพื้นบ้าน เช่น ไม้ไผ่ ใบจากหรือวัสดุเหลือใช้</label>
                                        </div>
                                        <div class='col-md-12 form-group'>
                                            <input type='checkbox' name='in44' id='in44' value='ไม่มีห้องส้วมในที่อยู่อาศัยและบริเวณ'/>
                                            <label class='control-label'>ไม่มีห้องส้วมในที่อยู่อาศัยและบริเวณ </label>
                                        </div>

                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๔.๕ ภาระงานความรับผิดชอบของนักเรียนที่มีต่อครอบครัว </h4>
                                    <span style='float: left;'>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in45' id='in45' value='ช่วยงานบ้าน'/>
                                            <label class='control-label'>ช่วยงานบ้าน</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in45' id='in45' value='ช่วยขายของเล็กๆน้อยๆ'/>
                                            <label class='control-label'>ช่วยขายของเล็กๆน้อยๆ</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in45' id='in45' value='ช่วยงานในนาในไร่'/>
                                            <label class='control-label'>ช่วยงานในนาในไร่</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in45' id='in45' value='ช่วยดูแลคนเจ็บป๋วย/พิการ'/>
                                            <label class='control-label'>ช่วยดูแลคนเจ็บป๋วย/พิการ </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in45' id='in45' value='ทำงานแถวบ้าน'/>
                                            <label class='control-label'>ทำงานแถวบ้าน</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in45' id='in45' value='อื่นๆ'/>
                                            <label class='control-label'>อื่นๆ</label>
                                        </div>
                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๔.๖ กิจกรรมยามว่างหรืองานอดิเรก </h4>
                                    <span style='float: left;'>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in46' id='in46' value='ดูทีวี/ฟังเพลง'/>
                                            <label class='control-label'>ดูทีวี/ฟังเพลง</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in46' id='in46' value='ไปเที่ยวห้าง/ดูหนัง'/>
                                            <label class='control-label'>ไปเที่ยวห้าง/ดูหนัง </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in46' id='in46' value='อ่านหนังสือ'/>
                                            <label class='control-label'>อ่านหนังสือ </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in46' id='in46' value='ไปหาเพื่อน/เพื่อน'/>
                                            <label class='control-label'>ไปหาเพื่อน/เพื่อน </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in46' id='in46' value='แว้น/สก๊อย'/>
                                            <label class='control-label'>แว้น/สก๊อย </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in46' id='in46' value='เล่นเกม คอม/มือถือ'/>
                                            <label class='control-label'>เล่นเกม คอม/มือถือ </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in46' id='in46' value='ไปสวนสาธารณะ'/>
                                            <label class='control-label'>ไปสวนสาธารณะ</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in46' id='in46' value='ไปร้านสนุกเกอร์'/>
                                            <label class='control-label'>ไปร้านสนุกเกอร์ </label>
                                        </div>
                                        <div class='col-md-12 form-group'>
                                            <input type='checkbox' name='in46' id='in46' value='อื่นๆ'/>
                                            <label class='control-label'>อื่นๆ</label>
                                        </div>
                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๔.๗ พฤติกรรมการใช้สารเสพติด </h4>
                                    <span style='float: left;'>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in47' id='in47' value='คบเพื่อนในกลุ่มที่ใช้สารเสพติด'/>
                                            <label class='control-label'>คบเพื่อนในกลุ่มที่ใช้สารเสพติด</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in47' id='in47' value='สมาชิกในครอบครัวข้องเกี่ยวกับยาเสพติด'/>
                                            <label class='control-label'>สมาชิกในครอบครัวข้องเกี่ยวกับยาเสพติด </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in47' id='in47' value='อยู่ในสภาพแวดดล้อมที่ใช้สารเสพติด'/>
                                            <label class='control-label'>อยู่ในสภาพแวดดล้อมที่ใช้สารเสพติด </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in47' id='in47' value='ปัจจุบันเกี่ยวข้องกับสารเสพติด'/>
                                            <label class='control-label'>ปัจจุบันเกี่ยวข้องกับสารเสพติด </label>
                                        </div>
                                        <div class='col-md-12 form-group'>
                                            <input type='checkbox' name='in47' id='in47' value='เป็นผู้ติดบุหรี่ สุรา หรือการใช้สารเสพติดอื่นๆ'/>
                                            <label class='control-label'>เป็นผู้ติดบุหรี่ สุรา หรือการใช้สารเสพติดอื่นๆ </label>
                                        </div>
                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๔.๘ พฤติกรรมการใช้ความรุนแรง </h4>
                                    <span style='float: left;'>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in48' id='in48' value='มีการทะเลาะวิวาท'/>
                                            <label class='control-label'>มีการทะเลาะวิวาท </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in48' id='in48' value='ก้าวร้าว เกเร'/>
                                            <label class='control-label'>ก้าวร้าว เกเร </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in48' id='in48' value='ทะเลาะวิวาทเป็นประจำ'/>
                                            <label class='control-label'>ทะเลาะวิวาทเป็นประจำ </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in48' id='in48' value='ทำร้ายร่างกายผู้อื่น'/>
                                            <label class='control-label'>ทำร้ายร่างกายผู้อื่น</label>
                                        </div>
                                        <div class='col-md-12 form-group'>
                                            <input type='checkbox' name='in48' id='in48' value='ทำร้ายร่างกายตนเอง'/>
                                            <label class='control-label'>ทำร้ายร่างกายตนเอง</label>
                                        </div>
                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๔.๙ พฤติกรรมทางเพศ </h4>
                                    <span style='float: left;'>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in49' id='in49' value='อยู่ในกลุ่มขายบริการ'/>
                                            <label class='control-label'>อยู่ในกลุ่มขายบริการ</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in49' id='in49' value='ใช้เครื่องมือสื่อสารที่เกี่ยวข้องกับด้านเพศเป็นเวลานานและบ่อยครั้ง'/>
                                            <label class='control-label'>ใช้เครื่องมือสื่อสารที่เกี่ยวข้องกับด้านเพศเป็นเวลานานและบ่อยครั้ง</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in49' id='in49' value='ตั้งครรภ์'/>
                                            <label class='control-label'>ตั้งครรภ์</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in49' id='in49' value='ขายบริการทางเพศ'/>
                                            <label class='control-label'>ขายบริการทางเพศ</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in49' id='in49' value='หมกมุ่นในการใช้เครื่องมือสื่อสารที่เกี่ยวข้องทางเพศ'/>
                                            <label class='control-label'>หมกมุ่นในการใช้เครื่องมือสื่อสารที่เกี่ยวข้องทางเพศ</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in49' id='in49' value='มีการมั่วสุมทางเพศ'/>
                                            <label class='control-label'>มีการมั่วสุมทางเพศ</label>
                                        </div>

                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๔.๑๐ การติดเกม </h4>
                                    <span style='float: left;'>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in410' id='in410' value='เล่นเกมเกินวันละ 1 ชั่วโมง'/>
                                            <label class='control-label'>เล่นเกมเกินวันละ 1 ชั่วโมง</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in410' id='in410' value='ขาดจินตนาการและความคิดสร้างสรรค์'/>
                                            <label class='control-label'>ขาดจินตนาการและความคิดสร้างสรรค์ </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in410' id='in410' value='เก็บตัว แยกตัวจากลุ่มเพื่อน'/>
                                            <label class='control-label'>เก็บตัว แยกตัวจากลุ่มเพื่อน </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in410' id='in410' value='ใช้จ่ายเงินผิดปกติ'/>
                                            <label class='control-label'>ใช้จ่ายเงินผิดปกติ</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in410' id='in410' value='อยู่ในกลุ่มเพื่อนเล่นเกม'/>
                                            <label class='control-label'>อยู่ในกลุ่มเพื่อนเล่นเกม</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in410' id='in410' value='ร้านเกมอยู่ใกล้บ้านหรือโรงเรียน'/>
                                            <label class='control-label'>ร้านเกมอยู่ใกล้บ้านหรือโรงเรียน </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in410' id='in410' value='ใช้เวลาเล่นเกมเกิน 2 ชั่วโมง'/>
                                            <label class='control-label'>ใช้เวลาเล่นเกมเกิน 2 ชั่วโมง</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in410' id='in410' value='หมกมุ่น จริงจังในการเล่นเกม'/>
                                            <label class='control-label'>หมกมุ่น จริงจังในการเล่นเกม</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in410' id='in410' value='ใช้เงินสิ้นเปลือง โกหก ลักขโมยเงินเพื่อเล่นเกม'/>
                                            <label class='control-label'>ใช้เงินสิ้นเปลือง โกหก ลักขโมยเงินเพื่อเล่นเกม</label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in410' id='in410' value='อื่นๆ'/>
                                            <label class='control-label'>อื่นๆ</label>
                                        </div>

                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๔.๑๑ การเข้าถึงสื่อคอมพิวเตอร์และอินเตอร์เน็ตที่บ้าน </h4>
                                    <span style='float: left;'>
                                        <div class='col-md-12 form-group'>
                                            <input type='checkbox' name='in411' id='in411' value='สามารถเข้าถึง Internet ได้จากที่บ้าน'/>
                                            <label class='control-label'>สามารถเข้าถึง Internet ได้จากที่บ้าน</label>
                                        </div>
                                        <div class='col-md-12 form-group'>
                                            <input type='checkbox' name='in411' id='in411' value='ไม่สามารถเข้าถึง Internet ได้จากที่บ้าน'/>
                                            <label class='control-label'>ไม่สามารถเข้าถึง Internet ได้จากที่บ้าน </label>
                                        </div>

                                    </span>
                                </div>
                                <div class='col-md-11 col-md-offset-1'>
                                    <h4 style='float: left;margin-right:10px;'>๔.๑๒ การใช้เครื่องมือสื่อสารอิเล็กทรอนิกส์ </h4>
                                    <span style='float: left;'>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in412' id='in412' value='เคยใช้โทรศัพท์มือถือในระหว่างการเรียน'/>
                                            <label class='control-label'>เคยใช้โทรศัพท์มือถือในระหว่างการเรียน </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in412' id='in412' value='เข้าใช้ line, Facebook, twitter หรือ chat (เกินวันละ 1 ชั่วโมง)'/>
                                            <label class='control-label'>เข้าใช้ line, Facebook, twitter หรือ chat (เกินวันละ 1 ชั่วโมง) </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in412' id='in412' value='ใช้โทรศัพท์มือถือในระหว่างเรียน 2 - 3/วัน'/>
                                            <label class='control-label'>ใช้โทรศัพท์มือถือในระหว่างเรียน 2 - 3/วัน </label>
                                        </div>
                                        <div class='col-md-6 form-group'>
                                            <input type='checkbox' name='in412' id='in412' value='เข้าใช้ line, Facebook, twitter หรือ chat (เกินวันละ 2 ชั่วโมง)'/>
                                            <label class='control-label'>เข้าใช้ line, Facebook, twitter หรือ chat (เกินวันละ 2 ชั่วโมง) </label>
                                        </div>

                                    </span>
                                </div>
                            </div>
                        </div>
                        <div id='For5'>
                            <div class='col-md-12'>
                                <legend>ผู้ให้ข้อมูลนักเรียน</legend>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='บิดา'/>
                                    <label class='control-label'>บิดา</label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='มารดา'/>
                                    <label class='control-label'>มารดา </label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='พี่ชาย'/>
                                    <label class='control-label'> พี่ชาย</label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='พี่สาว'/>
                                    <label class='control-label'>พี่สาว </label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='น้า'/>
                                    <label class='control-label'>น้า </label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='อา'/>
                                    <label class='control-label'> อา</label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='ป้า'/>
                                    <label class='control-label'>ป้า </label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='ลุง'/>
                                    <label class='control-label'>ลุง</label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='ปู่'/>
                                    <label class='control-label'> ปู่</label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='ย่า'/>
                                    <label class='control-label'>ย่า </label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='ตา'/>
                                    <label class='control-label'>ตา</label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='ยาย'/>
                                    <label class='control-label'>ยาย</label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='ทวด'/>
                                    <label class='control-label'>ทวด </label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='พ่อเลี้ยง'/>
                                    <label class='control-label'> พ่อเลี้ยง</label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='แม่เลี้ยง'/>
                                    <label class='control-label'>แม่เลี้ยง </label>
                                </div>
                                <div class='col-md-3 form-group'>
                                    <input type='radio' name='inVhReporter' id='inVhReporter' value='อื่นๆ'/>
                                    <label class='control-label'>อื่นๆ</label>
                                </div>
                            </div>

                        </div>
                        <div id='For6'>
                            <div class='col-md-12'>
                                <legend>รูปภาพ/ภาพถ่ายประกอบการเยี่ยมบ้านนักเรียน</legend>
                                <h4>กรุณาระบุ ภาพถ่ายที่แนบมา คือ</h4>
                                <div class='col-md-12 form-group'>
                                    <input type='radio' name='inVhAtt' id='inVhAtt' value='บ้านที่พักอาศัยอยู่กับพ่อแม่ (เป็นเจ้าของ/เช่า)'/>
                                    <label class='control-label'>บ้านที่พักอาศัยอยู่กับพ่อแม่ (เป็นเจ้าของ/เช่า)</label>
                                </div>
                                <div class='col-md-12 form-group'>
                                    <input type='radio' name='inVhAtt' id='inVhAtt' value='บ้านของญาติ/ผู้ปกครองที่ไม่ใช่ญาติ'/>
                                    <label class='control-label'>บ้านของญาติ/ผู้ปกครองที่ไม่ใช่ญาติ</label>
                                </div>
                                <div class='col-md-12 form-group'>
                                    <input type='radio' name='inVhAtt' id='inVhAtt' value=''/>
                                    <label class='control-label'>บ้านหรือที่พักประเภท วัด มูลนิธิ หอพัก โรงงาน อยู่กับนายจ้าง</label>
                                </div>
                                <div class='col-md-12 form-group'>
                                    <input type='radio' name='inVhAtt' id='inVhAtt' />
                                    <label class='control-label'>ภาพนักเรียนและป้ายชื่อโรงเรียนเนื่องจากถ่ายภาพบ้านไม่ได้ เพราะบ้านอยู่ต่างอำเภอ/ ต่างจังหวัด/ต่างประเทศ หรือไม่ได้รับอนุญาตให้ถ่ายภาพ</label>
                                </div>
                                <div class='col-md-6' align='center'>

                                    <center>
                                        <h5>รูปชุดที่ ๑ ภาพถ่ายสภาพบ้านนักเรียน</h5>                             
                                        <input type="file" class='filestyle' multiple name="inVhImage1[]" id="inVhImage1[]"/>

                                    </center>
                                </div>
                                <div class='col-md-6' align='center'>
                                    <center>
                                        <h5>รูปชุดที่ ๒ ภาพถ่ายสภาพในบ้านนักเรียน</h5>                             
                                        <input type="file" class='filestyle' multiple name="inVhImage2[]" id="inVhImage2[]"  />
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-12' style='margin-top:25px;'>
                            <center><button type="button" class="btn btn-success btn-insert"><i class="icon-save icon-large"></i> บันทึก</button></center>
                        </div>
                    </div>
                    <input type='hidden' name='StdId' id='StdId' class='form-control' readonly />
                </form>

            </div>

        </div>
    </div>
</div>

<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});
    $(".btn-insert").on("click", function (e) {
//        alert('A');
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url('Homeroom/hr_homeroom_vh_insert_cl'); ?>",
            method: "post",
            data: new FormData($("#vh-insert-new-form")[0]),
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                MyStartLoading();
            }, success: function (data) {
                MyEndLoading();
                alert("บันทึกข้อมูลสำเร็จ");
                $("#vh-insert-new-form")[0].reset();
                location.reload();
            }
        });
    });
</script>
