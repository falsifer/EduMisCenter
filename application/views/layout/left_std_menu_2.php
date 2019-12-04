


<div class="col-md-2" style="padding: 0px;">
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
                <div style="margin:0px;padding:4 px;">
                    <div class="col-md-12" style="padding:0px;">
                        <a href="<?php echo site_url('ed-schedule-std'); ?>" style="color:#fff;">
                            <div class="btn form-control" style="height: 44px ;background: #B595C8; font-size: 0.95em !important;text-align: left">
                                <img src='<?php echo base_url() ?>/images/menu/calendar.png' style="width: 30px" /> ตารางเรียน
                            </div>
                        </a>
                    </div>
                    <div class="col-md-12" style="padding:0px;">
                        <a href="<?php echo site_url('ed-homework'); ?>" style="color:#fff;">
                            <div class="btn form-control" style="height: 44px ;background: #31A897; font-size: 0.95em !important;text-align: left">
                                <img src='<?php echo base_url() ?>/images/menu/assignment.png' style="width: 30px" /> การบ้าน
                            </div>
                        </a>
                    </div>
                    <div class="col-md-12" style="padding:0px;">
                        <a href="<?php echo site_url('ed-classroom-online'); ?>" style="color:#fff;">
                            <div class="btn form-control" style="height: 44px ;background: #DCA44A; font-size: 0.95em !important;text-align: left">
                                <img src='<?php echo base_url() ?>/images/menu/online.png' style="width: 30px" /> ห้องเรียนออนไลน์
                            </div>
                        </a>
                    </div>
                    <div class="col-md-12" style="padding:0px;">
                        <a href="<?php echo site_url('student-self-score'); ?>" style="color:#fff;">
                            <div class="btn form-control" style="height: 44px ;background: #F18F7B; font-size: 0.95em !important;text-align: left">
                                <img src='<?php echo base_url() ?>/images/menu/exam_score.png' style="width: 30px" /> ผลการเรียน
                            </div>
                        </a>
                    </div>
                    <div class="col-md-12" style="padding:0px;">
                        <a href="<?php echo site_url('ed-behavior-score'); ?>" style="color:#fff;">
                            <div class="btn form-control" style="height: 44px ;background: #28B5CB; font-size: 0.95em !important;text-align: left">
                                <img src='<?php echo base_url() ?>/images/menu/behavior_score.png' style="width: 30px" /> คะแนนความประพฤติ
                            </div>
                        </a>
                    </div>
                    <div class="col-md-12" style="padding:0px;">
                        <a href="<?php echo site_url('ed-leave-stat'); ?>" style="color:#fff;">
                            <div class="btn form-control" style="height: 44px ;background: #F59749; font-size: 0.95em !important;text-align: left">
                                <img src='<?php echo base_url() ?>/images/menu/leave_stat.png' style="width: 30px" /> สถิติการมาเรียน
                            </div>
                        </a>
                    </div>


                </div>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="row box" style="background: #fff;margin-bottom: 10px;">
            <div class="pricing-head pricing-head-active">
                <h3 style="font-size:1.20em !important">งานที่ได้รับมอบหมาย<span>ภาระหน้าที่งานอื่นๆ</span></h3>
            </div>
            <div class="col-md-12" style="padding:0px;">
                <a href="<?php echo site_url('ed-leave-stat'); ?>" style="color:#fff;">
                    <div class="btn form-control" style="height: 44px ;background: #B595C8; font-size: 0.95em !important;text-align: left">
                        <img src='<?php echo base_url() ?>/images/menu/sdq.png' style="width: 30px" /> แบบประเมิน SDQ
                    </div>
                </a>
            </div>
        </div>
    </div>

</div> <!-- end of col-md-3 -->

<div class="col-md-10" style="margin: 0px;">