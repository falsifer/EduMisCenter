<!-- Modal -->
<div id="visit-home-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title">บันทึกข้อมูลการเยี่ยมบ้านนักเรียน <?php echo $this->session->userdata('department') ?></h3>
            </div>
            <div class="modal-body" style="padding:30px;">

                <div class='row'>
<!--                    <div class='col-md-12'>
                        <h3 style='text-align:center'><b></b></h3>

                        <h4 style='text-align:left'><b>คำชี้แจงการตอบแบบสอบถาม</b></h4>
                        <h4 style='text-align:left'>หากเป็นตัวเลือก&nbsp;<input type='radio'>&nbsp;หมายถึง ให้ตอบเพียงข้อเดียว</h4>
                        <h4 style='text-align:left'>หากเป็นตัวเลือก&nbsp;<input type='checkbox'>&nbsp;หมายถึง ให้ตอบได้มากกว่า ๑ ข้อ</h4>
                    </div>-->


                    <div class='col-md-12 form-group'>
                        <legend>ข้อมูลส่วนตัวนักเรียน</legend>
                        <div class='col-md-3' style='margin-top:20px;'>
                            <center>
                                <img src='<?php echo base_url(). hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')).'f90095bbb85ba7830d9e618a84f38030.png' ?>' class='' style='width: 190px;height: 190px;' />
                            </center>
                        </div>
                        <div class='col-md-9'>

                            <div class='col-md-3'>
                                <label class='control-label'>คำนำหน้า</label>
                                <input type='text' name='inHrThaiSymbol' id='inHrThaiSymbol' class='form-control' required />
                            </div>
                            <div class='col-md-5 form-group'>
                                <label class='control-label'>ชื่อ (ภาษาไทย)</label>
                                <input type='text' name='inHrThaiName' id='inHrThaiName' class='form-control' required />
                            </div>
                            <div class='col-md-4 form-group'>
                                <label class='control-label'>นามสกุล (ภาษาไทย)</label>
                                <input type='text' name='inHrThaiLastname' id='inHrThaiLastname' class='form-control' required />
                            </div>

                            <div class='col-md-3'>
                                <label class='control-label'>ชั้น</label>
                                <input type='text' name='class' id='class' class='form-control' required />
                            </div>
                            <div class='col-md-5 form-group'>
                                <label class='control-label'>เลขบัตรประจำตัวประชาชน</label>
                                <input type='text' name='id_card' id='id_card' class='form-control' required />
                            </div>
                            <div class='col-md-4 form-group'>
                                <label class='control-label'>หมู่บ้าน</label>
                                <input type='text' name='village' id='village' class='form-control' required />
                            </div>


                            <div class='col-md-3'>
                                <label class='control-label'>ชื่อเล่นนักเรียน</label>
                                <input type='text' name='nickname' id='nickname' class='form-control' required />
                            </div>
                            <div class='col-md-5 form-group'>
                                <label class='control-label'>เลขประจำตัวนักเรียน</label>
                                <input type='text' name='student_id' id='student_id' class='form-control' required />
                            </div>
                            <div class='col-md-4 form-group'>
                                <label class='control-label'>เบอร์โทรศัพท์</label>
                                <input type='text' name='student_id' id='student_id' class='form-control' required />
                            </div>
                        </div>


                    </div>


                    <div class='col-md-12'>
                        <h4>๒. ชื่อผู้ปกครองนักเรียน</h4>
                    </div>
                    <div class='row'>
                        <div class='col-md-2 from-group'>
                            <label class='control-label'>คำนำหน้า</label>
                            <input type='text' name='inHrThaiSymbol' id='inHrThaiSymbol' class='form-control' required />
                        </div>
                        <div class='col-md-4 form-group'>
                            <label class='control-label'>ชื่อ (ภาษาไทย)</label>
                            <input type='text' name='inHrThaiName' id='inHrThaiName' class='form-control' required />
                        </div>
                        <div class='col-md-4 form-group'>
                            <label class='control-label'>นามสกุล (ภาษาไทย)</label>
                            <input type='text' name='inHrThaiLastname' id='inHrThaiLastname' class='form-control' required />
                        </div>
                        <div class='col-md-2 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>ไม่มีผู้ปกครอง</label>
                        </div>

                        <div class='col-md-4 from-group'>
                            <label class='control-label'>ความสัมพันธ์ของผู้ปกครองกับนักเรียน</label>
                            <input type='text' name='inHrThaiSymbol' id='inHrThaiSymbol' class='form-control' required />
                        </div>
                        <div class='col-md-4 form-group'>
                            <label class='control-label'>อาชีพ</label>
                            <input type='text' name='inHrThaiName' id='inHrThaiName' class='form-control' required />
                        </div>
                        <div class='col-md-4 form-group'>
                            <label class='control-label'>รายได้/เดือน</label>
                            <input type='text' name='inHrThaiLastname' id='inHrThaiLastname' class='form-control' required />
                        </div>


                        <div class='col-md-4 from-group'>
                            <label class='control-label'>เบอร์โทรศัพท์</label>
                            <input type='text' name='inHrThaiSymbol' id='inHrThaiSymbol' class='form-control' required />
                        </div>
                        <div class='col-md-4 form-group'>
                            <label class='control-label'>จบการศึกษาสูงสุด</label>
                            <input type='text' name='inHrThaiName' id='inHrThaiName' class='form-control' required />
                        </div>
                        <div class='col-md-4 form-group'>
                            <label class='control-label'>เลขที่บัตรประชาชน</label>
                            <input type='text' name='inHrThaiLastname' id='inHrThaiLastname' class='form-control' required />
                        </div>

                        <div class='col-md-4 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>ไม่มีบัตรประชาชน</label>
                        </div>
                        <div class='col-md-8 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>มีบัตรสวัสดการของรัฐ บัตรผู้มีรายได้นอย ได้รับเงิน................./เดือน</label>
                        </div>
                    </div>



                    <div class='col-md-12'>
                        <h4>๓. ความสัมพันธ์ในครอบครัว</h4>
                    </div>
                    <div class='col-md-11 col-md-push-1'>
                        <h4>๓.๑ ความสัมพันธ์ระหว่างนักเรียนกับสมาชิกในครอบครัว</h4>
                        <table border='1' align='center'>
                            <tr align='center'>
                                <td>สมาชิก</td>
                                <td>สนิทสนม</td>
                                <td>เฉยๆ</td>
                                <td>ห่างเหิน</td>
                                <td>ขัดแย้ง</td>
                                <td>ไม่มี</td>
                            </tr>

                            <tr>
                                <td>บิดา</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>มารดา</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>พี่ชาย/น้องชาย</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>พี่สาว/น้องสาว</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>ปู่/ย่า/ตา/ยาย</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>ญาติ</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>อื่นๆ .....................</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                        <br>


                        <div class='col-md-12'>
                            <h4>๓.๒ สมาชิกในครอบครัวมีเวลาอยู่ร่วมกันกี่ชั่วโมงต่อวัน............................................ชั่วโมง/วัน </h4>
                            <p>
                            <h4>๓.๓ กรณีที่ผู้ปกครองไม่อยู่บ้านฝากเด็กนักเรียนอยู่บ้านกับใคร (ตอบเพียง ๑ ข้อ) </h4>
                            </p>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>ญาติ</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>เพื่อนบ้าน</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>นักเรียนอยู่บ้านด้วยตนเอง</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>อื่นๆ ระบุ..............................</label>
                        </div>


                        <div class='col-md-12'>
                            <h4>๓.๔ รายได้ครัวเรือนเฉลี่ยต่อคน (รวมรายได้ครัวเรือน หารด้วยจำนวนสมาชิกทั้งหมด)...........................บาท </h4>
                            <h4>๓.๕ นักเรียนได้รับค่าใช้จ่ายจาก........................ นักเรียนได้เงินมาโรงเรียนวันละ..................บาท </h4>
                            <h4>๓.๖ สิ่งที่ผู้ปกครองต้องการให้โรงเรียนช่วยเหลือนักเรียน </h4>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ด้านการเรียน</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ด้านพฤติกรรม</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ด้านเศรษฐกิจ เช่น ขอรับทุน</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>อื่นๆ ระบุ..............................</label>
                        </div>

                        <div class='col-md-12'>
                            <h4>๓.๗ ความช่วยเหลือที่ครอบครัวเคยได้รับจากหน่วยงานหรือต้องการได้รับการช่วยเหลือ </h4>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>เบี้ยผู้สูงอายุ</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>เบี้ยพิการ</label>
                        </div>
                        <div class='col-md-12 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>อื่นๆ ระบุ..............................</label>
                        </div>

                        <div class='col-md-12'>
                            <h4>๓.๘ ข้อห่วงใยของผู้ปกครองที่มีต่อนักเรียน </h4>
                        </div>
                        <textarea class='textarea' width='100%' height='100px'>
                        </textarea>
                    </div>


                    <div class='col-md-12'>
                        <h4>๔. พฤติกรรมและความเสี่ยง </h4>
                    </div>
                    <div class='col-md-11 col-md-push-1'>
                        <h4>๔.๑ พฤติกรรมและความเสี่ยง </h4>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ร่างกายไม่แข็งแรง</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>มีโรคประจำตัวหรือเจ็บป่วยบ่อย</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>มีภาวะทุพโภชนาการ</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ป๋วยเป็นโรคร้ายแรงเรื้อรัง</label>
                        </div>
                        <div class='col-md-12 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>สมรรถภาพทางร่างกายต่ำ</label>
                        </div>

                        <h4>๔.๒ สวัสดิการหรือความปลอดภัย </h4>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>พ่อแม่แยกทางกัน หรือแต่งงานใหม่</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ที่พักอาศัยอยู่ในชุมชนแออัดหรือใกล้แหล่งมั่วสุม/สถานเริงรมย์ </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'> มีบุคคลในครอบครัวเจ็บป่วยด้วยโรคร้ายแรง/เรื้อรัง/ติดต่อ</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>บุคคลในครอบครัวติดสารเสพติด</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>บุคคลในครอบครัวเล่นการพนัน </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>มีความขัดแย้ง/ทะเลาะกันในครอบครัว </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'> ไม่มีผู้ดูแล </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'> มีความขัดแย้งและมีการใช้ความรุนแรงในครอบครัว</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ถูกทารุณ/ทำร้ายจากบุคคลในครอบครัว/เพื่อนบ้าน</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ถูกล่วงละเมิดทางเพศ </label>
                        </div>
                        <div class='col-md-12 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>เล่นการพนัน </label>
                        </div>

                        <p>
                        <h4>๔.๓ ระยะทางระหว่างบ้านไปโรงเรียน(ไป/กลับ)..........................กิโลเมตร ใช้เวลาเดินทาง..........................ชม...........................นาที
                            </p>
                        </h4>
                        <p>
                        <h4>การเดินทางของนักเรียนไปโรงเรียน (ตอบเพียง 1 ข้อ)
                            </p>
                        </h4>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ผู้ปกครองมาส่ง</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>รถโดยสารประจำทาง </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>รถจักรยานยนต์</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>รถโรงเรียน</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>รถยนต์ </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>รถจักรยาน </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>เดิน </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'> อื่นๆ .................................. </label>
                        </div>

                        <h4>๔.๔ สภาพที่อยู่อาศัย ดังนี้ </h4>
                        <div class='col-md-12 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>สภาพบ้านชำรุดทรุดโทรม หรือ บ้านทำจากวัสดุพื้นบ้าน เช่น ไม้ไผ่ ใบจากหรือวัสดุเหลือใช้</label>
                        </div>
                        <div class='col-md-12 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ไม่มีห้องส้วมในที่อยู่อาศัยและบริเวณ </label>
                        </div>


                        <h4>๔.๕ ภาระงานความรับผิดชอบของนักเรียนที่มีต่อครอบครัว </h4>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ช่วยงานบ้าน</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ช่วยขายของเล็กๆน้อยๆ</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ช่วยงานในนาในไร่</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ช่วยดูแลคนเจ็บป๋วย/พิการ </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ทำงานแถวบ้าน</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>อื่นๆ .................................. </label>
                        </div>


                        <h4>๔.๖ กิจกรรมยามว่างหรืองานอดิเรก </h4>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ดูทีวี / ฟังเพลง</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ไปเที่ยวห้าง / ดูหนัง </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>อ่านหนังสือ </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ไปหาเพื่อน / เพื่อน </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>แว้น / สก๊อย </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>เล่นเกม คอม / มือถือ </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ไปสวนสาธารณะ</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ไปร้านสนุกเกอร์ </label>
                        </div>
                        <div class='col-md-12 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>อื่นๆ .................................. </label>
                        </div>


                        <h4>๔.๗ พฤติกรรมการใช้สารเสพติด </h4>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>คบเพื่อนในกลุ่มที่ใช้สารเสพติด</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>สมาชิกในครอบครัวข้องเกี่ยวกับยาเสพติด </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>อยู่ในสภาพแวดดล้อมที่ใช้สารเสพติด </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ปัจจุบันเกี่ยวข้องกับสารเสพติด </label>
                        </div>
                        <div class='col-md-12 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>เป็นผู้ติดบุหรี่ สุรา หรือการใช้สารเสพติดอื่นๆ </label>
                        </div>


                        <h4>๔.๘ พฤติกรรมการใช้ความรุนแรง </h4>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>มีการทะเลาะวิวาท </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ก้าวร้าว เกเร </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ทะเลาะวิวาทเป็นประจำ </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ทำร้ายร่างกายผู้อื่น</label>
                        </div>
                        <div class='col-md-12 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ทำร้ายร่างกายตนเอง</label>
                        </div>


                        <h4>๔.๙ พฤติกรรมทางเพศ </h4>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>อยู่ในกลุ่มขายบริการ</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ใช้เครื่องมือสื่อสารที่เกี่ยวข้องกับด้านเพศเป็นเวลานานและบ่อยครั้ง</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ตั้งครรภ์</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ขายบริการทางเพศ</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>หมกมุ่นในการใช้เครื่องมือสื่อสารที่เกี่ยวข้องทางเพศ</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>มีการมั่วสุมทางเพศ</label>
                        </div>


                        <h4>๔.๑๐ การติดเกม </h4>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>เล่นเกมเกินวันละ 1 ชั่วโมง</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ขาดจินตนาการและความคิดสร้างสรรค์ </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>เก็บตัว แยกตัวจากลุ่มเพื่อน </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ใช้จ่ายเงินผิดปกติ</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>อยู่ในกลุ่มเพื่อนเล่นเกม</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ร้านเกมอยู่ใกล้บ้านหรือโรงเรียน </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ใช้เวลาเล่นเกมเกิน 2 ชั่วโมง</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>หมกมุ่น จริงจังในการเล่นเกม</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ใช้เงินสิ้นเปลือง โกหก ลักขโมยเงินเพื่อเล่นเกม</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>อื่นๆ..........................................</label>
                        </div>

                        <h4>๔.๑๑ การเข้าถึงสื่อคอมพิวเตอร์และอินเตอร์เน็ตที่บ้าน </h4>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>สามารถเข้าถึง Internet ได้จากที่บ้าน</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ไม่สามารถเข้าถึง Internet ได้จากที่บ้าน </label>
                        </div>

                        <h4>๔.๑๒ การใช้เครื่องมือสื่อสารอิเล็กทรอนิกส์ </h4>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>เคยใช้โทรศัพท์มือถือในระหว่างการเรียน </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>เข้าใช้ line, Facebook, twitter หรือ chat (เกินวันละ 1 ชั่วโมง) </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>ใช้โทรศัพท์มือถือในระหว่างเรียน 2 - 3/วัน </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='checkbox' name='no_human' id='no_human' />
                            <label class='control-label'>เข้าใช้ line, Facebook, twitter หรือ chat (เกินวันละ 2 ชั่วโมง) </label>
                        </div>


                        <h4><b>ผู้ให้ข้อมูลนักเรียน</b></h4>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>บิดา</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>มารดา </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'> พี่ชาย</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>พี่สาว </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>น้า </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'> อา</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>ป้า </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>ลุง</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'> ปู่</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>ย่า </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>ตา</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>ยาย</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>ทวด </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'> พ่อเลี้ยง</label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>แม่เลี้ยง </label>
                        </div>
                        <div class='col-md-6 form-group'>
                            <input type='radio' name='no_human' id='no_human' />
                            <label class='control-label'>อื่นๆ..................... </label>
                        </div>
                    </div>


                    <div class='col-md-12 form-group' align='right'>
                        <p><label class='control-label'>ขอรับรองว่าข้อมูลดังกล่าวเป็นจริง</label></p>
                        <p><label class='control-label'>ลงชื่อผู้ปกครอง/ผู้แทน.......................................................</label></p>
                        <p><label class='control-label'>(.......................................................)</label></p>
                    </div>





                    <div class='col-md-12' align='center'>
                        <h4><b>ภาพถ่ายบ้านนักเรียนที่ได้รับการเยี่ยมบ้าน</b></h4>
                        <h4>ชื่อ-นามสกุลนักเรียน..................................................................................</h4>
                    </div>



                    <div class='col-md-3 form-group'>
                        <label class='control-label'>กรุณาระบุ ภาพถ่ายที่แนบมา คือ</label>
                    </div>
                    <div class='col-md-9 form-group'>
                        <select>
                            <option value='volvo'>บ้านที่พักอาศัยอยู่กับพ่อแม่ (เป็นเจ้าของ/เช่า) </option>
                            <option value='saab'>บ้านของญาติ/ผู้ปกครองที่ไม่ใช่ญาติ</option>
                            <option value='mercedes'>บ้านหรือที่พักประเภท วัด มูลนิธิ หอพัก โรงงาน อยู่กับนายจ้าง</option>
                            <option value='audi'>ภาพนักเรียนและป้ายชื่อโรงเรียนเนื่องจากถ่ายภาพบ้านไม่ได้ เพราะบ้านอยู่ต่างอำเภอ/ ต่างจังหวัด/ต่างประเทศ หรือไม่ได้รับอนุญาตให้ถ่ายภาพ </option>
                        </select>
                    </div>


                    <div class='col-md-12' align='center'>
                        <h5>รูปที่ ๑ ภาพถ่ายสภาพบ้านนักเรียน</h5>
                        <img src='2.jpg ' style='width: 300px;height: 200px;'>
                        <br>
                        <br>
                        <h5>รูปที่ ๒ ภาพถ่ายสภาพในบ้านนักเรียน</h5>
                        <img src='3.jpg ' style='width: 300px;height: 200px;'>
                        <br>
                        <br>
                        <br>

                        <h5><b>ขอรับรองว่าข้อมูลและภาพถ่ายของนักเรียนเป็นความจริง</b></h5>
                        <h5>ลงชื่อ...................................................................</h5>
                        <h5>(.............................................................................)</h5>


                        <h5>ตำแหน่ง...................................................................(ครูหรือผู้อำนวยการโรงเรียน)</h5>
                        <h5>วันที่.................เดือน.......................พ.ศ............................</h5>
                        <br>
                        <div align='left'>
                            <h6><b>หมายเหตุ: กรณีนักเรียนที่ขอรับเงินอุดหนุนปัจจัยพื้นฐานนักเรียนยากจน สามารถใช้ภาพถ่ายบ้านชุดเดียวกันได้ </b></h6>
                        </div>

                    </div>


                </div>

            </div>

        </div>
    </div>
</div>

<script>
    $(".datepicker").datepicker({autoclose: true, language: 'th-th'});


</script>
