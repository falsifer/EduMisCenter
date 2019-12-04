<div class="col-md-3">

    <div class="row">
        <div class="pricing hover-effect" style="background: #fff;">
            <a  style="color:white !important;"href="<?php echo site_url('hr-member-profile'); ?>">
                <div class="pricing-head pricing-head-active">
                    <h3><?php echo $this->session->userdata('name'); ?><span><?php echo $this->session->userdata("status"); ?></span></h3>
                </div>
            </a>
            <ul class="pricing-content list-unstyled">
                <div style="margin-top:10px;margin-bottom:8px;padding:8px;">
                    <table class="table">
                        <tr>
                            <td>ชื่อ-นามสกุล</td><td><?= $this->session->userdata("name"); ?></td>
                        </tr>
                        <tr>
                            <td>สังกัด</td><td><?= $this->session->userdata("department"); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?= $this->session->userdata('localgov'); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">

                                <div class="col-md-12" style="padding:0px;">
                                    <a href="<?php echo site_url('e-leave'); ?>" style="color:#fff;">
                                        <div class="btn form-control leftmenu" style="height: 44px ;background: #efefef; font-size: 0.95em !important;text-align: left">
                                            <img src='<?php echo base_url() ?>/images/icon/absent.png' style="width: 30px" /> ใบลา
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-12" style="padding:0px;">
                                    <a href="<?php echo site_url('activity-planing'); ?>" style="color:#fff;">
                                        <div class="btn form-control leftmenu" style="height: 44px ;background: #efefef; font-size: 0.95em !important;text-align: left">
                                            <img src='<?php echo base_url() ?>/images/icon/calendar.png' style="width: 30px" /> ปฏิทินการปฏิบัติงาน
                                        </div>
                                    </a>
                                </div>

                            </td>
                        </tr>
                    </table>

                </div>

            </ul>
        </div>
    </div>
    <!-- รายการงานของแต่ละคน -->
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
                            <?php if ($v['data_name'] == 'ระบบการจัดสรรงบประมาณให้สถานศึกษาในสังกัด'): ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <div class="btn-main form-control leftmenu" style="background: <?php echo $v['data_color_bg']; ?>; font-size: 1.05em !important;text-align: left">
                                        <ul class="list-unstyled">

                                            <li><?php echo nbs(3); ?><i class="icon-gear"></i> <a href="<?php echo site_url('loan-category'); ?>">1-กำหนดหมวดเงินโอน</a></li>
                                            <li><?php echo nbs(3); ?><i class="icon-gear"></i> <a href="<?php echo site_url('loan-type'); ?>">2-กำหนดประเภทเงินโอน</a></li>
                                            <li><?php echo nbs(3); ?><i class="icon-gear"></i> <a href="<?php echo site_url('loan-define'); ?>">3-กำหนดรายการเงินโอน</a></li>
                                        </ul> 
                                    </div>

                                </div>
                            <?php endif; ?>
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
        <div class="pricing hover-effect" style="background: #fff;">
            <div class="pricing-head">
                <h3>รายการเสริม<span>กลุ่มข้อมูลช่วยเหลือในการปฏิบัติงาน</span></h3>
            </div>
            <ul class="pricing-content list-unstyled">
                <li><i class="icon-angle-right"></i> <?php echo anchor('stock-of-documents', "คลังเอกสารประกอบการปฏิบัติงาน"); ?></li>
                <li><i class="icon-angle-right"></i> <?php echo anchor('picture-stock', "คลังภาพ"); ?></li>
                <li><i class="icon-angle-right"></i> <?php echo anchor('http://www.gprocurement.go.th/new_index.html', "ระบบ EGP", 'target=_blank'); ?></li>
                <li><i class="icon-angle-right"></i> <?php echo anchor('http://www.laas.go.th/', "ระบบ e-LASS", 'target=_blank'); ?></li>
            </ul>
        </div>
    </div>
</div> <!-- end of col-md-3 -->


<div class="col-md-9">