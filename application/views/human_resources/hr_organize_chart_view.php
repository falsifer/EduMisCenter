<div class="box">
    <div class="box-heading">ทำเนียบบุคลากร</div>

    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
        <ul class="breadcrumb">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
            <li><?php echo anchor('human_resources', "ทะเบียนบุคลากร"); ?></li>
            <li>ผังทำเนียบบุคลากร</li>
        </ul>
    <?php endif; ?>

    <div class="box-body">
        <!--<input type="text" name="1" id="1" class="form-control" value="<?php echo $parameterdept ?>"/>-->

        <div class="row"> 
            <div class="col-md-2" style="margin-left: 30px;"> 
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <div class="btn-group">
                            <button type="button" style="margin-bottom:5px;padding: 10px;" class="btn btn-info dropdown-toggle" data-toggle="dropdown" onclick="SelectOc(this)">
                                <i class="icon-user icon-large"> บุคลากร</i> 
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu" style="margin-bottom:60px;">
                                <li><a onclick="HrClick(this)" name="3" >คณะผู้บริหาร</a></li>
                                <li><a onclick="HrClick(this)" name="">บุคลากร อื่นๆ</a></li>
                            </ul>
                        </div>  
                    </div>
                </div>

                <div class="row" style="margin-top:5px;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <div class="btn-group">
                            <button type="button" style="margin-bottom:5px;padding: 10px;" class="btn btn-info dropdown-toggle" data-toggle="dropdown" onclick="SelectOc(this)">
                                <i class="icon-user icon-large"> บุคลากรแบ่งฝ่ายงาน</i> 
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu" style="margin-bottom:60px;">
                                <?php foreach ($tbDivision as $r): ?>
                                    <li><a onclick="DivisionClick(this)" name="<?php echo $r['tb_division_name'] ?>">ฝ่าย<?php echo $r['tb_division_name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>  
                    </div>
                </div>

                <div class="row" style="margin-top:5px;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <div class="btn-group">
                            <button type="button" style="margin-bottom:5px;padding: 10px;" class="btn btn-info dropdown-toggle" data-toggle="dropdown" onclick="SelectOc(this)">
                                <i class="icon-user icon-large"> บุคลากรแบ่งตามกลุ่มสาระ</i> 
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu" style="margin-bottom:60px;">
                                <?php foreach ($tbGroupLearning as $r): ?>
                                    <li><a onclick="GroupLearningClick(this)" name="<?php echo $r['tb_group_learningcol_name'] ?>"><?php echo $r['tb_group_learningcol_name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row" id="OcBody">

                </div>
            </div>     
        </div>
    </div>

    <?php if ($this->session->userdata("status") == "ผู้ปฏิบัติงาน"): ?>
        <?php $this->load->view('layout/my_school_footer'); ?>
    <?php endif; ?>

</div>
<script>

    function HrClick(e) {
        $.ajax({
            url: "<?php echo site_url('Oc/hr_executive_oc'); ?>",
            method: "post",
            data: {name: e.name},
            success: function (data) {
                $("#OcBody").html(data);
            }
        });
    }

    function GroupLearningClick(e) {
        $.ajax({
            url: "<?php echo site_url('Oc/group_learning_oc'); ?>",
            method: "post",
            data: {name: e.name},
            success: function (data) {
                $("#OcBody").html(data);
            }
        });
    }

    function DivisionClick(e) {
        $.ajax({
            url: "<?php echo site_url('Oc/division_oc'); ?>",
            method: "post",
            data: {name: e.name},
            success: function (data) {
                $("#OcBody").html(data);
            }
        });
    }

</script>