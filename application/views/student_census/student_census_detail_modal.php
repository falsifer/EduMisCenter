<!-- Modal -->
<div id="student-census-detail-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content" >
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <?php
//            $data['AreaID'] = 'ElectronicLeaveDetailBody';
            $this->load->view('layout/my_school_print');
            ?> 

            <div class="modal-body" style="padding:30px;" >
                <div class='row' id='StudentDetail'>
                    <div >
                        <?php
                        $this->load->view('layout/my_school_logo');
                        ?>  
                    </div>
                    <div id='StudentDetailBody'>
                        <div style='margin-left: 15px;margin-right: 15px;padding:10px;'>
                            <div style='float: left;width:30%;padding:5px;'>
                                <center><img name='Stdpic' id='Stdpic' src='<?php echo base_url(); ?>/images/abc.jpg' style='width:120px;' /></center>
                            </div>

                            <div style='float: left;width:70%;padding:5px;font-size:1em;'>
                                <p>ชื่อ <strong>นายชัยรัธฐา อ่วมอารีย์</strong> เลขที่ <strong>1</strong></p>
                                <p>รหัสนักเรียน <strong>446982</strong></p>
                                <p></p>
                                <p>ระดับชั้น <strong>มัธยมศึกษาปีที่ 4 ห้อง 1</strong></p>
                                <p>ผลรวมคะแนนความประพฤติปัจจุบัน 100 คะแนน โดยเป็นการหัก 20 คะแนน และการเพิ่ม 20 คะแนน</p>
                            </div> 
                            <div style='clear:both;'></div>
                        </div>

                        <hr/>
                        <div style='margin-left: 15px;margin-right: 15px;padding:10px;'>
                            <legend>ข้อมูลครอบครัว</legend>
                            <div style='float: left;width:70%;padding:5px;font-size:1em;'>
                                <p>ชื่อ <strong>นายชัยรัธฐา อ่วมอารีย์</strong> เลขที่ <strong>1</strong></p>
                                <p>รหัสนักเรียน <strong>446982</strong></p>
                                <p></p>
                                <p>ระดับชั้น <strong>มัธยมศึกษาปีที่ 4 ห้อง 1</strong></p>
                                <p>ผลรวมคะแนนความประพฤติปัจจุบัน 100 คะแนน โดยเป็นการหัก 20 คะแนน และการเพิ่ม 20 คะแนน</p>
                            </div> 
                            <div style='clear:both;'></div>
                        </div>
                        <hr/>
                        <div style='margin-left: 15px;margin-right: 15px;padding:10px;'>
                            <fieldset>
                                <legend>ข้อมูลที่อยู่</legend>
                                <div style='float: left;width:70%;padding:5px;font-size:1em;'>
                                    <p>ชื่อ <strong>นายชัยรัธฐา อ่วมอารีย์</strong> เลขที่ <strong>1</strong></p>
                                    <p>รหัสนักเรียน <strong>446982</strong></p>
                                    <p></p>
                                    <p>ระดับชั้น <strong>มัธยมศึกษาปีที่ 4 ห้อง 1</strong></p>
                                    <p>ผลรวมคะแนนความประพฤติปัจจุบัน 100 คะแนน โดยเป็นการหัก 20 คะแนน และการเพิ่ม 20 คะแนน</p>
                                </div> 
                                <div style='clear:both;'></div>
                            </fieldset>

                        </div>
                    </div>



                </div> 
            </div>
        </div>
    </div>
</div>
<script>
</script>
