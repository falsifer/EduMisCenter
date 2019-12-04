<!-- Modal -->
<div id="student-affairs-std-absent-record-status-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;height: 600px;overflow: auto;" >
        <div class="modal-content" >            
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <?php
            $data['AreaID'] = 'ElectronicLeaveDetailBody';
            $this->load->view('layout/my_school_print', $data);
            ?>  
            <div class='row' >
                <div class='col-md-10 col-md-offset-1'style='margin-top:20px;'>
                    <table  class="table table-hover table-striped table-bordered display" >
                        <thead>
                            <tr style='background-color: #eee;'>
                                <th style='width:15%;text-align: center;'>เลขที่</th>
                                <th style='width:35%;text-align: center;'>ชื่อ - นามสกุล</th>
                                <th style='width:20%;text-align: center;'>ผู้บันทึก</th>
                                <!--<th style='width:30%;text-align: center;'>สถานะ</th>-->
                            </tr>
                        </thead> 
                        <tbody id="StdAbsentRecStatusTBody">

                        </tbody>
                    </table> 
                </div>
            </div>            
        </div>
    </div>
</div>