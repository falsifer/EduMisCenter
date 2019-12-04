<!-- Modal -->
<div id="ic-evaluation-report-modal" class="modal fade" style="overflow: auto; " role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <div class="modal-content">
            <div class="modal-header" style="background:#0080FF;color:#FFFFFF;">
                <button type="button" class="close" data-dismiss="modal">X</button>
                <h3 class="modal-title" id="title"></h3>
            </div>
            <div class="modal-body" style="padding:30px;">
                <div class="container-fluid">
                    <form method="post" id="ic-element-insert-form" enctype="multipart/form-data">

                        <div class="row">
                            <center><h3>โรงเรียนสระพังวิทยา</h3></center>
                        </div>
                        <div class="row">
                            <center><h4>รายงานการประเมินผลการควบคุมภายใน <b>(วิชาการ)</b></h4></center>
                        </div>
                        <div class="row">
                            <center><h4>สำหรับระยะเวลาดำเนินงานสิ้นสุด วันที่ 30 เดือน กันยายน พ.ศ. 2561</h4></center>
                        </div>

                        <div id="dashboardTAB" class="row"> 
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a  href="#Ertab1" data-toggle="tab" data-id="1">
                                        <b>วัตถุประสงค์</b>
                                    </a>
                                </li>
                                <li>
                                    <a href="#Ertab2" data-toggle="tab" data-id="2">
                                        <b>ความเสี่ยง</b>
                                    </a>
                                </li>
                                <li>
                                    <a href="#Ertab3" data-toggle="tab" data-id="3">
                                        <b>การควบคุมภายในที่มีอยู่</b>
                                    </a>
                                </li>
                                <li>
                                    <a href="#Ertab4" data-toggle="tab" data-id="4">
                                        <b>การประเมินผลการควบคุมภายใน</b>
                                    </a>
                                </li>
                                <li>
                                    <a href="#Ertab5" data-toggle="tab" data-id="5">
                                        <b>ความเสี่ยงที่ยังมีอยู่</b>
                                    </a>
                                </li>
                                <li>
                                    <a href="#Ertab6" data-toggle="tab" data-id="6">
                                        <b>การปรับปรุงการควบคุมภายใน</b>
                                    </a>
                                </li>
                                <li>
                                    <a href="#Ertab7" data-toggle="tab" data-id="7">
                                        <b>หน่วยงาน/ผู้รับผิดชอบ</b>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane active" id="Ertab1" style="padding-top:10px;">   
                                <label class="control-label">วัตถุประสงค์</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row" >
                                            <div class="col-md-12 form-group" >
                                                <label class="control-label"><font color="red"><label> (1)</label></font>เลือกฝ่ายงาน</label>
                                                <select name="inDivision" id="inDivision" class="form-control" >
                                                    <option value="">---เลือกฝ่ายงาน---</option> 
                                                    <?php foreach ($rDivision as $r): ?>
                                                        <option value="<?php echo $r['id']; ?>">ฝ่าย<?php echo $r['tb_division_name']; ?></option> 
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" >
                                            <div class="col-md-2 form-group" >
                                                <label class="control-label"><font color="red"><label> (1)</label></font>ลำดับที่</label>
                                                <select name="inTopicSubSequence" id="inTopicSubSequence" class="form-control" >
                                                    <option value="">--เลือกลำดับที่--</option> 
                                                    <?php $seq = 10; ?>
                                                    <?php for ($i = 1; $i <= $seq; $i++) { ?>
                                                        <option value=<?php echo $i; ?>>ลำดับที่ <?php echo $i; ?></option>                                                    
                                                    <?php } ?>
                                                </select>
                                            </div>  
                                            <div class="col-md-4 form-group" >
                                                <label class="control-label"><font color="red"><label> (2)</label></font>ชื่อกิจกรรม</label>
                                                <input type="text" id="inTopicSubContent" name="inTopicSubContent" class="form-control" required autofocus="">
                                            </div> 
                                            <div class="col-md-4 form-group" >
                                                <label class="control-label"><font color="red"><label> (3)</label></font>วัตถุประสงค์</label>
                                                <input type="text" id="inTopicSubContent" name="inTopicSubContent" class="form-control" required autofocus="">
                                            </div> 
                                            <div class="col-md-1 form-group" >
                                                <font color="red"><label> (4)</label></font>
                                                <button type="button" class="btn btn-info btn-topic-sub-insert" id=""><i class="icon-plus icon-large"></i> เพิ่มกิจกรรม</button>
                                            </div> 
                                        </div>
                                        <div class="row" id="TopicSubBody">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="Ertab2" style="padding-top:10px;">   
                                ความเสี่ยง
                            </div>
                            <div class="tab-pane" id="Ertab3" style="padding-top:10px;">   
                                การควบคุมภายในที่มีอยู่
                            </div>
                            <div class="tab-pane" id="Ertab4" style="padding-top:10px;">   
                                การประเมินผลการควบคุมภายใน
                            </div>
                            <div class="tab-pane" id="Ertab5" style="padding-top:10px;">   
                                ความเสี่ยงที่ยังมีอยู่
                            </div>
                            <div class="tab-pane" id="Ertab6" style="padding-top:10px;">   
                                การปรับปรุงการควบคุมภายใน
                            </div>
                            <div class="tab-pane" id="Ertab7" style="padding-top:10px;">   
                                หน่วยงาน/ผู้รับผิดชอบ
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script>

</script>