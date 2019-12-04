<!-- Modal -->
<div id="dc-result-modal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <?php $this->load->view('layout/my_school_modal_header'); ?> 
            <?php
            $data['AreaID'] = 'PrintThisResult';
            $this->load->view('layout/my_school_print', $data);
            ?> 
            <div class="modal-body" style="padding:30px;">
                <div class='row' id='PrintThisResult'>

                    <div class="col-md-12">
                        <center><h3 class="modal-title" id="" ><b>โครงสร้างรายวิชา</b></h3></center>
                    </div>

                    <br>

                    <div class="col-md-12 col-md-offset-1">
                        <b id="HeadResult"></b>
                    </div>
                    <br>


                    <div class="col-md-12" id="RecordBody">
                        <table class="table table-hover table-striped table-bordered display" id="example">
                            <thead>
                                <tr>
                                    <th style="width:10%;" class="no-sort">ลำดับที่</th>
                                    <th style="width:20%;" class="no-sort">ชื่อหน่วยการเรียนรู้</th>
                                    <th style="width:30%;" class="no-sort">มาตรฐานการเรียนรู้/ตัวชี้วัด</th>
                                    <th style="width:20%;" class="no-sort">สาระสำคัญ</th>
                                    <th style="width:5%;" class="no-sort">เวลา(ชั่วโมง)</th>
                                    <th style="width:15%;" class="no-sort">น้ำหนักคะแนน</th>
                                </tr>
                            </thead>
                            <tbody id="ResultBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>