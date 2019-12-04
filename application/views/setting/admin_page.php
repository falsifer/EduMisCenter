<div class="panel panel-primary">
    <div class="panel-heading">ส่วนการจัดการระบบ (Administrator)</div>
    <ul class="breadcrumb">
        <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
        <li>ส่วนการจัดการระบบ</li>
    </ul>
    <div class="panel-body" style="padding:50px;">
        <div class="container-fluid" style="text-align: center;">
            <div class="row">
<!--                <div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('school'); ?>';"><?php echo img("images/admin/school.png"); ?><br/><br/><span style="font-size:1.4em;">ข้อมูลโรงเรียน</span></a>
                </div>-->
<!--                <div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('school-director'); ?>';"><?php echo img('images/admin/professor.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>ผู้อำนวยการโรงเรียน</span></a>
                </div>-->
<!--                <div class="col-md-3">
                    <a href="#" class="btn btn-link btn-unit" onclick="javascript:location.href = '<?php echo site_url('unit-group'); ?>';"><?php echo img("images/admin/unit_group.png"); ?><br/><br/><span style="font-size:1.4em;">ประเภทหน่วยนับ</span></a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-link btn-unit" onclick="javascript:location.href = '<?php echo site_url('unit'); ?>';"><?php echo img("images/admin/unit.png"); ?><br/><br/><span style="font-size:1.4em;">หน่วยนับ</span></a>
                </div>-->
                <div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('admin-school-base-member'); ?>';"><?php echo img('images/admin/user.png'); ?><br/><br/><span style="font-size:1.4em;">ผู้ใช้งานระบบ</span></a>
                </div>
<!--                <div class="col-md-3">
                    <a href="<?php echo site_url('education-level'); ?>" class="btn btn-link"><?php echo img('images/admin/classroom.png'); ?><br/><br/><span style="font-size:1.4em;">กำหนดระดับชั้นเรียน</span></a>
                </div>-->
   
<!--                <div class="col-md-3">
                    <a href="<?php echo site_url('education-level-type'); ?>" class="btn btn-link"><?php echo img('images/admin/classroom_type.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>ประเภทชั้นเรียน</span></a>
                </div>-->
<!--                <div class="col-md-3">
                    <a href="<?php echo site_url('curriculum'); ?>" class="btn btn-link"><?php echo img('images/admin/orchart.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>หลักสูตรแกนกลาง</span></a>
                </div>-->
<!--                <div class="col-md-3">
                    <a href="<?php echo site_url('subject-detail'); ?>" class="btn btn-link"><?php echo img('images/admin/subject_name.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>รหัส/ชื่อวิชา</span></a>
                </div>-->

<!--                <div class="col-md-3">
                    <a href="#" class="btn btn-link"><?php echo img('images/admin/level.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>ระดับการศึกษา</span></a>
                </div>-->
<!--                <div class="col-md-3">
                    <a href="<?php echo site_url('education-group'); ?>" class="btn btn-link"><?php echo img('images/admin/subject.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>กลุ่มสาระการเรียนรู้</span></a>
                </div>-->
                <div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('school-type'); ?>';"><?php echo img('images/admin/school_type.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>ประเภทสถานศึกษา</span></a>
                </div>
    
<!--                <div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('localgov-type'); ?>';"><?php echo img('images/admin/localgov_type.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>ประเภท อปท.</span></a>
                </div> 
-->               
<!--<div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('localgov-detail'); ?>';"><?php echo img('images/admin/localgov.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>ข้อมูล อปท.</span></a>
                </div>-->
<!--
-->                
<div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('setting/inside_office'); ?>';"><?php echo img('images/admin/layers.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>หน่วยงานภายใน</span></a>
                </div>

     
<div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('setting/responsible'); ?>';"><?php echo img('images/admin/responsible.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>หน้าที่รับผิดชอบ</span></a>
                </div>
<!--                <div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('document-type'); ?>';"><?php echo img('images/admin/subject_name.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>ประเภทเอกสาร</span></a>
                </div>-->
                <div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('update-organization-data'); ?>';"><?php echo img('images/admin/organization.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>ข้อมูลหน่วยงาน</span></a>
                </div>
       
                <div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('data-activities-define'); ?>';"><?php echo img('images/admin/folder.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>กำหนดกลุ่มข้อมูล</span></a>
                </div>
<!--                <div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('insignia-information'); ?>';"><?php echo img('images/admin/insignia.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>ประเภท<br/>เครื่องราชอิสริยาภรณ์</span></a>
                </div>-->
<!--                <div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('human-prefix'); ?>';"><?php echo img('images/admin/symbol.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>คำนำหน้าชื่อ</span></a>
                </div>-->
                <div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('human-resources-type'); ?>';"><?php echo img('images/admin/symbol.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>ประเภทบุคลากร</span></a>
                </div>
              
<div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('rank'); ?>';"><?php echo img('images/admin/symbol.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>ตำแหน่ง</span></a>
                </div>
<!--                <div class="col-md-3">
                    <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('carousel-setting'); ?>';"><?php echo img('images/admin/refresh.png'); ?><?php echo br(2); ?><span style='font-size:1.4em;'>กำหนดสไลด์รูปภาพ</span></a>
                </div>-->
            </div>
        </div>
    </div>
    <?php $this->load->view('layout/my_school_footer'); ?>
</div>
