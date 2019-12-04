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
        <link rel="stylesheet" href="<?php echo base_url('assets/DataTables/datatables.css'); ?>" media="screen" />
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
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/myJs.js"></script>
        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.magicsearch.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/DataTables/datatables.js"></script>
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
        <script src="<?php echo base_url(); ?>assets/DataTables/dataTables.fixedColumns.min.js"></script>
        <style type="text/css">
            body{
                /*                background-image: url("<?php echo base_url('images/dot_bg.png'); ?>");
                                background-repeat:repeat;*/
                background : #2E4053;
                font-family:'Sarabun', 'K2D', Tahoma,'THSarabunNew', sans-serif;
                font-size:1.6em;
                color:#000;
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
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="font-size:1.1em;">
                <?php if ($this->session->userdata("status") != ""): ?>
                    <div class="col-md-12" style="padding:0px;">
                        <div class="col-md-3" style="padding:4px;">
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
                                        <span class="input-group-addon btn btn-primary btn-search-menu">
                                            <i class="icon-search"></i>
                                        </span>
                                    </div>
                                </div>

                            <?php endif; ?>
                        </div>
                        <div class="col-md-9" style="padding:0px;">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                <div class="col-md-12" style="padding:4px;text-align:left;color:#fff;font-size:0.95em !important;text-align: left">

                                    <div class="col-md-2" style="padding:1px;">
                                        <a href="<?php echo site_url(); ?>" style="color:#fff;">
                                            <div class="btn form-control" style="height: 44px ;background: #202020;color:#fff !important; font-size: 0.95em !important;text-align: left">
                                                <img src='<?php echo base_url() ?>/images/icon/home.png' style="width: 30px" /> หน้าแรก
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-2" style="padding:1px;">
                                        <a href="<?php echo site_url('edocument-inbox'); ?>" style="color:#fff;">
                                            <div class="btn form-control" style="height: 44px ;background: #202020;color:#fff !important; font-size: 0.95em !important;text-align: left">
                                                <img src='<?php echo base_url() ?>/images/icon/edoc-rc.png' style="width: 30px" /> หนังสือรับ
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3" style="padding:1px;">
                                        <a href="<?php echo site_url('rec-report-base'); ?>" style="color:#fff;">
                                            <div class="btn form-control" style="height: 44px ;background: #202020;color:#fff !important; font-size: 0.95em !important;text-align: left">
                                                <img src='<?php echo base_url() ?>/images/icon/hr-working.png' style="width: 30px" /> รายงานผลการปฏิบัติงาน
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-2" style="padding:1px;">
                                        <a href="<?php echo site_url('e-leave'); ?>" style="color:#fff !important;">
                                            <div class="btn form-control" style="height: 44px ;background: #202020;color:#fff !important; font-size: 0.95em !important;text-align: left">
                                                <img src='<?php echo base_url() ?>/images/icon/absent.png' style="width: 30px" /> ใบลา
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-2" style="padding:1px;">
                                        <a href="<?php echo site_url('activity-planing'); ?>" style="color:#fff;">
                                            <div class="btn form-control" style="height: 44px ;background: #202020;color:#fff !important; font-size: 0.95em !important;text-align: left">
                                                <img src='<?php echo base_url() ?>/images/icon/calendar.png' style="width: 30px" /> ปฏิทินการศึกษา
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-1" style="padding:1px;">
                                        <button class="btn btn-danger btn-sm btn-turnoff"style="width:100%;text-align: center;height: 44px ;background: #d9534f; font-size: 0.95em !important;"><i class="icon-power-off"></i></button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                <?php endif; ?>
            </nav>
            <?php
        }
        ?>
        <div style="clear:both;height: 0px;"></div>
        <div class="container-fluid">
            <?php
            $advertising = $this->My_model->get_where_order('tb_public_relations', array('pr_status' => 'สาธารณะ'), 'pr_date desc');
            $advertising_in = $this->My_model->get_where_order('tb_public_relations', array('pr_status' => 'ภายใน', 'pr_department' => $this->session->userdata('department')), 'pr_date desc');

            if ($this->session->userdata("status") == 'กองการศึกษา' && $this->session->userdata("status") != '') {
                ?>
                <div class='row'>
                    <div class="box-heading" style="padding-left: 100px;font-size: 1.5em;">ระบบบริหารจัดการศึกษาอิเล็กทรอนิกส์ (Thailand 4.0) <span class="pull-right" style="margin-right:15px;">กอง/สำนักการศึกษา</span></div>
                    <ul class="breadcrumb">
                        <div>

                            <marquee style="color:#056f00;font-size:16px;" onmouseover="javascript:stop();" onmouseout="javascript:start();">
                                <?php foreach ($advertising as $ad): ?>
                                    <a href="<?php echo site_url('public-relationship'); ?>"><i class="icon-comments icon-large"></i> <?php echo $ad['pr_topic']; ?></a><?php echo nbs(4) . "|" . nbs(4); ?>
                                <?php endforeach; ?>
                                <?php foreach ($advertising_in as $ad): ?>
                                    <a href="<?php echo site_url('public-relationship'); ?>"><i class="icon-comments icon-large"></i> <?php echo $ad['pr_topic']; ?></a><?php echo nbs(4) . "|" . nbs(4); ?>
                                <?php endforeach; ?>
                            </marquee>
                        </div>
                    </ul>

                </div>
                <?php
            }elseif ($this->session->userdata("status") != 'กองการศึกษา' && $this->session->userdata("status") != '') {
                ?>
                <div class='row'>
                    <ul class="breadcrumb">
                        <div>

                            <marquee style="color:#056f00;font-size:16px;" onmouseover="javascript:stop();" onmouseout="javascript:start();">
                                <?php foreach ($advertising as $ad): ?>
                                    <a href="<?php echo site_url('public-relationship'); ?>"><i class="icon-comments icon-large"></i> <?php echo $ad['pr_topic']; ?></a><?php echo nbs(4) . "|" . nbs(4); ?>
                                <?php endforeach; ?>
                                <?php foreach ($advertising_in as $ad): ?>
                                    <a href="<?php echo site_url('public-relationship'); ?>"><i class="icon-comments icon-large"></i> <?php echo $ad['pr_topic']; ?></a><?php echo nbs(4) . "|" . nbs(4); ?>
                                <?php endforeach; ?>
                            </marquee>
                        </div>
                    </ul>

                </div>
                <?php
            }
            ?>
            <div id="google_translate_element"></div>
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