<html>
    <head>
        <title>ระบบบริหารจัดการศึกษาอิเล็กทรอนิกส์ (Thailand 4.0)</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url() . "assets/css/bootstrap.css" ?>">
        <link href="https://fonts.googleapis.com/css?family=Taviraj:300" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=K2D:300" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Sarabun:300|Thasadith" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url("assets/font-awesome/css/font-awesome.css") ?>" media="screen">
        <link rel="stylesheet" href="<?php echo base_url("assets/css/main.css") ?>" media="screen">
        <link rel="stylesheet" href="<?php echo base_url('assets/DataTables/jquery.dataTables.min.css'); ?>" media="screen" />
<!--        <link rel="stylesheet" href="<?php echo base_url('assets/DataTables/datatables.css'); ?>" media="screen" />-->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/magic-check.css'); ?>" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/thsarabunnew.css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bt-datepicker/css/datepicker.css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fullcalendar-3.9.0/fullcalendar.css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/lytebox/lytebox.css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/summernote/summernote.css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/metismenu/metisMenu.css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/marquee.css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tickernews.css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/mycss.css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css" media="screen" />
        <link  rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.magicsearch.css" media="screen" />
        <link href="https://canvasjs.com/assets/css/jquery-ui.1.11.2.min.css" rel="stylesheet" />
        <link  rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style3.css"  />
        <link  rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-select.min.css"  />


        <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.0.min.js"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/myJs.js"></script>
        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.magicsearch.js"></script>

        <script type="text/javascript" src="<?php echo base_url('assets/js/superplaceholder.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-filestyle.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/bt-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/bt-datepicker/js/bootstrap-datepicker-thai.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/bt-datepicker/js/locales/bootstrap-datepicker.th.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/fullcalendar-3.9.0/lib/moment.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/fullcalendar-3.9.0/fullcalendar.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/lytebox/lytebox.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/summernote/summernote.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/tinymce/tinymce.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/metismenu/metisMenu.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/marquee.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.tickerNews.min.js'); ?>"></script>      
        <script src="<?php echo base_url(); ?>assets/js/charts/jquery.canvasjs.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/mySchoolJs.js'); ?>"></script>


        <!-- Required datatable js -->
        <script src="<?php echo base_url(); ?>/assets_parcel/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets_parcel/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?php echo base_url(); ?>/assets_parcel/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets_parcel/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets_parcel/plugins/datatables/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets_parcel/plugins/datatables/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets_parcel/plugins/datatables/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>/assets_parcel/plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets_parcel/plugins/datatables/buttons.print.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets_parcel/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?php echo base_url(); ?>/assets_parcel/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets_parcel/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/editor/editor.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.min.js'); ?>"></script>
<!--<script src="https://www.jquery-az.com/boots/js/editor/editor.js"></script>-->

        <style type="text/css">
            body{
                /*                                background-image: url("<?php echo base_url('images/dot_bg.png'); ?>");
                                                background-repeat:repeat;*/
                /*background : #2E4053;*/
                background : #EFEFEF;
                font-family:'Sarabun', 'K2D', Tahoma,'THSarabunNew', sans-serif;
                font-size:1.6em;
                color:#000;
            }    

            .btn-head:hover{
                color: #FF9F33 !important;
            }
        </style>

    </head>
    <body>
        <div style="clear:both;height:0px;"></div>

        <?php
        $tmp = explode("/", $_SERVER['REQUEST_URI']);
        $str = $tmp[sizeof($tmp) - 1];
        $this->session->set_userdata('data-define', $str);
        ?>
        <?php
        if ($this->session->userdata("department") != "กองการศึกษา" && $this->session->userdata("status") != '') {
            ?>
            <div style="clear:both;height:50px;"></div>

            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"  >
                <div class="col-md-12" style="padding:0px;text-align:left;color:#fff;">

                    <div class="col-md-1" style="padding:0px;">
                        <div class="col-md-12" style="padding:0px;">
                            <div class="btn form-control" id="sidebarCollapse" style="height:52px;background: #222;color:#fff;font-size:0.95em !important;text-align: left">
                                <i class="icon-list icon-2x"></i> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-11" style="padding:0px;">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-2" style="padding:4px;">
                                    <div id="google_translate_element"></div>
                                </div>
                                <div class="col-md-2" style="padding:0px;">
                                    <a href="<?php echo site_url(); ?>" class="btn-head">
                                        <div class="btn form-control btn-head" style="background: #222;color:#fff;font-size:0.95em !important;text-align: left">
                                            <img src='<?php echo base_url() ?>/images/icon/home.png' style="width: 30px" /> หน้าแรก
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-2" style="padding:0px;" class="btn-head">
                                    <a href="<?php echo site_url('edocument-inbox'); ?>" class="btn-head">
                                        <div class="btn form-control btn-head"  style="height:52px;background: #222;color:#fff;font-size:0.95em !important;text-align: left">
                                            <img src='<?php echo base_url() ?>/images/icon/edoc-rc.png' style="width: 30px" /> หนังสือรับ
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-2" style="padding:0px;" class="btn-head">
                                    <a href="<?php echo site_url('e-leave'); ?>" class="btn-head">
                                        <div class="btn form-control btn-head"  style="height:52px;background: #222;color:#fff;font-size:0.95em !important;text-align: left">
                                            <img src='<?php echo base_url() ?>/images/icon/absent.png' style="width: 30px" /> ใบลาออนไลน์
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-2" style="padding:0px;" class="btn-head">
                                    <a href="<?php echo site_url('activity-planing'); ?>">
                                        <div class="btn form-control btn-head" style="height:52px;background: #222;color:#fff;font-size:0.95em !important;text-align: left">
                                            <img src='<?php echo base_url() ?>/images/icon/calendar.png' style="width: 30px" /> ปฏิทินการศึกษา
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-2" style="padding:0px;" class="btn-head">
                                    <a href="<?php echo site_url('goout-from-system'); ?>">
                                        <div class="btn form-control btn-head" style="height:52px;background: #222;color:#fff;font-size:0.95em !important;text-align: left">
                                            <img src='<?php echo base_url() ?>/images/icon/logout.png' style="width: 30px" /> ออกจากระบบ
                                        </div>
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>


                </div>
                <nav id="sidebar">
                    <!--                    <button type="button" id="dismiss" onclick="closeMenu()" class="btn btn-default">
                                            <i class="icon-arrow-left icon-large"></i>
                                        </button>-->
                    <?php if ($this->session->userdata("status") != ""): ?>
                        <?php
                        $rs = $this->My_model->get_where_row('tb_human_resources_01', array('tb_member_id' => $this->session->userdata('member_id')));
                        if (isset($rs['hr_image']))
                            $img = $rs['hr_image'];
                        ?>
                        <div class="col-md-12" style="padding:0px;">
                            <div class="input-group col-md-12">

                                <span class="input-group-addon btn btn-primary btn-profile" onclick="window.location.href = '<?php echo site_url('hr-member-profile') ?>'" Title="ข้อมูลส่วนตัว">
                                    <?php if (isset($img)) { ?>
                                        <img src="<?php echo base_url() . hr_path($this->session->userdata('hr_id'), $this->session->userdata('sch_id')) . $img ?>" class="img-circle" width="30px" height="28px;" />
                                    <?php } else {
                                        ?>
                                        <img src="<?php echo base_url() ?>/images/user.png" class="img-circle" width="30px" height="28px;" />

                                        <?php
                                    }
                                    ?>

                                </span>
                                <input type="text" id="search_menu" placeholder="ค้นหา" />
                                <span class="input-group-addon btn btn-primary"id="dismiss" onclick="closeMenu()" >
                                    <i class="icon-arrow-left icon-large"></i>
                                </span>
                            </div>
                        </div>

                    <?php endif; ?>
                    <div class="col-md-12" >

                        <div class="col-md-12">
                            <div class="row">
                                <div class="row box" style="background: #fff;margin-bottom: 10px;">
                                    <div class="pricing-head pricing-head-active">
                                        <h3 style="font-size:1.20em !important"><?php echo $this->session->userdata('name'); ?><span><?php echo $this->session->userdata("status"); ?></span></h3>
                                    </div>

                                    <ul class="pricing-content list-unstyled">
                                        <div style="margin:0px;padding:0px;">
                                            <?php
                                            if ($this->session->userdata("department") != "กองการศึกษา" && $this->session->userdata("status") != '') {
                                                ?>

                                                <div class="btn-ls col-md-12" style="padding:0px;">
                                                    <a href="<?php echo site_url('teaching-task-base'); ?>" class="btn-ls" style="color:#fff;">
                                                        <div class="btn-ls btn form-control leftmenu" style="height: 44px ;background: #efefef; font-size: 0.95em !important;text-align: left">
                                                            <img src='<?php echo base_url() ?>/images/icon/blackboard-2.png' style="width: 30px" /> งานครูผู้สอน
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="btn-ls col-md-12" style="padding:0px;">
                                                    <a href="<?php echo site_url('hr-homeroom'); ?>" style="color:#fff;">
                                                        <div class="btn-ls btn form-control leftmenu" style="height: 44px ;background: #efefef; font-size: 0.95em !important;text-align: left">
                                                            <img src='<?php echo base_url() ?>/images/icon/homeroom.png' style="width: 30px" /> งานครูประจำชั้น
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="btn-ls col-md-12" style="padding:0px;">
                                                    <a href="<?php echo site_url('online-classroom'); ?>" style="color:#fff;">
                                                        <div class="btn-ls btn form-control leftmenu" style="height: 44px ;background: #efefef; font-size: 0.95em !important;text-align: left">
                                                            <img src='<?php echo base_url() ?>/images/icon/online.png' style="width: 30px" /> การพัฒนากระบวนการเรียนรู้/บทเรียนออนไลน์
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="btn-ls col-md-12" style="padding:0px;">
                                                    <a href="<?php echo site_url('adm-base'); ?>" style="color:#fff;">
                                                        <div class="btn-ls btn form-control leftmenu" style="height: 44px ;background: #efefef; font-size: 0.95em !important;text-align: left">
                                                            <img src='<?php echo base_url() ?>/images/icon/hr-award.png' style="width: 30px" /> บันทึกคะแนนความประพฤติ
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="btn-ls col-md-12" style="padding:0px;">
                                                    <a href="<?php echo site_url('project-planing'); ?>" style="color:#fff;">
                                                        <div class="btn-ls btn form-control leftmenu" style="height: 44px ;background: #efefef; font-size: 0.95em !important;text-align: left">
                                                            <img src='<?php echo base_url() ?>/images/icon/204-push-pin.png' style="width: 30px" /> บันทึกโครงการ
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="btn-ls col-md-12" style="padding:0px;">
                                                    <a href="<?php echo site_url('rec-report-base'); ?>" style="color:#fff;">
                                                        <div class="btn-ls btn form-control leftmenu" style="height: 44px ;background: #efefef; font-size: 0.95em !important;text-align: left">
                                                            <img src='<?php echo base_url() ?>/images/icon/hr-working.png' style="width: 30px" /> รายงานผลการปฏิบัติงาน
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
                            $this->db->order_by('c.data_group');
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

                                                    <div class="btn-ls col-md-12" style="padding:0px;">
                                                        <?php
                                                        if($v['data_address'] == 'school-information'){
                                                            ?>
                                                        <a href="<?php echo site_url($v['data_address'])."?school=".$this->session->userdata('sch_id'); ?>" style="color:<?php echo $v['data_color_font']; ?>;">
                                                        <?php
                                                            
                                                        }else{
                                                        ?>
                                                        <a href="<?php echo site_url($v['data_address']); ?>" style="color:<?php echo $v['data_color_font']; ?>;">
                                                        <?php
                                                        }
                                                        ?>   
                                                            <div class="btn-ls btn-main form-control leftmenu" style="background: <?php echo $v['data_color_bg']; ?>; font-size: 1.05em !important;text-align: left">
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
                                        <li><i class="glyphicon glyphicon-duplicate"></i> <?php echo anchor('operational-regulation-list', "ระเบียบและแนวปฏิบัติ"); ?></li>
                                        <li><i class="glyphicon glyphicon-duplicate"></i> <?php echo anchor('stock-of-documents', "คลังเอกสารประกอบการปฏิบัติงาน"); ?></li>
                                        <!--<li><i class="glyphicon glyphicon-picture"></i> <?php echo anchor('picture-stock', "คลังภาพ"); ?></li>-->
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- end of col-md-3 -->

                    </div>
                </nav>
            </nav>
            <?php
        }
        ?>
        <div style="clear:both;height: 0px;"></div>
        <div class="container-fluid">
            <?php
            $advertising = $this->Pr_model->get_PR_external();
            $advertising_in = $this->Pr_model->get_PR_internal();

            if ($this->session->userdata("status") == 'กองการศึกษา' && $this->session->userdata("status") != '') {
                ?>
                <div class='row'>
                    <div class="box-heading" style="padding-left: 100px;font-size: 1.5em;">ระบบบริหารจัดการศึกษาอิเล็กทรอนิกส์ (Thailand 4.0) <span class="pull-right" style="margin-right:15px;">กอง/สำนักการศึกษา</span></div>
                    <ul class="breadcrumb" style="background:#FAF6EB !important;color:#660000;">
                        <div>

                            <marquee style="color:#660000;font-size:16px;" onmouseover="javascript:stop();" onmouseout="javascript:start();">
                                <?php foreach ($advertising as $ad): ?>
                                    <a href="<?php echo site_url('pr-base-detail?id=' . $ad['id']); ?>" target="_blank" style="color:#660000;font-weight: bold">
                                        <img src='<?php echo base_url() ?>/images/icon/pr.png' style="width: 25px" /> <?php echo $ad['pr_topic']; ?></a><?php echo nbs(10); ?>
                                <?php endforeach; ?>
                                <?php foreach ($advertising_in as $ad): ?>
                                    <a href="<?php echo site_url('pr-base-detail?id=' . $ad['id']); ?>" target="_blank" style="color:#660000;font-weight: bold">
                                        <img src='<?php echo base_url() ?>/images/icon/pr.png' style="width: 25px" /> <?php echo $ad['pr_topic']; ?></a><?php echo nbs(10); ?>
                                <?php endforeach; ?>
                            </marquee>
                        </div>
                    </ul>

                </div>
                <?php
            }elseif ($this->session->userdata("status") != 'กองการศึกษา' && $this->session->userdata("status") != '') {
                ?>
                <div class='row'>
                    <ul class="breadcrumb" style="background:#FAF6EB !important;color:#660000;">
                        <div>

                            <marquee style="color:#660000;font-size:16px;" onmouseover="javascript:stop();" onmouseout="javascript:start();">
                                <?php foreach ($advertising as $ad): ?>
                                    <a href="<?php echo site_url('pr-base-detail?id=' . $ad['id']); ?>" target="_blank" style="color:#660000;font-weight: bold">
                                        <img src='<?php echo base_url() ?>/images/icon/pr.png' style="width: 25px" /> <?php echo $ad['pr_topic']; ?></a><?php echo nbs(10); ?>
                                <?php endforeach; ?>
                                <?php foreach ($advertising_in as $ad): ?>
                                    <a href="<?php echo site_url('pr-base-detail?id=' . $ad['id']); ?>" target="_blank" style="color:#660000;font-weight: bold">
                                        <img src='<?php echo base_url() ?>/images/icon/pr.png' style="width: 25px" /> <?php echo $ad['pr_topic']; ?></a><?php echo nbs(10); ?>
                                <?php endforeach; ?>
                            </marquee>
                        </div>
                    </ul>

                </div>
                <?php
            }
            ?>

            <script>
                function googleTranslateElementInit() {
                    new google.translate.TranslateElement({
                        pageLanguage: 'th'
                    }, 'google_translate_element');
                }
            </script>
            <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            <div class="row" id="top">
                <?php
                if ($this->session->userdata("department") != "กองการศึกษา" && $this->session->userdata("status") != '') {


                    if ($this->session->userdata("status") != 'คนขับรถ') {
                        if ($this->session->userdata("status") == 'ผู้บริหาร') {
                            $this->load->view('layout/left_menu_director');
                        } elseif ($this->session->userdata("status") == 'นักเรียน') {
                            $this->load->view('layout/left_std_menu');
                        } else {
                            $this->load->view('layout/left_menu');
                        }
                    }
                } elseif ($this->session->userdata("department") == "กองการศึกษา" && $this->session->userdata("status") != '') {
                    $this->load->view('layout/left_menu_zone');
                }
                ?>