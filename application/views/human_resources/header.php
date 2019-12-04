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
                <!--<script src="<?php echo base_url() ?>assets/js/jquery.js"></script>-->
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
                background-image: url("<?php echo base_url('images/dot_bg.png'); ?>");
                background-repeat:repeat;
                /* background-size:cover; */
                /*background:#EFF0F5;*/
                font-family:'Sarabun', 'K2D', Tahoma,'THSarabunNew', sans-serif;
                font-size:1.6em;
                color:#000;
            }      
        </style>
    </head>
    <body>

        <?php
        $tmp = explode("/", $_SERVER['REQUEST_URI']);
        $str = $tmp[sizeof($tmp) - 1];
        $this->session->set_userdata('data-define', $str);
        ?>


        <div style="clear:both;height:100px;"></div>

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
                                            <!--<a href='<?php echo site_url('hr-member-profile') ?>'>--> 
                                        <?php if (isset($img)) { ?>
                                            <img src="<?php echo base_url() ?>/upload/<?php echo $img; ?>" class="img-circle" width="30px" height="28px;" />
                                            <?php } else {
                                            ?>
                                            <img src="<?php echo base_url() ?>/images/user.png" class="img-circle" width="30px" height="28px;" />

                                            <?php
                                        }
                                        ?>
                                        <!--</a>-->
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



                        <!--Brand and toggle get grouped for better mobile display--> 
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

                                <div class="col-md-2" style="padding:0px;">
                                    <a href="<?php echo site_url(); ?>" style="color:#fff;">
                                        <div class="btn form-control" style="height: 44px ;background: #31A897;  font-size: 0.95em !important;text-align: left">
                                            <img src='<?php echo base_url() ?>/images/icon/home.png' style="width: 30px" /> หน้าแรก
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-2" style="padding:0px;">
                                    <a href="<?php echo site_url('edocument-inbox'); ?>" style="color:#fff;">
                                        <div class="btn form-control" style="height: 44px ;background: #B595C8; font-size: 0.95em !important;text-align: left">
                                            <img src='<?php echo base_url() ?>/images/icon/edoc-rc.png' style="width: 30px" /> หนังสือรับ
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-2" style="padding:0px;">
                                    <a href="<?php //echo site_url('assignment');   ?>" style="color:#fff;">
                                        <div class="btn form-control" style="height: 44px ;background: #DCA44A; font-size: 0.95em !important;text-align: left">
                                            <img src='<?php echo base_url() ?>/images/icon/assignment.png' style="width: 30px" /> คำสั่ง
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-2" style="padding:0px;">
                                    <a href="<?php echo site_url('e-leave'); ?>" style="color:#fff;">
                                        <div class="btn form-control" style="height: 44px ;background: #F18F7B; font-size: 0.95em !important;text-align: left">
                                            <img src='<?php echo base_url() ?>/images/icon/absent.png' style="width: 30px" /> ใบลา
                                        </div>
                                    </a>
                                </div>
                                <!--                            <div class="col-md-2" style="padding:0px;">
                                                                <div class="btn form-control" style="height: 44px ;background: #31A897; font-size: 0.8em !important;text-align: left">
                                                                    <img src='<?php echo base_url() ?>/images/data.png' style="width: 30px" /> ประชาสัมพันธ์
                                                                </div>
                                                            </div>-->
                                <div class="col-md-3" style="padding:0px;">
                                    <a href="<?php echo site_url('activity-planing');   ?>" style="color:#fff;">
                                        <div class="btn form-control" style="height: 44px ;background: #28B5CB; font-size: 0.95em !important;text-align: left">
                                            <img src='<?php echo base_url() ?>/images/icon/calendar.png' style="width: 30px" /> ปฏิทินการศึกษา
                                        </div>
                                    </a>
                                </div>
<!--                                <div class="col-md-2" style="padding:0px;">
                                    <a href="<?php //echo site_url('notification');   ?>" style="color:#fff;">
                                        <div class="btn form-control" style="height: 44px ;background: #F59749; font-size: 0.95em !important;text-align: left">
                                            <img src='<?php echo base_url() ?>/images/menu/pr.png' style="width: 30px" /> แจ้งเตือน
                                        </div>
                                    </a>
                                </div>-->
                            </div>

                        </div>

                    </div>
                </div>
<?php endif; ?>
        </nav>
        <div style="clear:both;height: 0px;"></div>
        <!-- class="container-fluid" style="margin-left:20px;margin-right: 20px;"-->
        <div class="container-fluid">

<?php
if ($this->session->userdata("department") != "กองการศึกษา" && $this->session->userdata("status") != '') {
    $this->load->view('layout/left_menu');
}
?>

