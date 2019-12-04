


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
                </div>
            </ul>
        </div>
    </div>

</div> <!-- end of col-md-3 -->

<div class="col-md-10" style="margin: 0px;">