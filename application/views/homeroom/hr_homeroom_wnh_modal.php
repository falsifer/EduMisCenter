<!-- Modal -->
<style>
    .modal-body{
        height: 800px;
        overflow-y: auto;
    }
</style>
<div id="hr-homeroom-wnh-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;" >
        <div class="modal-content" >            
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <?php
            $data['AreaID'] = '';
            $this->load->view('layout/my_school_print', $data);
            ?>  
            <div class="modal-body" style="padding:30px;">
                <div id='WnHBody'>
                    <div class='row'>
                        <div class='col-md-4 form-group'>
                            <div class='container-fluid'>
                                <div class='pricing hover-effect'>
                                    <div class='pricing-head'>
                                        <h3>ข้อมูลนักเรียน</h3>
                                    </div>
                                    <div class='row'>                        
                                        <div class='col-md-10 form-group col-md-offset-1'>
                                            <br/>
                                            <center><img name='Stdpic' id='Stdpic' src='<?php echo base_url(); ?>/images/no-image.jpg' style='width:150px;height: 200px;'/></center>
                                            <label class='control-label' id='inStdname'  style='margin-top:10px;'></label>
                                            <label class='control-label' id='inStdCode' style='margin-top:10px;'></label>
                                            <label class='control-label' id='inStdClass'  style='margin-top:10px;'></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='col-md-8 form-group'>
                            <div class='row'>
                                <form method='post' id='wnh-form' enctype='multipart/form-data'>
                                    <div class='row'>
                                        <div class='col-md-5 form-group'>
                                            <label class='control-label'>น้ำหนัก</label>
                                            <input type='text' name='inW' id='inW' class='form-control' />
                                        </div>
                                        <div class='col-md-5 form-group'>
                                            <label class='control-label'>ส่วนสูง</label>
                                            <input type='text' name='inH' id='inH' class='form-control'/>
                                        </div>
                                        <button type='button' class='btn btn-success' style='margin-top:25px;'><i class='icon-save icon-large'></i> บันทึกข้อมูล</button>
                                    </div>
                                </form>
                            </div>

                            <div class='row'>
                                <table class='table table-hover table-striped table-bordered display' id='example'>
                                    <thead>
                                        <tr>
                                            <th style='width: 10%;text-align: center;'>ที่</th>
                                            <th style='width: 10%;text-align: center;'>วันที่บันทึก</th>
                                            <th style='width: 10%;text-align: center;'>น้ำหนัก</th>
                                            <th style='width: 10%;text-align: center;'>ส่วนสูง</th>
                                            <th style='width: 10%;text-align: center;'>ผู้บันทึก</th>
                                            <th style='width: 10%;text-align: center;'></th>
                                        </tr>
                                    </thead>
                                    <tbody  name='inTbody' id='inTbody'>
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
    function InsertWnH() {
        $.ajax({
            url: '<?php echo site_url('Homeroom/insert_wnh'); ?>',
            method: 'post',
            data: {W: $('#inW').val(), H: $('#inH').val(), StdId: $('#StdId').val()},
            success: function (data) {
                alert('บันทึกข้อมูลสำเร็จ');
                $.ajax({
                    url: '<?php echo site_url('Homeroom/student_wnh_show'); ?>',
                    method: 'post',
                    data: {id: $('#StdId').val()},
                    success: function (data) {
                        $("#WnHBody").html(data);
                    }
                });
            }
        });



    }

    function DeleteThis(e) {
        var status = confirm('ต้องการลบข้อมูลนี้จริงหรือไม่ ?');
        if (status) {
            $.ajax({
                url: '<?php echo site_url('Homeroom/delete_wnh'); ?>',
                method: 'post',
                data: {id: e.id},
                success: function (data) {
                    $.ajax({
                        url: '<?php echo site_url('Homeroom/student_wnh_show'); ?>',
                        method: 'post',
                        data: {id: $('#StdId').val()},
                        success: function (data) {
                            $("#WnHBody").html(data);
                        }
                    });
                }
            });
        }
    }
</script>