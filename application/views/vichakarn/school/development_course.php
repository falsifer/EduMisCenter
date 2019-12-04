<div class="box">
    <div class="box-heading"><i class="icon-user icon-large"></i>ระบบการพัฒนาหลักสูตร</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>สารสนเทศหลักสูตรการสอน</li>
    </ul>

    <!-- Left side -->

    <div class="box-body">
        <div class="row">

            <div class="col-md-9">
                <div id="top_x_div"  class="databox"></div>
            </div>

            <!-- Right side -->
            <div class="col-md-3">

                <div class="row" style="margin-top:30px;text-align:center;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <div type="button" style="margin-bottom:5px;padding: 10px;" class=" btn-info btn-submenu" onclick="javascript:location.href = '<?php echo site_url('curriculum'); ?>';"><i class="icon-sitemap icon-large"></i> โครงสร้างหลักสูตรแกนกลาง</div>
                    </div>
                </div>
                <div class="row" style="margin-top:8px;text-align:center;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <div style="margin-bottom:5px;padding: 10px;"  class=" btn-primary btn-submenu" onclick="javascript:location.href = '<?php echo site_url('dc-base-setting'); ?>';"><i class="icon-sitemap icon-large"></i> โครงสร้างหลักสูตรสถานศึกษา/แผนการสอน</div>
                    </div>
                </div>
<!--                <div class="row" style="margin-top:8px;text-align:center;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:4px;">
                        <button type="button" style="margin-bottom:5px;padding: 10px;"  class="btn btn-success btn-submenu" onclick="javascript:location.href = '<?php echo site_url('dc-base-setting'); ?>';"><i class="icon-sitemap icon-large"></i> โครงสร้างรายวิชา/แผนการสอน</button>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>


<script type="text/javascript">
                                    
<?php
//foreach ($course as $r):
//    if ($r['tb_group_learningcol_name'] != null) {
//        echo '["' . $r['tb_group_learningcol_name'] . '",' . $r['sbj'];
//        if($r['sbj']>5){ 
//            echo ',"color:orange" ],';
//        }elseif($r['sbj']>10){ 
//            echo ',"color:green" ],';
//        }else{ 
//            echo ',"color:red" ],';
//        }
//    }
//endforeach;
?>
//                                    ["Copper", 8.94, "#b87333"],
//                                    ["Silver", 10.49, "silver"],
//                                    ["Gold", 19.30, "gold"],
//                                    ["Platinum", 21.45, "color: #e5e4e2"]
                          
                            
 var optionsTAGL = {
    exportEnabled: true,
            animationEnabled: true,
            title: {
            text: "จำนวนวิชาตามกลุ่มสาระ",
            fontSize:16,
            fontFamily:'Sarabun'
            },
            data: [
            {
            type: "column", //change it to line, area, bar, pie,column etc
                    indexLabel: "{y} วิชา",
                    dataPoints: [
<?php foreach ($course as $r): ?>

                        {y: <?php echo $r['sbj']; ?>,label:"<?php echo $r['tb_group_learningcol_name']; ?>"},
<?php endforeach; ?>

                    ]
            }
            ]
    };                           
                            
        $("#top_x_div").CanvasJSChart(optionsTAGL);                    
                            
                            
                            
</script>

