<div class="box">
    <div class="box-heading">กระดานสนทนาเพื่อการศึกษา</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>กระดานสนทนาเพื่อการศึกษา</li>
    </ul>
    <div class="box-body">
        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">    
                    <div class="panel panel-default">
                        <div class="panel-heading">ชุมชนแห่งการเรียนรู้</div>
                        <div class="panel-body">

                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><i class="icon-star icon-large" style="color:gold;"> อันดับที่ 1</i></div>
                                    <div class="panel-body">Panel Content</div>
                                    <div class="panel-footer">Panel Footer</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading" ><i class="icon-star icon-large" style="color:silver;"> อันดับที่ 2</i></div>
                                    <div class="panel-body">Panel Content</div>
                                    <div class="panel-footer">Panel Footer</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><i class="icon-star icon-large" style="color:F18D30;"> อันดับที่ 3</i></div>
                                    <div class="panel-body">Panel Content</div>
                                    <div class="panel-footer">Panel Footer</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>

        </div>
        <div class="col-md-3">   
            <div class="row" style="margin-top:8px;text-align:center;">
                <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                    <button type="button" style="margin-bottom:5px;padding: 10px;"  class="btn btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('teaching-plan'); ?>';"><i class="icon-pushpin icon-large"></i> ชุมชนแห่งการเรียนรู้</button>
                </div>
            </div>
            <div class="row" style="margin-top:8px;text-align:center;">
                <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                    <button type="button" style="margin-bottom:5px;padding: 10px;"  class="btn btn-warning btn-submenu" onclick="javascript:location.href = '<?php echo site_url('teaching-plan'); ?>';"><i class="icon-list-alt icon-large"></i> คลังข้อสอบ</button>
                </div>
            </div>
            <div class="row" style="margin-top:8px;text-align:center;">
                <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                    <button type="button" style="margin-bottom:5px;padding: 10px;"  class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('teaching-plan'); ?>';"><i class="icon-list icon-large"></i> แผนการสอน</button>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/my_school_footer'); ?>
</div>

<script>

</script>

