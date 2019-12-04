<div class="col-md-3" >
    <div id="sidebar-black" class="sidebar-nav">
        <nav id="navbar-black" class="navbar navbar-default" role="navigation">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="visible-xs"><a class="navbar-brand" href="/">เมนูการทำงานหลัก</a></span>
            </div>

            <div class="navbar-collapse collapse sidebar-navbar-collapse" id="leftmenu">

                <ul class="nav navbar-nav" style="margin-bottom: 25px">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="row box" style="background: #fff;margin-bottom: 10px;">
                                <div class="pricing-head pricing-head-active">
                                    <h3 style="font-size:1.20em !important"><?php echo $this->session->userdata('name'); ?><span><?php echo $this->session->userdata("status"); ?></span></h3>
                                </div>
                                <!--            <div class="row" style="padding-top:20px;padding-bottom: 20px;">
                                                <div class="col-md-12">
                                <?php echo img("images/admin/professor.png"); ?>
                                                </div>
                                            </div>-->
                                <ul class="pricing-content list-unstyled">
                                    <div style="margin:0px;padding:0px;">
                                        <?php
                                        if ($this->session->userdata("department") != "กองการศึกษา" && $this->session->userdata("status") != '') {
                                            ?>
                                            <div class="col-md-12" style="padding:0px;">
                                                <a href="<?php echo site_url('md-teaching-task-base'); ?>" style="color:#fff;">
                                                    <div class="btn form-control leftmenu" style="height: 44px ;background: #cf8ac9; font-size: 0.95em !important;text-align: left">
                                                        <img src='<?php echo base_url() ?>/images/icon/blackboard-2.png' style="width: 30px" /> กำกับติดตามงานครูผู้สอน
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-12" style="padding:0px;">
                                                <a href="<?php echo site_url('md-hr-homeroom'); ?>" style="color:#fff;">
                                                    <div class="btn form-control leftmenu" style="height: 44px ;background: #b1cf8a; font-size: 0.95em !important;text-align: left">
                                                        <img src='<?php echo base_url() ?>/images/icon/homeroom.png' style="width: 30px" /> กำกับติดตามงานครูประจำชั้น
                                                    </div>
                                                </a>
                                            </div>
                                            
                                            <div class="col-md-12" style="padding:0px;">
                                                <a href="<?php echo site_url('md-adm-base'); ?>" style="color:#fff;">
                                                    <div class="btn form-control leftmenu" style="height: 44px ;background: #efefef; font-size: 0.95em !important;text-align: left">
                                                        <img src='<?php echo base_url() ?>/images/icon/hr-award.png' style="width: 30px" /> รายงานคะแนนความประพฤติ
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-12" style="padding:0px;">
                                                <a href="<?php echo site_url('md-project-planing'); ?>" style="color:#fff;">
                                                    <div class="btn form-control leftmenu" style="height: 44px ;background: #efefef; font-size: 0.95em !important;text-align: left">
                                                        <img src='<?php echo base_url() ?>/images/icon/204-push-pin.png' style="width: 30px" /> รายงานโครงการ
                                                    </div>
                                                </a>
                                            </div>
                                        <div class="col-md-12" style="padding:0px;">
                                                <a href="<?php echo site_url('school-information'); ?>" style="color:#fff;">
                                                    <div class="btn form-control leftmenu" style="height: 44px ;background: #efefef; font-size: 0.95em !important;text-align: left">
                                                        <img src='<?php echo base_url() ?>/images/icon/stat.png' style="width: 30px" /> เครือข่ายข้อมูลสารสนเทศ
                                                    </div>
                                                </a>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <ul class="pricing-content list-unstyled">
                                                <li><i class="icon-angle-right"></i> <a href="#task-list" id="to-task-list">รายการงาน (Task)</a></li>
                                                <li><i class="icon-angle-right"></i> <a href="#mail-or-message">จดหมาย/ข้อความ (Mail or Message)</a></li>
                                                <li><i class="icon-angle-right"></i> <a href="#">หมายเหตุส่วนตัว (Personal Note)</a></li>
                                            </ul>

                                            <?php
                                        }
                                        ?>
                                    </div>
                                </ul>
                            </div>
                        </div>


                        <?php
                        $this->db->distinct();
                        $this->db->select('data_group')->from('tb_data_define c');
                        $this->db->join('tb_member_activities b', 'c.id = b.data_define_id');
                        $this->db->join('tb_member a', 'b.member_id = a.id');
                        $this->db->where('a.id', $this->session->userdata('member_id'))->where(array('c.department' => $this->session->userdata("department")));
                        $query = $this->db->get();
                        if ($query->num_rows() != 0) {
                            $grRS = $query->result_array();
                        }
                        if (!empty($grRS)):
                            $row = 1;
                            foreach ($grRS as $r):
                                $menuRS = $this->Eschool_model->get_menu_sch_by($r['data_group']);
                                ?>
                                <div class="row">
                                    <div class="row box" style="background: #fff;margin-bottom: 10px;">
                                        <a data-toggle="collapse" href="#collapse<?php echo $row; ?>" style="text-decoration: none;">
                                            <div class="pricing-head">
                                                <h3><?php echo $r['data_group']; ?><i class="glyphicon glyphicon-menu-hamburger" style="float:right"></i></h3>
                                            </div>
                                        </a>
                                        <ul class="pricing-content list-unstyled" id="collapse<?php echo $row; ?>">
                                            <?php
                                            $row++;
                                            foreach ($menuRS as $v):
                                                ?>

                                                <div class="col-md-12" style="padding:0px;">
                                                    <a href="<?php echo site_url($v['data_address']); ?>" style="color:<?php echo $v['data_color_font']; ?>;">
                                                        <div class="btn-main form-control leftmenu" style="background: <?php echo $v['data_color_bg']; ?>; font-size: 1.05em !important;text-align: left">
                                                            <img src='<?php echo base_url() ?>/images/icon/<?php echo $v['data_picture']; ?>' style="width: 30px" /> <?php echo $v['data_name']; ?>
                                                        </div>
                                                    </a>
                                                </div>
                                                <?php
                                            endforeach;
                                            ?>
                                        </ul>
                                    </div>


                                </div>   
                                <?php
                            endforeach;
                        endif;
                        ?>

                        <!-- รายการเสริม -->
                        <div class="row">
                            <div class="row box" style="background: #fff;margin-bottom: 10px;">
                                <div class="pricing-head">
                                    <h3>รายการเสริม<span>กลุ่มข้อมูลช่วยเหลือในการปฏิบัติงาน</span></h3>
                                </div>
                                <ul class="pricing-content list-unstyled">
                                    <li><i class="glyphicon glyphicon-duplicate"></i> <?php echo anchor('stock-of-documents', "คลังเอกสารประกอบการปฏิบัติงาน"); ?></li>
                                    <!--<li><i class="glyphicon glyphicon-picture"></i> <?php echo anchor('picture-stock', "คลังภาพ"); ?></li>-->
                                </ul>
                            </div>
                        </div>
                    </div> <!-- end of col-md-3 -->

                </ul>
            </div><!--/.nav-collapse -->

        </nav><!--/.navbar -->
    </div><!--/.sidebar-nav -->  
</div>
<div class="col-md-9">