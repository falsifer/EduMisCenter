
<style>
    @media print
    {    
        #no-print
        {
            display: none !important;
        }
    }
</style>
<div id="std-adm-score-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <?php
            $data['AreaID'] = 'AdmPrintArea';
            $this->load->view('layout/my_school_print', $data);
            ?>  

            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <div class="row" id='AdmPrintArea' style='padding:30px;'>
                        <!--<div class='col-md-12'>-->
                        <?php $this->load->view('layout/my_school_logo'); ?>
                        <div class='row' id='AdmBody'>

                            <legend>ข้อมูลคะแนนความประพฤติของนักเรียนรายบุคคล</legend>
                            <br/>
                            <div  style='float: left;width:60%;padding:5px;'>
                                <div style='float: left;width:30%;padding:5px;'>
                                    <center><img name='Stdpic' id='Stdpic' src='<?php echo base_url(); ?>/images/abc.jpg' width='120px' /></center>

                                </div>
                                <div style='float: left;width:55%;padding:5px;font-size:0.9em;'>
                                    <p>ชื่อ <b>นายชัยรัธฐา อ่วมอารีย์</b> เลขที่ <b>1</b></p>
                                    <p>รหัสนักเรียน <b>446982</b></p>
                                    <!--<p></p>-->
                                    <p>ระดับชั้น <b>มัธยมศึกษาปีที่ 4 ห้อง 1</b></p>
                                    <!--<p>ผลรวมคะแนนความประพฤติปัจจุบัน 100 คะแนน โดยเป็นการหัก 20 คะแนน และการเพิ่ม 20 คะแนน</p>-->
                                </div> 
                            </div>
                            <div style='float: right;width:30%;padding:5px;'>
                                <table border='1' cellpadding='4' cellspacing='0' style='width:100%;font-size:1em !important;' >
                                    <tbody>
                                        <tr style='color:black;'>
                                            <td style='text-align: center;padding: 3px;'>คะแนนตั้งต้น</td>
                                            <td style='text-align: center;padding: 3px;'>100</td>
                                        </tr>
                                        <tr style='color:green;'>
                                            <td style='text-align: center;padding: 3px;'>คะแนนที่เพิ่ม</td>
                                            <td style='text-align: center;padding: 3px;'>20</td>
                                        </tr>
                                        <tr style='color:red;'>
                                            <td style='text-align: center;padding: 3px;'>คะแนนที่ลด</td>
                                            <td style='text-align: center;padding: 3px;'>30</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr style='color:blue;background-color: #eeeeee;'>
                                            <td style='text-align: center;padding: 3px;'>ผลรวมคะแนนปัจจุบัน</td>
                                            <td style='text-align: center;padding: 3px;'>90</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>


                            <div style='clear:both;'></div>
                            <hr/>
                            <center>
                                <div style='width:90%;padding:5px;'>
                                    <h4> <b>ประวัติการบันทึกคะแนน</b> </h4>

                                    <table border='1' cellpadding='4' cellspacing='0' style='width:100%;font-size:0.9em;' >
                                        <thead>
                                            <tr style='background-color: #eeeeee;'>
                                                <th style='width:10%;text-align: center;padding: 3px;'>ที่</th>                                               
                                                <th style='width:50%;text-align: center;padding: 3px;'>ข้อมูลการบันทึก</th>
                                                <th style='width:20%;text-align: center;padding: 3px;'>ผู้บันทึก</th>
                                                <th style='width:30%;text-align: center;padding: 3px;'>วันที่บันทึก</th>
                                            </tr>
                                        </thead>
                                        <tbody  name="inTbody" id="inTbody">
                                            <tr>
                                                <td style='width:10%;text-align: center;padding: 3px;'>ที่</td>                                               
                                                <td style='width:50%;text-align: center;padding: 3px;'>ข้อมูลการบันทึก</td>
                                                <td style='width:20%;text-align: center;padding: 3px;'>ผู้บันทึก</td>
                                                <td style='width:30%;text-align: center;padding: 3px;'>วันที่บันทึก</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>   
                            </center>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function InsertStdTopicScore() {
        $.ajax({
            url: "<?php echo site_url('School_administrator/admin_insert_std_topic_score'); ?>",
            method: "post",
            data: {stdid: $('#inStdId').val(), topic: $('#inAdmTopicScore').val()},
            success: function (data) {
                alert('บันทึกข้อมูลสำเร็จ');
                $.ajax({
                    url: "<?php echo site_url('School_administrator/get_std_adm_score'); ?>",
                    method: "post",
                    data: {id: $('#inStdId').val()},
                    success: function (data) {
                        $('#AdmBody').html(data);
                    }
                });
            }
        });
    }
    function DeleteThisRecord(e) {
        var uid = e.id;
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('School_administrator/std_adm_delete_score'); ?>',
                method: 'post',
                data: {id: uid},
                success: function (data) {
                    $.ajax({
                        url: "<?php echo site_url('School_administrator/get_std_adm_score'); ?>",
                        method: "post",
                        data: {id: $('#inStdId').val()},
                        success: function (data) {
                            $('#AdmBody').html(data);
                        }
                    });
                }
            });
        }
    }

</script>