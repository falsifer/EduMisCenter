<ul class="nav navbar-nav" style="font-size:1em;">

    <!-- การบริหารงานวิชาการ -->
    <li class="active dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">การบริหารงานวิชาการ <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li class="dropdown-submenu">
                <a tabindex="-1" href="<?php echo site_url('activity-planung'); ?>">การวางแผนงานวิชาการ/ปฏิทินการศึกษา/วางแผนวิชาการ</a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo site_url("education-planing"); ?>"><i class="icon-list-ol"></i> การจัดทำแผนงานโครงการ</a></li>
                    <li class="divider"></li>
                    <li><a tabindex="-1" href="<?php echo site_url('provice-strategies-definetion'); ?>">กำหนดยุทธศาสตร์จังหวัด</a></li>
                    <li><a tabindex="-1" href="<?php echo site_url('localgov-strategies-definetion'); ?>">กำหนดยุทธศาสตร์องค์กรปกครองส่วนท้องถิ่น</a></li>
                    <li><a tabindex="-1" href="<?php echo site_url('localgov-sub-strategies'); ?>">กำหนดกลุ่มยุทธศาสตร์ย่อย</a></li>
                    <li><a tabindex="-1" href="<?php echo site_url('localgov-type-of-plan'); ?>">กำหนดประเภทแผนงานโครงการ</a></li>
                    <!--
                    <li class="dropdown-submenu">
                        <a href="#">Even More..</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">3rd level</a></li>
                            <li><a href="#">3rd level</a></li>
                        </ul>
                    </li>
                    -->
                </ul>
            </li>
            <li>
                <?php //echo anchor("education-planing", "การวางแผนพัฒนาการศึกษาและปฏิทินปฏิบัติงาน"); ?>
            </li>
            <li><?php echo anchor("#", "ระบบการพัฒนาหลักสูตร"); ?></li>
            <li><?php echo anchor("#", "ระบบบทเรียนออนไลน์"); ?></li>
            <li><?php echo anchor("#", "ระบบงานวัดผลและประเมินผล"); ?></li>
            <li><?php echo anchor("er-base", "ระบบงานวิจัยพัฒนาคุณภาพทางการศึกษา"); ?></li>
            <li><?php echo anchor("km-base", "ระบบแหล่งเรียนรู้ภายใน/ภายนอก"); ?></li>  
            <li><?php echo anchor("supervision", "ระบบนิเทศการศึกษา"); ?></li>
             <li><?php echo anchor("#", "ระบบแนะแนว"); ?></li>
            <li><?php echo anchor("school-qa-report", "ระบบการพัฒนาระบบประกันคุณภาพภายในและมาตรฐานการศึกษา"); ?></li>                               
            <li><?php echo anchor("bs-base","ระบบคัดเลือกหนังสือแบบเรียนเพื่อใช้ในสถานศึกษา"); ?></li>
            <li class="divider"></li>
            <li><?php echo anchor("std-base", "ข้อมูลพื้นฐานนักเรียน"); ?></li>
        </ul>
    </li>                        

    <!-- การบริหารงานวิชาการ -->
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">การบริหารงานทั่วไป <b class="caret"></b></a>
        <ul class="dropdown-menu" style="font-size:0.9em;">
            <li><?php echo anchor("network-of-km", "เครือข่ายข้อมูลสารสนเทศทางการศึกษา"); ?></li>
            <li><?php echo anchor("#","การวางแผนการบริหารงานการศึกษา"); ?></li>
            <li><?php echo anchor("go-to-inbox", "งานธุรการ (งานรับ-ส่งหนังสือระหว่างหน่วยงาน)"); ?></li>    
            <li><?php echo anchor("bd-base","การดูแลอาคารสถานที่และสภาพแวดล้อม"); ?></li>
            <li><?php echo anchor("#","การจัดทำสำมะโนผู้เรียน"); ?></li>
            <li><?php echo anchor("#","การรับนักเรียน"); ?></li>
            <li><?php echo anchor("#","การทัศนศึกษา"); ?></li>
            <li><?php echo anchor("#","งานกิจกรรมนักเรียน/สภานักเรียน"); ?></li>
            <li><?php echo anchor("#","ระบบดูแลช่วยเหลือนักเรียน/เยี่ยมบ้านนักเรียน"); ?></li>
            <li><?php echo anchor("pr-base", "การประชาสัมพันธ์งานการศึกษา"); ?></li>  
            <li><?php echo anchor("#","การรายงานผลการปฏิบัติงาน"); ?></li>
            <li><?php echo anchor("#","ระบบการควบคุมภายในหน่วยงาน"); ?></li>
        </ul>
    </li>



    <!-- การบริหารงานบุคลากร -->
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">การบริหารงานบุคลากร <b class="caret"></b></a>
        <ul class="dropdown-menu" style="font-size:0.9em;">
            <li><?php echo anchor("#", "การวางแผนอัตรากำลัง"); ?></li>
            <li><?php echo anchor("record-employee-activities", "ข้อมูลการลาทุกประเภท/การมาปฏิบัติงาน"); ?></li> 
            <li><?php echo anchor("human_resources", "ทำเนียบบุคลากร"); ?></li>  
            <li><?php echo anchor("#", "การส่งเสริมยกย่องเชิดชูเกียรติ/รางวัลเกียรติยศ"); ?></li>                            
            <li><?php echo anchor("human_resources_development", "การพัฒนาข้าราชการครูและบุคลากรทางการศึกษา"); ?></li>                            
        </ul>
    </li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">การบริหารงบประมาณ <b class="caret"></b></a>
        <ul class="dropdown-menu" style="font-size:0.9em;">
            <li><?php echo anchor("#", "ระบบพัสดุ"); ?></li>
            <li><?php echo anchor("#", "ระบบการเงิน"); ?></li>    
            <li><?php echo anchor("#", "ระบบบัญชี"); ?></li>    
        </ul>
    </li>                            

</li>
<?php if ($this->session->userdata('status') == 'ผู้ดูแลระบบ'): ?>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">ตั้งค่าระบบ <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><?php echo anchor("#", "รายชื่อโรงเรียน"); ?></li>
            <li><?php echo anchor("#", "หน่วยนับ"); ?></li>
            <li><?php echo anchor("#", "คำนำหน้าชื่อ"); ?></li>
            <li><?php echo anchor("#", "ตำแหน่ง"); ?></li>
            <li><?php echo anchor("#", "หน้าที่รับผิดชอบ (Responsible)"); ?></li>
            <li><?php echo anchor("#", "ประเภทเอกสาร"); ?></li>
            <li class="divider"></li>
            <li><?php echo anchor("#", "ข้อมูลผู้ใช้งานระบบ"); ?></li>
            <li class="divider"></li>
            <li><?php echo anchor("goout-from-system", "ออกจากระบบ"); ?></li>
        </ul>
    </li>  
<?php else: ?>
    <li><?php echo anchor('goout-from-system', "ออกจากระบบบ"); ?></li>
<?php endif; ?>
</ul>