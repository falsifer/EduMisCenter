<div class="box">
    <div class="box-heading">โครงสร้างรายวิชา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li><?php echo anchor('development-course', "สารสนเทศหลักสูตรการสอน"); ?></li>
        <li>โครงสร้างรายวิชา</li>
    </ul>
    <div class="box-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="post" id="result-modal-insert-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <center><h3 class="modal-title" id="" ><b>โครงสร้างรายวิชา</b></h3></center>
                        </div>
                    </div>
                    <br></br>
                    <div class="row">   
                        <div class="col-md-12 col-md-offset-1">
                            <b id="HeadResult"></b>
                        </div>
                        <br></br>
                    </div>

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
                </form>
            </div>
        </div>
    </div>

    <div class="box-footer" style="padding-top: 0px;">
        <div class="row">
            <div class="col-md-8">
                <?php echo img("images/kmk_logo.png"); ?>
            </div>
            <div class="col-md-4" style="padding-top:8px;padding-bottom: 8px;padding-right:30px;">
                <span class="pull-right"><span style="color:#999999;">eSchool Version 1.0</span></span>
            </div>
        </div>
    </div>
</div>

<script>
</script>

