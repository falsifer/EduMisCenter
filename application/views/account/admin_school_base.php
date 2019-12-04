<div class="col-md-12">
    <div class="box">
        <div class="box-heading">ส่วนการจัดการระบบของโรงเรียน (School-Administrator)</div>
        <ul class="breadcrumb">
            <li><?php echo anchor(site_url(), "<i class='icon-home icon-large'></i> หน้าแรก"); ?></li>
            <li>ส่วนการจัดการระบบ</li>
        </ul>
        <div class="box-body" style="padding:50px;">
            <div class="container-fluid" style="text-align: center;">
                <div class="row">

                    <div class="col-md-3">
                        <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('school-base'); ?>';"><?php echo img("images/admin/school.png"); ?><br/><br/><span style="font-size:1.2em;">ข้อมูลโรงเรียน</span></a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('position-hierarchy'); ?>';"><?php echo img('images/menu/position64.png'); ?><?php echo br(2); ?><span style='font-size:1.2em;'>เลขที่ประจำตำแหน่ง</span></a>
                    </div>
                    <!--                    <div class="col-md-3">
                                            <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('school-director'); ?>';"><?php echo img('images/admin/professor.png'); ?><?php echo br(2); ?><span style='font-size:1.2em;'>ผู้อำนวยการโรงเรียน</span></a>
                                        </div>-->
                    <div class="col-md-3">
                        <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('import-sis-std'); ?>';"><?php echo img('images/menu/sis64.png'); ?><?php echo br(2); ?><span style='font-size:1.2em;'>ข้อมูลนักเรียนจาก SIS</span></a>
                    </div>

                    <div class="col-md-3">
                        <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('admin-school-base-member'); ?>';"><?php echo img('images/admin/user.png'); ?><br/><br/><span style="font-size:1.2em;">ผู้ใช้งานระบบ</span></a>
                    </div> 
                    <!--                    <div class="col-md-3">
                                            <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('setting/responsible'); ?>';"><?php echo img('images/admin/responsible.png'); ?><?php echo br(2); ?><span style='font-size:1.2em;'>หน้าที่รับผิดชอบ</span></a>
                                        </div>-->
                    <!--                    <div class="col-md-3">
                                            <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('import-sis-std'); ?>';"><?php echo img('images/menu/absent64.png'); ?><?php echo br(2); ?><span style='font-size:1.2em;'>เกณฑ์การมาปฏิบัติงาน</span></a>
                                        </div>-->
                    <div class="col-md-3">
                        <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('data-define-setting'); ?>';"><?php echo img('images/admin/folder.png'); ?><?php echo br(2); ?><span style='font-size:1.2em;'>โครงสร้างเมนูการทำงาน</span></a>
                    </div>

                    <!--                    <div class="col-md-3">
                                            <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('human-prefix'); ?>';"><?php echo img('images/admin/symbol.png'); ?><?php echo br(2); ?><span style='font-size:1.2em;'>คำนำหน้าชื่อ</span></a>
                                        </div>-->

                    <div class="col-md-3">
                        <a href="<?php echo site_url('curriculum'); ?>" class="btn btn-link"><?php echo img('images/admin/orchart.png'); ?><?php echo br(2); ?><span style='font-size:1.2em;'>หลักสูตรแกนกลาง</span></a>
                    </div>
                    <!--                    <div class="col-md-3">
                                            <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('school-type'); ?>';"><?php echo img('images/admin/school_type.png'); ?><?php echo br(2); ?><span style='font-size:1.2em;'>ประเภทสถานศึกษา</span></a>
                                        </div>-->

<!--                    <div class="col-md-3">
                        <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('document-type'); ?>';"><?php echo img('images/admin/subject_name.png'); ?><?php echo br(2); ?><span style='font-size:1.2em;'>ประเภทเอกสาร</span></a>
                    </div>-->
                    <div class="col-md-3">
                        <a href="#" class="btn btn-link" onclick="javascript:location.href = '<?php echo site_url('admin-school-division-base'); ?>';"><?php echo img('images/admin/subject_name.png'); ?><?php echo br(2); ?><span style='font-size:1.2em;'>กำหนดฝ่ายงาน</span></a>
                    </div>
                    <!--                    <div class="col-md-3">
                                            <a href="#" class="btn btn-link btn-unit" onclick="javascript:location.href = '<?php echo site_url('unit-group'); ?>';"><?php echo img("images/admin/unit_group.png"); ?><br/><br/><span style="font-size:1.2em;">ประเภทหน่วยนับ</span></a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="#" class="btn btn-link btn-unit" onclick="javascript:location.href = '<?php echo site_url('unit'); ?>';"><?php echo img("images/admin/unit.png"); ?><br/><br/><span style="font-size:1.2em;">หน่วยนับ</span></a>
                                        </div>-->
                </div>

            </div>
        </div>

        <?php $this->load->view('layout/my_school_footer'); ?>
    </div>
</div>