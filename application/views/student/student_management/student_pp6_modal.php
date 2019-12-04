<!-- Modal -->
<div id="student-pp6-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content" >

            <?php
            $data['MyHeadTitle'] = 'เอกสาร ปพ.1';
            $this->load->view('layout/my_school_modal_header', $data);
            ?>             
            <?php
            $data['AreaID'] = 'PP6PrintArea';
            $this->load->view('layout/my_school_print', $data);
            ?>   
            <div class="modal-body"  >
                <div id="PP6PrintArea" style='border: solid 1px;'>
                    <div style='width:850px;height: 1323px;padding: 10px;' >
                        <!--<p style="text-align:right"><span>ปพ.6</span></p>-->
                        <center>
                            <!---->
                            <img src="<?php echo base_url() . 'upload/logo_20160330101350tV4B.png' ?>" style='width: 100px;height: 100px;margin: 0px;'/>
                            <p style="text-align:center;margin: 0px;"><span style="font-size:1em"><?php echo $this->session->userdata('department'); ?></span></p>
                        </center>
                        <p style='text-align:center;margin: 0px;'><span style='font-size:1em'>แบบรายงานผลการพัฒนาผู้เรียนรายบุคคล</span></p>
                        <p style='text-align:center;margin: 0px;'><span style='font-size:0.85em'>
                                ระดับชั้น <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>ประถมศึกษาปีที่ 6</span>
                                ปีการศึกษา <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>2562</span> 
                                เลขประจำตัวนักเรียน <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>44698</span>  
                                ชื่อ-ชื่อสกุล <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>นายชัยรัธฐา อ่วมอารีย์ </span>
                                ห้องที่ <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>1</span>
                                เลขที่ <span style='line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>10</span>
                            </span></p>
                        <hr/>
                        
                        <center>
                            <table class="table table-bordered display" style="width:90%;" id="example">
                                <thead>
                                    <tr style='height:50px;background: whitesmoke;'>                                    
                                        <th class='no-sort' style='width:5%;text-align: center;'>ที่</th>
                                        <th class='no-sort' style='width:10%;text-align: center;'>รหัสวิชา</th>
                                        <th class='no-sort' style='width:45%;text-align: center;'>รายวิชา</th>
                                        <th class='no-sort' style='width:10%;text-align: center;'>ประเภท</th>
                                        <th class='no-sort' style='width:10%;text-align: center;'>น้ำหนัก/เวลา</th>
                                        <th class='no-sort' style='width:10%;text-align: center;'>ผลการเรียน</th>
                                        <th class='no-sort' style='width:10%;text-align: center;'>หมายเหตุ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                        <tr style='height: 30px;'>
                                            <td style='width:5%;text-align: center;'><?php echo $i; ?></td> 
                                            <td style='width:10%;text-align: center;'>ท21121</td>  
                                            <td style='width:45%;text-align: center;'>ภาษาไทยเพื่อการสื่อสาร</td>  
                                            <td style='width:10%;text-align: center;'>เพิ่มเติม</td>  
                                            <td style='width:10%;text-align: center;'>1</td>  
                                            <td style='width:10%;text-align: center;'>3.5</td>  
                                            <td style='width:10%;text-align: center;'></td>  
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </center>
                        
                        <hr/>

                        <center>
                            <table class='table table-bordered display' style='width:40%;margin-left:10%;margin-right:50px;float: left;'>
                                <thead>
                                    <tr style='height:40px;background: whitesmoke;'>                                    
                                        <th style='width:100%;text-align: center;font-size: 1.1em;' colspan='2'>สรุปผลการประเมิน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style='height: 30px;'> 
                                        <td style='width:80%;text-align: center;'>น้ำหนักวิชาพื้นฐาน</td>  
                                        <td style='width:20%;text-align: center;'>25.0</td>  
                                    </tr>
                                    <tr style='height: 30px;'> 
                                        <td style='width:80%;text-align: center;'>น้ำหนักวิชาเพิ่มเติม</td>  
                                        <td style='width:20%;text-align: center;'>0.0</td>  
                                    </tr>
                                    <tr style='height: 30px;'> 
                                        <td style='width:80%;text-align: center;'>ระดับผลการเรียนเฉลี่ย</td>  
                                        <td style='width:20%;text-align: center;'>3.5</td>  
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr style='height:40px;background: whitesmoke;'>                                    
                                        <th style='width:100%;text-align: center;font-size: 1.1em;' colspan='2'>ประเมินคุณลักษณะอันพึงประสงค์</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style='height: 30px;'> 
                                        <td style='width:80%;text-align: center;'>คุณลักษณะอันพึงประสงค์ของสถานศึกษา</td>  
                                        <td style='width:20%;text-align: center;'>ดีเยี่ยม</td>  
                                    </tr>
                                    <tr style='height: 30px;'> 
                                        <td style='width:80%;text-align: center;'>การอ่าน คิดวิเคราะห์และเขียน</td>  
                                        <td style='width:20%;text-align: center;'>ดีเยี่ยม</td>  
                                    </tr>
                                    <tr style='height: 30px;'> 
                                        <td style='width:80%;text-align: center;'>กิจกรรมพัฒนาผู้เรียน</td>  
                                        <td style='width:20%;text-align: center;'>ผ่าน</td>  
                                    </tr>
                                </tbody>
                            </table>
                            <div style='width:30%;float: left;margin-right: 10%;'>
                                <img src="<?php echo base_url() . 'upload/aceee9f66a9c704cffdb43e90227581e.png' ?>" style='width: 120px;'/>
                                <p style="text-align:center;margin: 0px;">
                                    (<span style='font-size:0.9em;line-height:20px;border-bottom: 1px dashed #ccc;font-weight: bold;'>นายพงพสฟห คงนพรฟห</span>)
                                </p>
                                <p style="text-align:center;margin: 0px;">
                                    <span style='font-size:1em;'>ครูประจำชั้น</span>                                    
                                </p>
                                <br/>
                            </div>
                        </center>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
