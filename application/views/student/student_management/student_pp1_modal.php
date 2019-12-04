<!-- Modal -->
<div id="student-pp1-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:70%;">
        <div class="modal-content" >

            <?php
            $data['MyHeadTitle'] = 'เอกสาร ปพ.1';
            $this->load->view('layout/my_school_modal_header', $data);
            ?>             
            <?php
            $data['AreaID'] = 'PP1PrintArea';
            $this->load->view('layout/my_school_print', $data);
            ?>     

            <style>
                /*                .modal-body{
                                    height: 500px;
                                    overflow-y: auto;
                                }*/


                /*.school-row-title{font-size:0.8em;line-height:20px;}.school-row-content{font-size:0.9em;margin-left:20px;line-height:20px;border-bottom: 1px dashed #ccc;}*/

                .school-row-title{font-size:0.6em;line-height:20px;}
                .school-row-content{font-size:0.7em;margin-left:20px;line-height:20px;border-bottom: 1px dashed #ccc;}

                .textAlignVer{
                    display:block;
                    filter: flipv fliph;
                    -webkit-transform: rotate(-90deg); 
                    -moz-transform: rotate(-90deg); 
                    transform: rotate(-90deg); 
                    position:relative;
                    width:20px;
                    white-space:nowrap;
                    /*font-size:12px;*/
                    margin-bottom:10px;
                }

            </style>
            <div class="modal-body" style="padding:30px;" >
                <div class="container-fluid">
                    <div class="row">
                        <div id="PP1PrintArea" style='border: solid 1px;'>
                            <div style='width:850px;height: 1323px;padding: 10px;' >

                                <div class='row' style='margin-left:10px;'>                                
                                    <div style='width:100px;height:70px;float: left;'>
                                        <img src="<?php echo base_url() . 'images/krut.jpg' ?>" style='width: 50px;height: 50px;'/>
                                    </div>
                                    <div style='width:700px;height:70px;float: left;'>
                                        <b style='font-size:1em;' >ระเบียนแสดงผลการเรียนหลักสูตรแกนกลางการศึกษาขั้นพื้นฐาน ช่วงชั้นที่ ๓ มัธยมศึกษาปีที่ ๑-๓</b>
                                        <br/>
                                        <b>ปพ.๑ : ๓ ชุดที่..................เลขที่...................</b>
                                    </div>
                                </div>
                                <!--                            <div style='width:100%;margin-bottom:70px;'>
                                                                
                                                            </div>-->

                                <div style='width:100%;margin-bottom: 70px;'>

                                    <div style='width:37%;float: left'>
                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                โรงเรียน
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 69%;'>
                                                <b>วัดบางอ้อยช้าง</b>
                                            </div> 
                                        </div>                           
                                        <div style="clear:both;"></div>

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                สังกัด
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 73%;'>
                                                กองการศึกษา
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div>

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                ตำบล/แขวง
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 62%;'>
                                                บางกรวย
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div>

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                อำเภอ/เขต
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 63%;'>
                                                บางกรวย
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div>

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                จังหวัด
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 70%;'>
                                                นนทบุรี
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div>

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                เขตพื้นที่การศึกษา
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 40%;'>
                                                -
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div> 

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left;'>
                                                วันเข้าโรงเรียนนี้
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 45%;'>
                                                ๑๘ กุมภาพันธ์ ๒๕๔๐
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div> 

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                โรงเรียนเดิม
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 60%;'>
                                                วัดบางอ้อยช้าง
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div> 

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                จังหวัด
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 70%;'>
                                                นนทบุรี
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div> 

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                ชั้นเรียนสุดท้าย
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 57%;'>
                                                ประถมศึกษาปีที่ ๖
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div>
                                    </div>

                                    <div style='width: 22%;float: left;margin: 5px;'>
                                        <img src="<?php echo base_url() . 'upload/HiImFluke.jpg' ?>" style='width: 170px;height: 210px;'/>
                                    </div>


                                    <div style='width:37%;float: left'>
                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                ชื่อ
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 88%;'>
                                                <b>เด็กชายชัยรัธฐา</b>
                                            </div> 
                                        </div>                           
                                        <div style="clear:both;"></div>

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                ชื่อ-สกุล
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 80%;'>
                                                อ่วมอารีย์
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div>

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                เลขประจำตัวนักเรียน
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 58%;'>
                                                44698
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div>

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                เลขประจำตัวบัตรประชาชน
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 48%;'>
                                                1122345566789
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div>

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                เกิด
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 86%;'>
                                                ๑๘ กุมภาพันธ์ พ.ศ. ๒๕๔๐
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div>

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                เพศ
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 12%;'>
                                                ชาย
                                            </div> 
                                            <div class='school-row-title'style='float: left'>
                                                สัญชาติ
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 17%;'>
                                                ไทย
                                            </div> 
                                            <div class='school-row-title'style='float: left'>
                                                ศาสนา
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 17%;'>
                                                พุทธ
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div> 

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                ชื่อบิดา
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 80%;'>
                                                นายเมืองมินทร์
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div> 

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                ชื่อสกุลบิดา
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 70%;'>
                                                แสงวิมล
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div> 

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                ชื่อมารดา
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 77%;'>
                                                นางสาววาสนา
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div> 

                                        <div style="width:100%">
                                            <div class='school-row-title'style='float: left'>
                                                ชื่อสกุลมารดา
                                            </div>                                    
                                            <div class='school-row-content' style='float: left;font-weight: bold;width: 67%;'>
                                                อ่วมอารีย์
                                            </div> 
                                        </div> 
                                        <div style="clear:both;"></div>
                                    </div>
                                </div>

                                <div style="clear:both;"></div>

                                <div style='width:100%;'>
                                    <center>ผลการเรียนสาระการเรียนรู้</center>
                                </div>

                                <table class="table table-bordered display" style='height: 750px' id="example">
                                    <thead>
                                        <tr style="height:150px;">
                                            <th class="no-sort" style="width:20%;text-align: center;">รหัสวิชา/รายวิชา</th>
                                            <th class="no-sort" style="width:5%;text-align: center;"><span class="textAlignVer">หน่วยกิต</span></th>
                                            <th class="no-sort" style="width:5%;text-align: center;"><span class="textAlignVer">ผลการประเมิน</span></th>
                                            <th class="no-sort" style="width:20%;text-align: center;">รหัสวิชา/รายวิชา</th>
                                            <th class="no-sort" style="width:5%;text-align: center;"><span class="textAlignVer">หน่วยกิต</span></th>
                                            <th class="no-sort" style="width:5%;text-align: center;"><span class="textAlignVer">ผลการประเมิน</span></th>
                                            <th class="no-sort" style="width:20%;text-align: center;">รหัสวิชา/รายวิชา</th>
                                            <th class="no-sort" style="width:5%;text-align: center;"><span class="textAlignVer">หน่วยกิต</span></th>
                                            <th class="no-sort" style="width:5%;text-align: center;"><span class="textAlignVer">ผลการประเมิน</span></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width:20%;"></td> 
                                            <td style="width:5%;"></td> 
                                            <td style="width:5%;"></td> 
                                            <td style="width:20%;"></td> 
                                            <td style="width:5%;"></td> 
                                            <td style="width:5%;"></td> 
                                            <td style="width:20%;"></td> 
                                            <td style="width:5%;"></td> 
                                            <td style="width:5%;"></td> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
<script>
</script>
