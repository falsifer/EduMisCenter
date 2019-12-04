<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="icon" type="<?php echo base_url(''); ?>assets_parcel/image/png" href="../images/logo22.png" />
        <!-- App title -->
        <title><?php echo $title; ?></title>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?php echo base_url(''); ?>assets_pacel/plugins/morris/morris.css">

        <!-- Switchery css -->
        <link href="<?php echo base_url(''); ?>assets_pacel/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="<?php echo base_url(''); ?>assets_parcel/css/style.css" rel="stylesheet" type="text/css" />
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
        <!-- Modernizr js -->
        <script src="<?php echo base_url(''); ?>assets_pacel/js/modernizr.min.js"></script>


        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css" media="screen" />
        <link  rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.magicsearch.css" media="screen" />

        <!--<script src="<?php echo base_url(''); ?>assets/js/jquery-3.1.0.min.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(''); ?>assets/js/myJs.js"></script>
        <script src="<?php echo base_url('') ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url('') ?>assets/js/jquery.magicsearch.js"></script>


    </head>

    <body>

        <!-- Navigation Bar-->
        <header id="topnav">

            <!-- topbar-main -->
            <div class="topbar-main">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="<?php echo site_url(''); ?>/home_parcel" class="logo">
                            <i class="zmdi zmdi-collection-case-play icon-c-logo"></i>
                            <span>ระบบงานพัสดุ</span>
                        </a>
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav pull-right">

                            <li class="nav-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>

                        </ul>

                    </div> <!-- end menu-extras -->
                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->


            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
                            <li><?php echo anchor(site_url('home_parcel'), "<i class='zmdi zmdi-collection-case-play icon-c-logo'></i> หน้าแรกงานพัสดุ"); ?></li>
                            <!--                    <li class="has-submenu">
                                                    <a href="<?php echo site_url(''); ?>/><i class="zmdi zmdi-collection-item-1"></i> <span> งานเริ่มแรก</span> </a>
                                                    <ul class="submenu megamenu">
                                                        <li>
                                                            <ul>
                                                                <li><a href="<?php echo site_url(''); ?>/purchaser">ผู้เกี่ยวข้องจัดซื้อจัดจ้าง</a></li>
                                                                <li><a href="<?php echo site_url(''); ?>/committee">กรรมการตรวจรับ</a></li>
                                                                <li><a href="<?php echo site_url(''); ?>/department">บันทึกชื่อหน่วยงานผู้เบิก</a></li>
                                                                <li><a href="<?php echo site_url(''); ?>/seller">บันทึกชื่อผู้ขายที่ซื้อบ่อย</a></li>
                                                                <li><a href="<?php echo site_url(''); ?>/number">กำหนดเลขที่จัดซื้อจัดจ้าง</a></li>
                                                                <li><a href="<?php echo site_url(''); ?>/material">เพิ่มรหัสวัสดุที่ไม่มี</a></li>
                                                                <li><a href="<?php echo site_url(''); ?>/articles">เพิ่มรหัสครุภัณฑ์ที่ไม่มี</a></li>
                                                            </ul>
                                                        </li>
                            
                            
                                                    </ul>
                                                </li>
                            
                                                <li class="has-submenu">
                                                    <a href="<?php echo site_url(''); ?>/home_parcel"><i class="zmdi zmdi-collection-item-2"></i> <span> งบประมาณปัจจุบัน </span> </a>
                                                    <ul class="submenu megamenu">
                            
                                                        <li>
                                                           <ul>
                                                            <li><a href="<?php echo site_url(''); ?>/plan">ทำแผนการจัดซื้อจัดจ้าง</a></li>
                                                            <li><a href="<?php echo site_url(''); ?>/approve_purchase">ทำเรื่องอนุมัติจัดซื้อ</a></li>
                                                            <li><a href="<?php echo site_url(''); ?>/approve_hire">ทำเรื่องอนุมัติจัดซื้อ</a></li>
                                                            <li><a href="<?php echo site_url(''); ?>/approve_del">ลบเรื่องที่ขอปีที่ผ่านมา</a></li>
                                                            <li><a href="<?php echo site_url(''); ?>/carry">ยอดวัสดุยกจากปีที่แล้ว</a></li>
                                                            <li><a href="<?php echo site_url(''); ?>/maintenance">ซ่อมบำรุงครุภัณฑ์</a></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                       <ul>
                                                        <li><a href="<?php echo site_url(''); ?>/egp">พัสดุที่ทำผ่าน e-GP</a></li>
                                                        <li><a href="<?php echo site_url(''); ?>/unspsc">เตรียมรหัส UNSPSC</a></li>
                                                        <li><a href="<?php echo site_url(''); ?>/asset">ดูทะเบียนคุมทรัพย์สิน</a></li>
                                                        <li><a href="<?php echo site_url(''); ?>/home_parcel">พิมพ์ทะเบียนคุมทรัพย์สิน</a></li>
                                                        <li><a href="<?php echo site_url(''); ?>/home_parcel">เปลี่ยนรหัสครุภัณฑ์</a></li>
                                                        <li><a href="<?php echo site_url(''); ?>/home_parcel">แก้ไขรหัสครุภัณฑ์ที่ผิด</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                   <ul>
                                                    <li><a href="<?php echo site_url(''); ?>/audit">ดูบัญชีวัสดุ พิมพ์</a></li>
                                                    <li><a href="<?php echo site_url(''); ?>/home_parcel">รายรับ-จ่าย แต่ละเดือน</a></li>
                                                </ul>
                                            </li>
                            
                            
                                        </ul>
                                    </li>
                            
                                    <li class="has-submenu">
                                        <a href="<?php echo site_url(''); ?>/home_parcel"><i class="zmdi zmdi-collection-item-3"></i><span> สิ้นปี </span> </a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo site_url(''); ?>/survey">สำรวจชนิด</a></li>
                                            <li><a href="<?php echo site_url(''); ?>/home_parcel">สำรวจหน่วยงานเบิก</a></li>
                                            <li><a href="<?php echo site_url(''); ?>/selling">จำหน่ายพัสดุ</a></li>
                                            <li><a href="<?php echo site_url(''); ?>/calculate">คำนวณค่าเสื่อม</a></li>
                                            <li><a href="<?php echo site_url(''); ?>/report">รายงานทรัพย์สิน</a></li>
                                            <li><a href="<?php echo site_url(''); ?>/home_parcel">รายงานซ่อมทรัพย์สิน</a></li>
                                            <li><a href="<?php echo site_url(''); ?>/home_parcel">รายงานทรัพย์สินเหลือ</a></li>
                                        </ul>
                                    </li>
                            
                                    <li class="has-submenu">
                                        <a href="<?php echo site_url(''); ?>/asset_back"><i class="zmdi zmdi-collection-item-4"></i> <span> ย้อนอดีต </span> </a>
                            
                                    </li>-->



                        </ul>
                        <!-- End navigation menu  -->
                    </div>
                </div>
            </div>
        </header>
        <!-- End Navigation Bar-->


