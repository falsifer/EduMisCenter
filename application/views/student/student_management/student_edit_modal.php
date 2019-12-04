<!-- Modal -->
<div id="student-edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content" style='background-color: whitesmoke;' >

            <?php
            $data['MyHeadTitle'] = '';
            $this->load->view('layout/my_school_modal_header', $data);
            ?>      

            <?php
            $data['AreaID'] = 'PP1PrintArea';
            $this->load->view('layout/my_school_print', $data);
            ?>     

            <style>
                .school-row-title{font-size:1em;line-height:20px;}
                .school-row-content{font-size:2em;margin-left:20px;line-height:20px;border-bottom: 1px dashed #ccc;}
            </style>
            
            <div class="modal-body" style="padding:30px;" >
                <div class="container-fluid">                    
                    <div class='row'>
                        <div class='databox' style='width:100%; float:left;'>
                            <div style='width:20%; margin-right: 2%;float:left;'>
                                <center>    
                                    <img class='btn' src="<?php echo base_url() . 'upload/HiImFluke.jpg' ?>" style='width: 170px;height: 210px;'/> 
                                </center> 
                            </div>
                            <div style='width:75%;float:left;'>
                                <h4>ข้อมูลส่วนตัว</h4>
                                <div class='school-row-title'style='float: left'>
                                    ชื่อ
                                </div>                                    
                                <div class='school-row-content' style='float: left;font-weight: bold;width: 88%;'>
                                    นายชัยรัธฐา อ่วมอารีย์
                                </div> 
                            </div> 
                        </div>

                    </div>
<!--                    <div class='row'>
                        <img class='btn' src="<?php echo base_url() . 'images/icon/hr-education.png' ?>" style='width: 50px;height: 50px;margin:0px;'/>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
</script>
